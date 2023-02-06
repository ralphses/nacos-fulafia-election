<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewElectionRequest;
use App\Mail\VinEmail;
use App\Models\Candidates;
use App\Models\Election;
use App\Models\Voters;
use App\Utils\Utility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class ElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response()->view('dashboard.election.all', ['elections' => Election::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $readyElection = Election::where('status', Utility::ELECTION_STATUS['start'])
            ->orWhere('status', Utility::ELECTION_STATUS['on'])
            ->orderBy('date', 'desc')
            ->first();

        if(!is_null($readyElection)) {
            return redirect()->back()->with('elections', 'An election is started or ongoing');
        }

        return response()->view('dashboard.election.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewElectionRequest $request
     * @return RedirectResponse
     */
    public function store(NewElectionRequest $request): RedirectResponse
    {

        $startTime = date('h:i:s A');
        $stopTime = date('h:i:s A', strtotime("+". intval($request->get('election-duration'))." minutes", strtotime($startTime)));

        Election::create([
            'title' => $request->get('election-title'),
            'date' => $request->get('election-date'),
            'start_time' => $startTime,
            'stop_time' => $stopTime,
        ]);

        session()->flash('elections', 'New election added successfully!');

        return response()->redirectTo(route('election.all'));

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Election::destroy($id);

        session()->flash('Election deleted successfully!');

        return response()->redirectTo(route('election.all'));
    }

    public function status (Request $request) {

        $request->validate(['action' => ['required', Rule::in(array_values(Utility::ELECTION_STATUS))]]);

        $action = $request->get('action');

        if($action === Utility::ELECTION_STATUS['start']) {

            $readyElection = Election::where('status', Utility::ELECTION_STATUS['start'])->orderBy('date', 'desc')->first();

            if(is_null($readyElection)) {
                session()->flash('elections', 'No Election Available Election');
                return response()->redirectTo(route('election.all'));
            }
            else {
                $readyElection->update(['status' => Utility::ELECTION_STATUS['on']]);

                //Todo: Send Email
                $this->sendVinToVoters($readyElection);

                return response()->redirectTo(route('dashboard'));
            }
        }
        else if($action === Utility::ELECTION_STATUS['stop']) {

            $readyElection = Election::where('status', Utility::ELECTION_STATUS['on'])->orderBy('date', 'desc')->first();

            $readyElection->update(['status' => Utility::ELECTION_STATUS['stop']]);
            return response()->redirectTo(route('dashboard'));
        }
    }

    private function sendVinToVoters($election)
    {
        $voters = Voters::where('election_id', $election->id)->get();

        foreach ($voters as $voter) {

            $decrypt = Crypt::decrypt($voter->voter_id);
            $url = route('voters.vote', ['voterId' => $decrypt]);

            Mail::to($voter->email)->send(new VinEmail($url, $decrypt, $voter->name, $election->stop_time));
        }
    }

    public function positions() {

        $readyElection = Election::where('status', Utility::ELECTION_STATUS['start'])
            ->orWhere('status', Utility::ELECTION_STATUS['on'])
            ->orderBy('date', 'desc')
            ->first();

        $positions = [];

        foreach (Utility::POSITIONS as $post) {
            $positions[$post] = Candidates::where('position', $post)
                ->where('election_id', $readyElection->id ?? 0)
                ->get()
                ->count();
        }

        return view('dashboard.positions.all', ['positions' => $positions]);
    }

    public function electionResults(): Response|RedirectResponse
    {

        $readyElection = Election::where('status', Utility::ELECTION_STATUS['start'])
            ->orWhere('status', Utility::ELECTION_STATUS['on'])
            ->orderBy('date', 'desc')
            ->first();

        if(is_null($readyElection)) {
            return response()->redirectTo(route('dashboard'))->with('dashboard', 'Start election first');
        }

        $allCandidates = Candidates::where('active', 1)
            ->where('election_id', $readyElection->id)
            ->orderBy('position', 'asc')
            ->orderBy('total_votes', 'desc')
            ->get();

        return response()->view('dashboard.election.result', ['candidates' => $allCandidates]);

    }
}
