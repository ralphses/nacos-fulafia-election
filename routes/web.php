<?php

use App\Http\Controllers\CandidatesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dashboard')->group(function () {

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

})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('voters')->group(function () {

    Route::get('/authenticate', [VotersController::class, 'authenticate'])
        ->name('voters.authenticate');

    Route::post('/authenticate', [VotersController::class, 'save'])
        ->name('voters.save');

    Route::get('/authenticate/success', [VotersController::class, 'success'])
        ->name('voters.authenticate-success');

    Route::get('/vote', [VotersController::class, 'vote'])
        ->name('voters.vote');

    Route::get('/vote/start', [VotersController::class, 'voteStart'])
        ->name('voters.vote.start');
});



Route::view('/test', 'authentication.verify-email');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
