<?php

namespace App\Providers;

use App\Http\Controllers\PdfController;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('pdf-controller', PdfController::class);
        Gate::define('can-handle-delete-archives', function (User $user) {
            return $user->role === 'Admin';
        });
    }
}
