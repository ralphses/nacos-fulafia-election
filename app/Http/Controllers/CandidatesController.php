<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCandidateRequest;
use App\Models\Candidates;
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
     * @return Response
     */
    public function index(): Response
    {
        return response()->view('dashboard.candidates.all', ['candidates' => Candidates::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
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

        Candidates::create([
            'fullname' => $request->get('candidate-name'),
            'matric' => $request->get('candidate-matric'),
            'position' => $request->get('candidate-position'),
            'level' => $request->get('candidate-level'),
            'screened' => $request->get('candidate-screened') == "1",
            'image_path' => $this->storeImage($request),
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
