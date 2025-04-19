<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PsyciController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PsychController;


// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('views.landing');

// Login & Register
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Homepage (after user login)
Route::get('/home', [HomeController::class, 'home'])->name('views.Homepage');

// Symptom routes
Route::get('/symptom', fn() => view('symptom'))->name('views.symptom');
Route::get('/symptomcontent1', fn() => view('symptomcontent1'))->name('view.symptomcontent1');

// Journal routes
Route::get('/journal', [JournalController::class, 'index'])->name('views.journal');
Route::get('/journal/create', [JournalController::class, 'create'])->name('User.create');
Route::post('/journal', [JournalController::class, 'store'])->name('journal.store');
Route::get('/journal/{id}/edit', [JournalController::class, 'edit'])->name('journal.edit');
Route::put('/journal/{id}', [JournalController::class, 'update'])->name('journal.update');
Route::delete('/journal/{id}', [JournalController::class, 'destroy'])->name('journal.destroy');

// Psychiatrist page
Route::get('/psyci', [PsyciController::class, 'psyci'])->name('views.psyci');

// Psychiatrist profile page
Route::get('/psych', [PsychController::class, 'index'])->name('views.psych');