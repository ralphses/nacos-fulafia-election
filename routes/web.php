<?php

use App\Http\Controllers\CandidatesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
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
})->middleware(['auth', 'verified'])->name('dashboard');



Route::view('/test', 'authentication.verify-email');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
