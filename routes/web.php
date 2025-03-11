<?php

use App\Livewire\Login;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Events;
use App\Livewire\EventForm;

Route::get('/register', Register::class)->name('register');
Route::get('/', Login::class)->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/events', Events::class)->name('events');
    Route::get('/event/create', EventForm::class)->name('event.create');
    Route::get('/event/edit/{eventId}', EventForm::class)->name('event.edit');
});