<?php

use App\Http\Controllers\CandidatesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\VotersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SiteController::class, 'welcome'])->name('welcome');

Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::prefix('/candidates')->group(function () {

        Route::get('/', [CandidatesController::class, 'index'])
            ->name('candidates.all');

        Route::get('/add', [CandidatesController::class, 'create'])
            ->name('candidates.add');

        Route::get('/view/{id}', [CandidatesController::class, 'show'])
            ->name('candidates.view');

        Route::post('/add', [CandidatesController::class, 'store'])
            ->name('candidates.store');

        Route::patch('/update/{id}', [CandidatesController::class, 'update'])
            ->name('candidates.update');

        Route::patch('/status/{id}', [CandidatesController::class, 'status'])
            ->name('candidate.status');

    });

    Route::prefix('/voters')->group(function () {

        Route::get('/', [VotersController::class, 'index'])
            ->name('voters.all');

        Route::get('/add', [VotersController::class, 'create'])
            ->name('voters.add');

        Route::get('/view/{id}', [VotersController::class, 'show'])
            ->name('voters.view');

        Route::post('/add', [VotersController::class, 'store'])
            ->name('voters.store');
    });

    Route::prefix('/elections')->group(function () {

        Route::get('/', [ElectionController::class, 'index'])
            ->name('election.all');

        Route::get('/add', [ElectionController::class, 'create'])
            ->name('election.add');

        Route::post('/add', [ElectionController::class, 'store'])
            ->name('election.store');

        Route::post('/view/{id}', [ElectionController::class, 'show'])
            ->name('election.view');

        Route::delete('/remove/{id}', [ElectionController::class, 'destroy'])
            ->name('election.remove');

        Route::patch('/update/{id}', [ElectionController::class, 'update'])
            ->name('election.update');

        Route::post('/status', [ElectionController::class, 'status'])
            ->name('election.status');

        Route::get('/stop', [ElectionController::class, 'stop'])
            ->name('election.stop');

        Route::get('/results', [ElectionController::class, 'electionResults'])
            ->name('elections.result');
    });

    Route::prefix('positions')->group(function () {

        Route::get('/', [ElectionController::class, 'positions'])
            ->name('positions.all');
    });

});

Route::prefix('voters')->group(function () {

    Route::get('/authenticate', [VotersController::class, 'authenticate'])
        ->name('voters.authenticate');

    Route::post('/authenticate', [VotersController::class, 'save'])
        ->name('voters.save');

    Route::get('/authenticate/success', [VotersController::class, 'success'])
        ->name('voters.authenticate-success');

    Route::get('/vote', [VotersController::class, 'vote'])
        ->name('voters.vote');

    Route::post('/vote', [VotersController::class, 'castVote'])
        ->name('voters.vote.store');

    Route::get('/vote/start', [VotersController::class, 'voteStart'])
        ->name('voters.vote.start');
});

require __DIR__.'/auth.php';
