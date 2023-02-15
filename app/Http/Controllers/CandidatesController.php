<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCandidateRequest;
use App\Models\Candidates;
use App\Models\Election;
use App\Utils\Utility;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;

class CandidatesController extends Controller
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

        if(is_null($readyElection)) {
            return response()->redirectTo(route('dashboard'))->with('dashboard', 'Start election first');
        }

        return response()->view('dashboard.candidates.all', ['candidates' => Candidates::where('election_id', $readyElection->id)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse|Response
     */
    public function create(): Response|RedirectResponse
    {

        $ongoingElection = Election::where('status', Utility::ELECTION_STATUS['on'])->first();

        if($ongoingElection) {
            return redirect()->back()->with('candidates-error', 'Election ongoing, cannot add candidate at this time');
        }

        return response()->view('dashboard.candidates.add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewCandidateRequest $request
     * @return RedirectResponse
     */
    public function store(NewCandidateRequest $request): RedirectResponse
    {
        $request->validated();

        $election = Election::where('status', Utility::ELECTION_STATUS['start'])->first();

        $addedCandidate = Candidates::where('election_id', $election->id)
            ->where('matric', $request->get('candidate-matric'))
            ->first();

        if($addedCandidate) {
            return redirect()->back()->withInput()->withErrors(['candidate-name' => 'Candidate with name or matric already added for this election']);
        }

        Candidates::create([
            'fullname' => $request->get('candidate-name'),
            'matric' => $request->get('candidate-matric'),
            'position' => $request->get('candidate-position'),
            'level' => $request->get('candidate-level'),
            'screened' => $request->get('candidate-screened') == "1",
            'image_path' => $this->storeImage($request),
            'election_id' => $election->id,
        ]);

        return response()->redirectTo(route('candidates.add'))->with('candidates', "Candidate saved!");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        return response()->view('dashboard.candidates.single', ['candidate' => Candidates::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function status(int $id): Redirector|RedirectResponse|Application
    {
        $candidate = Candidates::find($id);

        $candidate->update(['active' => !$candidate->active]);
        return redirect(route('candidates.all'))->with('candidates', 'Candidate updated!');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, int $id): Application|RedirectResponse|Redirector
    {

        $request->validate([
            'candidate-name' => ['required', 'regex:(\\w)', Rule::unique('candidates', 'fullname')->ignore($id)],
            'candidate-matric' => ['required', 'regex:(\\w)', Rule::unique('candidates', 'matric')->ignore($id)],
            'candidate-position' => ['required', Rule::in(Utility::POSITIONS)],
            'candidate-level' => ['required', Rule::in(array_values(Utility::LEVELS))],
            'candidate-screened' => ['required', Rule::in(["1", "2"])],
        ]);

        $candidate = Candidates::find($id);
        $file = $request->file('candidate-photo') ?? false;

        $candidate->update([
            'fullname' => $request->get('candidate-name'),
            'matric' => $request->get('candidate-matric'),
            'position' => $request->get('candidate-position'),
            'level' => $request->get('candidate-level'),
            'screened' => $request->get('candidate-screened') == "1",
            'image_path' => ($file) ? $this->storeImage($request) : $candidate->image_path,
        ]);

        return redirect(route('candidates.all'))->with('candidates', 'Candidate updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidates  $candidates
     * @return Response
     */
    public function destroy(Candidates $candidates)
    {
        //
    }

    private function storeImage(Request $request): array|string
    {

        $name = str_replace(' ', '', $request->get('candidate-name') . $request->get('candidate-position'));
        $newImage = uniqid() . '-' . $name . '.' . $request->file('candidate-photo')->extension();

        $move = $request->file('candidate-photo')->move(public_path('assets/images/candidates/photos'), $newImage, true);
        $move = str_replace("\assets", '/assets', $move);

        return str_replace(str_replace('app\Http\Controllers', '', __DIR__).'public', '', $move);

    }
}
