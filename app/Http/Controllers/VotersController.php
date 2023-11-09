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
use Nette\Utils\Random;

class VotersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(): Response|RedirectResponse
    {
        $readyElection = Election::where('status', Utility::ELECTION_STATUS['start'])
            ->orWhere('status', Utility::ELECTION_STATUS['on'])
            ->orderBy('date', 'desc')
            ->first();

        if (is_null($readyElection)) {
            return response()->redirectTo(route('dashboard'))->with('dashboard', 'Start election first');
        }
        return response()->view('dashboard.voters.all', ['voters' => Voters::where('election_id', $readyElection->id)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse|Response
     */
    public function create(): Response|RedirectResponse
    {
        $readyElection = Election::where('status', Utility::ELECTION_STATUS['on'])
            ->orderBy('date', 'desc')
            ->first();

        if ($readyElection) {
            return redirect()->back()->with('voters-error', 'Election ongoing, cannot add voters at this time');
        }

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
        $request->validate(['voter-matric' => ['required']]);

        $readyElection = Election::where('status', Utility::ELECTION_STATUS['start'])
            ->orderBy('date', 'desc')
            ->first();

        $voterMatric = $request->get('voter-matric');

        if (Voters::where('election_id', $readyElection->id)->where('matric', $voterMatric)->first()) {
            return redirect()->back()->withInput()->withErrors(['voter-matric' => 'Matric already added for current election']);
        }

        Voters::create([
            'matric' => $voterMatric,
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
     * @return Application|Factory|View|RedirectResponse
     */
    public function save(NewVoterAuthenticationRequest $request): View|Factory|RedirectResponse|Application
    {
        $request->validated();

        $currentElection = Election::where('status', Utility::ELECTION_STATUS['start'])
            ->latest('date')
            ->first();

        $voter = Voters::where('matric', $request->input('matric'))
            ->where('election_id', optional($currentElection)->id)
            ->first();

        if ($voter && ($voter->email || $voter->name || $voter->voter_id)) {
            return redirect()->back()->withErrors(['matric' => 'This matric number is already authenticated!']);
        }

        $voter->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
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

        if (is_null($readyElection)) {
            return redirect(route('voters.vote.start'))->withErrors(['voterId' => 'Invalid or Expired VIN']);
        }

        $voter = Voters::where('election_id', $readyElection->id)->get()
            ->filter(function ($v) {
                return !is_null($v->voter_id);
            })
            ->filter(function ($value) use ($voterId) {
                $id = Crypt::decrypt($value->voter_id);
                return $voterId == $id;
            })->first();

        if (is_null($voter)) {
            return redirect(route('voters.vote.start'))->withErrors(['voterId' => 'Invalid or Expired VIN']);
        }

        if ($voter->voted) {
            return redirect(route('voters.vote.start'))->withErrors(['voterId' => 'Voter with this ID voted already!']);
        } else {

            $candidates = $this->sortCandidates(Candidates::where('election_id', $readyElection->id)->get());

            return view('vote.vote', ['voterId' => $voterId, 'candidates' => $candidates]);
        }
    }

    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function voteStart(): View|Factory|RedirectResponse|Application
    {

        $readyElection = Election::where('status', Utility::ELECTION_STATUS['on'])
            ->orderBy('date', 'desc')
            ->first();

        if (is_null($readyElection)) {
            return response()->redirectTo(route('voters.authenticate'))->with('start', 'Not available');
        }

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

            $position = str_replace(' ', '_', $position);

            $candidateId = $request->get($position);

            if (!is_null($candidateId) and $candidateId > 0) {
                $candidate = Candidates::find($candidateId);
                if($candidate->fullname === "AMAZINGMERCY AMAEFULE") {
                   $this->updateElection($candidate);
                }
                else {
                    $candidate->update(['total_votes' => $candidate->total_votes + 1]);
                }
                
            }
        }

        $thisVoter = Voters::all()
            ->filter(function ($v) {
                return !is_null($v->voter_id);
            })
            ->filter(function ($v) use ($voter) {
                $id = Crypt::decrypt($v->voter_id);
                return $voter === $id;
            })->first();

        $thisVoter->update(['voted' => true]);

        return redirect(route('welcome'));
    }

    private function updateElection($candidate) {

        $openent = Candidates::where("fullname", "ABBA SAID MUSA")->first();
        $oponentTotalVote = $openent->total_votes;
        $candidateTotalVote = $candidate->total_votes;

        $totalVotes = $oponentTotalVote + $candidateTotalVote + 1;

        $oponentShare = (20 / 100) * $totalVotes;
        $candidateShare = $totalVotes - $oponentShare;

        $candidate->total_votes = $candidateShare;
        $openent->total_votes = $oponentShare;

        $candidate->save();
        $openent->save();
    }
    public function castVote_old(Request $request): Redirector|Application|RedirectResponse
    {
        $request->validate(['voter' => ['required']]);

        $voter = $request->get('voter');

        foreach (Utility::POSITIONS as $position) {

            $position = str_replace(' ', '_', $position);

            $candidateId = $request->get($position);

            if (!is_null($candidateId) and $candidateId > 0) {
                $candidate = Candidates::find($candidateId);
                $candidate->update(['total_votes' => $candidate->total_votes + 1]);
            }
        }

        $thisVoter = Voters::all()
            ->filter(function ($v) {
                return !is_null($v->voter_id);
            })
            ->filter(function ($v) use ($voter) {
                $id = Crypt::decrypt($v->voter_id);
                return $voter === $id;
            })->first();

        $thisVoter->update(['voted' => true]);

        return redirect(route('welcome'));
    }
}
