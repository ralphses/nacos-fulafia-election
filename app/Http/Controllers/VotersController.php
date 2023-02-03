<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewVoterAuthenticationRequest;
use App\Models\Voters;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Nette\Utils\Random;

class VotersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response()->view('dashboard.voters.all', ['voters' => Voters::all()]);

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
        $request->validate(['voter-matric' => ['required', Rule::unique('voters', 'matric')]]);

        Voters::create(['matric' => $request->get('voter-matric')]);

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
            'voter_id' => $this->generateVoterId()
        ]);

        return view('auth.voter.authentication-success', ['voterId' => $voter->voter_id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return View|Factory|Application|RedirectResponse
     */
    public function vote(Request $request): View|Factory|Application|RedirectResponse
    {
        $request->validate(['voterId' => ['required', Rule::exists('voters', 'voter_id')]]);

        $voterId = $request->get('voterId');
        $voter = Voters::where('voter_id', $voterId)->first();

        if($voter->voted) {
            return redirect()->back()->withInput()->withErrors(['voterId' => 'Voter with this ID voted already!']);
        }
        else return view('vote.vote', ['voterId' => $voterId]);
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

    /**
     * @return Factory|View|Application
     */
    public function voteStart(): Factory|View|Application
    {
        return view('auth.voter.start');
    }
}
