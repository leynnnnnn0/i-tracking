<?php

use App\Livewire\Dashboard;
use App\Livewire\Equipments;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::get('dashboard', Dashboard::class)->middleware('auth')->name('dashboard');
Route::get('equipments', Equipments::class)->middleware('auth')->name('equipments');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
