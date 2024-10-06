<?php

use App\Livewire\Dashboard;
use App\Livewire\Equipments;
use App\Livewire\Personel;
use App\Livewire\Personnel;
use App\Livewire\Personnel\Create as PersonnelCreate;
use App\Livewire\Personnel\Edit as PersonnelEdit;
use App\Livewire\Supply;
use App\Livewire\Supply\Create;
use App\Livewire\Supply\Edit;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('dashboard', Dashboard::class)->middleware('auth')->name('dashboard');
Route::get('equipments', Equipments::class)->middleware('auth')->name('equipments');

Route::prefix('supplies')->name('supplies.')->group(function () {
    Route::get('/', Supply::class)->name('index');
    Route::get('/create', Create::class)->name('create');
    Route::get('/edit/{id}', Edit::class)->name('edit');
});

Route::prefix('personnels')->name('personnels.')->group(function () {
    Route::get('/', Personnel::class)->name('index');
    Route::get('/create', PersonnelCreate::class)->name('create');
    Route::get('/edit/{id}', PersonnelEdit::class)->name('edit');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
