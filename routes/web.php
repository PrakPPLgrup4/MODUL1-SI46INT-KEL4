<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PsyciController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PsychController;
use App\Http\Controllers\SymptomController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserProfileController;

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

// Admin Dashboard (landing)
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// Admin Routes (grouped with prefix and middleware)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('psychs', [AdminController::class, 'managePsychs'])->name('psychs');
    Route::get('psychs/create', [AdminController::class, 'create'])->name('create');
    Route::post('psychs', [AdminController::class, 'store'])->name('store');
    Route::get('psychs/{id}/edit', [AdminController::class, 'edit'])->name('edit');
    Route::put('psychs/{id}', [AdminController::class, 'update'])->name('psychs.update');
    Route::delete('psychs/{id}', [AdminController::class, 'destroy'])->name('destroy');
});

// Symptom routes
Route::get('/symptom', [SymptomController::class, 'index'])->name('views.symptom');
Route::get('/symptomcontent1', [SymptomController::class, 'showContent1'])->name('views.symptomcontent1');

// Journal routes
Route::get('/journal', [JournalController::class, 'index'])->name('views.journal');
Route::get('/journal/create', [JournalController::class, 'create'])->name('User.create');
Route::post('/journal', [JournalController::class, 'store'])->name('journal.store');
Route::get('/journal/{id}/edit', [JournalController::class, 'edit'])->name('journal.edit');
Route::put('/journal/{id}', [JournalController::class, 'update'])->name('journal.update');
Route::delete('/journal/{id}', [JournalController::class, 'destroy'])->name('journal.destroy');

// Psychiatrist page (user view)
Route::get('/psyci', [PsyciController::class, 'psyci'])->name('views.psyci');

// Psychiatrist profile page
Route::get('/psych', [PsychController::class, 'index'])->name('views.psych');

// Appointment routes
Route::get('/appointment', [AppointmentController::class, 'index'])->name('views.appointment');

// User Profile Page
Route::get('/user-profile', [UserProfileController::class, 'index'])->name('user.profile');
Route::get('/user-profile/edit', [UserProfileController::class, 'edit'])->name('user.profile.edit');
Route::post('/user-profile/update', [UserProfileController::class, 'update'])->name('user.profile.update');

// ✅ Rating route for psychiatrists
Route::post('/rate-psych', [PsychController::class, 'rate'])->name('psych.rate');
