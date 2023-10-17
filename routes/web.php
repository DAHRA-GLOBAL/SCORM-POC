<?php

//use App\Http\Controllers\ScormController;
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
Route::get('/create', [App\Http\Controllers\ScormController::class, 'create'])->name('scorm.create');
Route::post('/parse', [App\Http\Controllers\ScormController::class, 'parse'])->name('scorm.parse');
Route::post('/upload', [App\Http\Controllers\ScormController::class, 'upload'])->name('scorm.upload');
