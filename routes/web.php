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
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AdminQuizController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PsychLoginController;

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('views.landing');

// USER Login & Register
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// PSYCHIATRIST Login Routes
Route::get('/psychologist/login', [PsychLoginController::class, 'showLoginForm'])->name('psychologist.login');
Route::post('/psychologist/login', [PsychLoginController::class, 'login'])->name('psychologist.login.submit');
Route::post('/psychologist/logout', [PsychLoginController::class, 'logout'])->name('psychologist.logout');

// Homepage (after user login)
Route::get('/home', [HomeController::class, 'home'])->name('views.Homepage');

// Psychiatrist Dashboard (after psych login)
Route::middleware(['auth:psych'])->group(function () {
    Route::get('/psychologist/dashboard', function () {
        return view('views.psyci');
    })->name('views.psyci');
});

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
Route::prefix('home')->group(function () {
    Route::get('/journal', [JournalController::class, 'index'])->name('views.journal');
    Route::get('/journal/create', [JournalController::class, 'create'])->name('User.create');
    Route::post('/journal', [JournalController::class, 'store'])->name('journal.store');
    Route::get('/journal/{id}/edit', [JournalController::class, 'edit'])->name('journal.edit');
    Route::put('/journal/{id}', [JournalController::class, 'update'])->name('journal.update');
    Route::delete('/journal/{id}', [JournalController::class, 'destroy'])->name('journal.destroy');
});

// Psychiatrist page (user view)
Route::get('/psyci', [PsyciController::class, 'psyci'])->name('views.psyci.public');

// Psychiatrist Profile
Route::get('/psych', [PsychController::class, 'index'])->name('views.psych');

// Appointment routes
Route::get('/appointment', [AppointmentController::class, 'index'])->name('views.appointment');

// Rating for psychiatrists
Route::post('/rate-psych', [PsychController::class, 'rate'])->name('psych.rate');

// User Profile Page
Route::get('/user-profile', [UserController::class, 'index'])->name('user.profile');
Route::get('/user-profile/edit', [UserController::class, 'edit'])->name('user.profile.edit');
Route::post('/user-profile/update', [UserController::class, 'update'])->name('user.profile.update');

// Chat Feature
Route::middleware(['auth'])->group(function () {
    Route::get('/chat/{receiverType?}/{receiverId?}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
    Route::put('/chat/{chat}', [ChatController::class, 'update'])->name('chat.update');
    Route::delete('/chat/{chat}', [ChatController::class, 'destroy'])->name('chat.destroy');
});

// Quiz Depression
Route::prefix('quiz')->group(function () {
    Route::get('/quiz/{type}', [QuizController::class, 'show'])->name('quiz.show');
    Route::post('/quiz/{type}', [QuizController::class, 'submit'])->name('quiz.submit');
});

// Quiz admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('quiz', AdminQuizController::class);
});

// Reviews
Route::get('/review', [ReviewController::class, 'showForm'])->name('review.form');
Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
Route::get('/all-reviews', [ReviewController::class, 'index'])->name('review.index');
Route::get('/all-reviews/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit');
Route::put('/all-reviews/{id}', [ReviewController::class, 'update'])->name('review.update');
Route::delete('/all-reviews/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
