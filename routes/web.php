<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PsyciController;
use App\Http\Controllers\JournalController;

Route::get('/', function () {
    return view('landing');})->name('views.landing');

//homepage
route::get('/home', [HomeController::class, 'home'])->name('views.Homepage');

//symmptom
Route::get('/symptom', function () {
    return view('symptom'); //ini gw masih bingung routing - / awal tuh buat yg di akses dari webnya - controller itu kau harus buat untuk setiap views yg ada - name tuh buat ngebalikin halaman mana yg mau di tampilin
})->name('views.symptom');

//journal
// Route::get('/journal', [JournalController::class, 'index'])->name('views.journal');
// Route::get('/journal/create', [JournalController::class, 'create'])->name('User.create');
// Route::post('/journal', [JournalController::class, 'store'])->name('journal.store');

//journall
Route::get('/journal', [JournalController::class, 'index'])->name('views.journal');
Route::get('/journal/create', [JournalController::class, 'create'])->name('User.create');
Route::post('/journal', [JournalController::class, 'store'])->name('journal.store');
Route::get('/journal/{id}/edit', [JournalController::class, 'edit'])->name('journal.edit');
Route::put('/journal/{id}', [JournalController::class, 'update'])->name('journal.update');
Route::delete('/journal/{id}', [JournalController::class, 'destroy'])->name('journal.destroy');

//psychiatry
route::get('/psyci', [PsyciController::class, 'psyci'])->name('views.psyci');
