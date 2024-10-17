<?php

use App\Http\Controllers\PdfController;
use App\Livewire\AccountingOfficer;
use App\Livewire\AccountingOfficer\Edit as AccountingOfficerEdit;
use App\Livewire\AccountingOfficer\View as AccountingOfficerView;
use App\Livewire\ActivityLog;
use App\Livewire\BorrowedLog;
use App\Livewire\BorrowerLog\Create as BorrowerLogCreate;
use App\Livewire\BorrowerLog\Edit as BorrowerLogEdit;
use App\Livewire\BorrowerLog\View as BorrowerLogView;
use App\Livewire\Category;
use App\Livewire\Category\Create as CategoryCreate;
use App\Livewire\Category\Edit as CategoryEdit;
use App\Livewire\Category\View as CategoryView;
use App\Livewire\Dashboard;
use App\Livewire\DeleteArchives;
use App\Livewire\Equipments;
use App\Livewire\MissingEquipment;
use App\Livewire\Offices;
use App\Livewire\Offices\Create as OfficesCreate;
use App\Livewire\Offices\Edit as OfficesEdit;
use App\Livewire\Offices\View as OfficesView;
use App\Livewire\Personnel;
use App\Livewire\Personnel\Create as PersonnelCreate;
use App\Livewire\Personnel\Edit as PersonnelEdit;
use App\Livewire\Personnel\View as PersonnelView;
use App\Livewire\ResponsiblePerson;
use App\Livewire\ResponsiblePerson\Create as ResponsiblePersonCreate;
use App\Livewire\Supply;
use App\Livewire\Supply\Create;
use App\Livewire\Supply\Edit;
use App\Livewire\Supply\View;
use App\Livewire\SupplyHistory;
use App\Livewire\User;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    //PDF
    Route::controller(PdfController::class)->group(function () {
        Route::get('/supplies-pdf', 'supplyListPdf')->name('supplies-pdf');
        Route::get('/equipments-pdf', 'equipmentListPdf')->name('equipment-pdf');
        Route::get('/personnels-pdf', 'personnelListPdf')->name('personnels-pdf');
        Route::get('/users-pdf', 'userListPdf')->name('users-pdf');
        Route::get('/borrowed-equipments', 'borrowedEquipmentList')->name('borrowed-equipments');
        Route::get('/supplies-history-pdf', 'supplyHistoryPdf')->name('supplies-history-pdf');
        Route::get('/missing-equipments-pdf', 'missingEquipmentPdf')->name('missing-equipments-pdf');
        Route::get('/responsible-person-pdf/{equipment_id}/{previous_responsible_person}', 'handleEquipmentNewResponsiblePerson')->name('responsible-person-pdf');

        Route::get('/offices-pdf', 'officesListPdf')->name('offices-pdf');
        Route::get('/categories-pdf', 'categoriesListPdf')->name('categories-pdf');
        Route::get('/accounting-officers-pdf', 'accountingOfficersListPdf')->name('accounting-officers-pdf');
    });

    Route::get('test', [PdfController::class, 'index']);


    Route::get('/', Dashboard::class)->middleware('auth')->name('dashboard');
    Route::get('activity-logs', ActivityLog::class)->name('activity-logs');
    Route::get('supplies-history', SupplyHistory::class)->name('supplies-history');

    Route::prefix('delete-archives')->name('delete-archives.')->middleware('can:can-handle-delete-archives')->group(function () {
        Route::get('/', DeleteArchives::class)->name('index');
    });

    Route::prefix('missing-equipments')->name('missing-equipments.')->group(function () {
        Route::get('/', MissingEquipment::class)->name('index');
        Route::get('/create', MissingEquipment\Create::class)->name('create');
        Route::get('/edit/{id}', MissingEquipment\Edit::class)->name('edit');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', User::class)->name('index');
        Route::get('/create', User\Create::class)->name('create');
        Route::get('/edit/{id}', User\Edit::class)->name('edit');
        Route::get('/view/{id}', User\View::class)->name('view');
    });

    Route::prefix('equipments')->name('equipments.')->group(function () {
        Route::get('/', Equipments::class)->name('index');
        Route::get('/create', \App\Livewire\Equipments\Create::class)->name('create');
        Route::get('/edit/{id}', \App\Livewire\Equipments\Edit::class)->name('edit');
        Route::get('/view/{id}', \App\Livewire\Equipments\View::class)->name('view');
    });

    Route::prefix('supplies')->name('supplies.')->group(function () {
        Route::get('/', Supply::class)->name('index');
        Route::get('/create', Create::class)->name('create');
        Route::get('/edit/{id}', Edit::class)->name('edit');
        Route::get('/view/{id}', View::class)->name('view');
    });

    Route::prefix('personnels')->name('personnels.')->group(function () {
        Route::get('/', Personnel::class)->name('index');
        Route::get('/create', PersonnelCreate::class)->name('create');
        Route::get('/edit/{id}', PersonnelEdit::class)->name('edit');
        Route::get('/view/{id}', PersonnelView::class)->name('view');
    });

    Route::prefix('borrowed-logs')->name('borrowed-logs.')->group(function () {
        Route::get('/', BorrowedLog::class)->name('index');
        Route::get('/create', BorrowerLogCreate::class)->name('create');
        Route::get('/edit/{id}', BorrowerLogEdit::class)->name('edit');
        Route::get('/view/{id}', BorrowerLogView::class)->name('view');
    });

    Route::prefix('offices')->name('offices.')->group(function () {
        Route::get('/', Offices::class)->name('index');
        Route::get('/create', OfficesCreate::class)->name('create');
        Route::get('/edit/{id}', OfficesEdit::class)->name('edit');
        Route::get('/view/{id}', OfficesView::class)->name('view');
    });

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', Category::class)->name('index');
        Route::get('/create', CategoryCreate::class)->name('create');
        Route::get('/edit/{id}', CategoryEdit::class)->name('edit');
        Route::get('/view/{id}', CategoryView::class)->name('view');
    });

    Route::prefix('accounting-officers')->name('accounting-officers.')->group(function () {
        Route::get('/', AccountingOfficer::class)->name('index');
        Route::get('/create', AccountingOfficer\Create::class)->name('create');
        Route::get('/edit/{id}', AccountingOfficerEdit::class)->name('edit');
        Route::get('/view/{id}', AccountingOfficerView::class)->name('view');
    });

    Route::prefix('responsible-persons')->name('responsible-persons.')->group(function () {
        Route::get('/', ResponsiblePerson::class)->name('index');
        Route::get('/create', ResponsiblePersonCreate::class)->name('create');
        Route::get('/edit/{id}', \App\Livewire\ResponsiblePerson\Edit::class)->name('edit');
        Route::get('/view/{id}', \App\Livewire\ResponsiblePerson\View::class)->name('view');
    });
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
