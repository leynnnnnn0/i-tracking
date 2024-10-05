<?php

use App\Livewire\Dashboard;
use App\Livewire\Equipments;
use App\Livewire\Supply;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('dashboard', Dashboard::class)->middleware('auth')->name('dashboard');
Route::get('equipments', Equipments::class)->middleware('auth')->name('equipments');
Route::get('supplies', Supply::class)->name('supplies');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
