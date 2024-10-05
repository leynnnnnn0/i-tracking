<?php

use App\Livewire\Dashboard;
use App\Livewire\Equipments;
use App\Livewire\Supply;
use App\Livewire\Supply\Create;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('dashboard', Dashboard::class)->middleware('auth')->name('dashboard');
Route::get('equipments', Equipments::class)->middleware('auth')->name('equipments');
Route::prefix('supplies')->name('supplies.')->group(function () {
    Route::get('/', Supply::class)->name('index');
    Route::get('/create', Create::class)->name('create');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
