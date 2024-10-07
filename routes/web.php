<?php

use App\Livewire\BorrowedLog;
use App\Livewire\Dashboard;
use App\Livewire\Equipments;
use App\Livewire\Others;
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
Route::prefix('equipments')->name('equipments.')->group(function () {
    Route::get('/', Equipments::class)->name('index');
    Route::get('/create', \App\Livewire\Equipments\Create::class)->name('create');
    Route::get('/edit/{id}', \App\Livewire\Equipments\Edit::class)->name('edit');
});

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

Route::prefix('borrowed-logs')->name('borrowed-logs.')->group(function () {
    Route::get('/', BorrowedLog::class)->name('index');
});

Route::get('/others', Others::class)->name('others');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
