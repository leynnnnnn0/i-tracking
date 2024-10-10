<?php

use App\Http\Controllers\PdfController;
use App\Livewire\ActivityLog;
use App\Livewire\BorrowedLog;
use App\Livewire\BorrowerLog\Create as BorrowerLogCreate;
use App\Livewire\BorrowerLog\Edit as BorrowerLogEdit;
use App\Livewire\Dashboard;
use App\Livewire\Equipments;
use App\Livewire\MissingEquipment;
use App\Livewire\Others;
use App\Livewire\Personnel;
use App\Livewire\Personnel\Create as PersonnelCreate;
use App\Livewire\Personnel\Edit as PersonnelEdit;
use App\Livewire\Supply;
use App\Livewire\Supply\Create;
use App\Livewire\Supply\Edit;
use App\Livewire\SupplyHistory;
use App\Livewire\User;
use Illuminate\Support\Facades\Route;

//PDF
Route::get('/supplies-pdf', [PdfController::class, 'supplyListPdf']);
Route::get('test', [PdfController::class, 'index']);


Route::view('/', 'welcome');
Route::get('dashboard', Dashboard::class)->middleware('auth')->name('dashboard');
Route::get('activity-logs', ActivityLog::class)->name('activity-logs');
Route::get('supplies-history', SupplyHistory::class)->name('supplies-history');

Route::prefix('missing-equipments')->name('missing-equipments.')->group(function () {
    Route::get('/', MissingEquipment::class)->name('index');
    Route::get('/create', MissingEquipment\Create::class)->name('create');
    Route::get('/edit/{id}', MissingEquipment\Edit::class)->name('edit');
});

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', User::class)->name('index');
    Route::get('/create', User\Create::class)->name('create');
    Route::get('/edit/{id}', User\Edit::class)->name('edit');
});

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
    Route::get('/create', BorrowerLogCreate::class)->name('create');
    Route::get('/edit/{id}', BorrowerLogEdit::class)->name('edit');
});

Route::get('/others', Others::class)->name('others');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
