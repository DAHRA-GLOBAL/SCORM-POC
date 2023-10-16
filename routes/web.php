<?php

use App\Http\Controllers\ScormController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

//Route::get('/hello', function () {
//    return 'Hello world';
//});

Route::get('/scorm', [ScormController::class, 'index'])->name('scorm.index');
//Route::get('/play-scorm/{uuid}', [ScormController::class, 'playScorm'])->name('scorm.play');
Route::get('/scorm/create', [ScormController::class, 'create'])->name('scorm.create');
Route::post('/scorm/store', [ScormController::class, 'store'])->name('scorm.store');
//Route::get('/scorm/{scorm}', [ScormController::class, 'show'])->name('scorm.show');

