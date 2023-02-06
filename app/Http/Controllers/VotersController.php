<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewVoterAuthenticationRequest;
use App\Models\Candidates;
use App\Models\Election;
use App\Models\Voters;
use App\Utils\Utility;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use Nette\Utils\Random;

class VotersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $readyElection = Election::where('status', Utility::ELECTION_STATUS['start'])
            ->orWhere('status', Utility::ELECTION_STATUS['on'])
            ->orderBy('date', 'desc')
            ->first();

        if(is_null($readyElection)) {
            return response()->redirectTo(route('dashboard'))->with('dashboard', 'Start election first');
        }
        return response()->view('dashboard.voters.all', ['voters' => Voters::where('election_id', $readyElection->id)->get()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('dashboard.voters.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $readyElection = Election::where('status', Utility::ELECTION_STATUS['start'])
            ->orderBy('date', 'desc')
            ->first();

        $request->validate(['voter-matric' => ['required', Rule::unique('voters', 'matric')]]);

        Voters::create([
            'matric' => $request->get('voter-matric'),
            'election_id' => $readyElection->id
        ]);

        return response()->redirectTo(route('voters.add'))->with('voters', 'Voter added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id): View|Factory|Application
    {
        return view('dashboard.voters.single', ['voter' => Voters::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Application|Factory|View
     */
    public function authenticate(): View|Factory|Application
    {
        return view('auth.voter.authenticate');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewVoterAuthenticationRequest $request
     * @return Application|Factory|View
     */
    public function save(NewVoterAuthenticationRequest $request): Application|Factory|View
    {
        $request->validated();

        $voter = Voters::where('matric', $request->get('matric'))->first();

        $voter->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'voter_id' => Crypt::encrypt($this->generateVoterId())
        ]);

        return view('auth.voter.authentication-success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return View|Factory|Application|RedirectResponse
     */
    public function vote(Request $request): View|Factory|Application|RedirectResponse
    {
        $request->validate(['voterId' => ['required']]);

        $voterId = $request->get('voterId');

        $readyElection = Election::where('status', Utility::ELECTION_STATUS['start'])
            ->orWhere('status', Utility::ELECTION_STATUS['on'])
            ->orderBy('date', 'desc')
            ->first();

        if(is_null($readyElection)) {
            return redirect(route('voters.vote.start'))->withErrors(['voterId' => 'Invalid or Expired VIN']);

        }

        $voter = Voters::where('election_id', $readyElection->id)->get()->filter(function ($value) use ($voterId) {
            $id = Crypt::decrypt($value->voter_id);
            return $voterId == $id;
        })->first();

        if(is_null($voter)) {
            return redirect(route('voters.vote.start'))->withErrors(['voterId' => 'Invalid or Expired VIN']);
        }

        if($voter->voted) {
            return redirect(route('voters.vote.start'))->withErrors(['voterId' => 'Voter with this ID voted already!']);
        }

        else {

            $candidates = $this->sortCandidates(Candidates::where('election_id', $readyElection->id)->get());

            return view('vote.vote', ['voterId' => $voterId, 'candidates' => $candidates]);
        }
    }

    /**
     * @return Factory|View|Application
     */
    public function voteStart(): Factory|View|Application
    {
        return view('auth.voter.start');
    }

    /**
     * @return string
     */
    private function generateVoterId(): string
    {
        $voterId = "NACOS2023" . Random::generate(5, '0-9');

        while (Voters::where('voter_id', $voterId)->count() > 0) {
            $voterId = Random::generate(5, '0-9');
        }

        return $voterId;
    }

    private function sortCandidates(Collection $candidates): array
    {
        $sortedCandidate = [];

        foreach (Utility::POSITIONS as $position) {
            $sortedCandidate[$position] = $candidates->filter(function ($candidate) use ($position) {
                return $candidate->position === $position;
            })->all();
        }

        return $sortedCandidate;
    }

    public function castVote(Request $request): Redirector|Application|RedirectResponse
    {
        $request->validate(['voter' => ['required']]);

        $voter = $request->get('voter');


        foreach (Utility::POSITIONS as $position) {

            $candidateId = $request->get($position);

            if(!is_null($candidateId) AND $candidateId > 0) {
                $candidate = Candidates::find($candidateId);
                $candidate->update(['total_votes' => $candidate->total_votes + 1]);
            }
        }

        $thisVoter = Voters::all()->filter(function ($v) use ($voter) {
            $id = Crypt::decrypt($v->voter_id);
            return $voter === $id;

        })->first();

        $thisVoter->update(['voted' => true]);

        return redirect(route('welcome'));
    }
}
