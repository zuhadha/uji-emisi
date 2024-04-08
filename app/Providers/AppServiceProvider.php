<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\User;

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
        Gate::define('admin', function (User $user) {
            return $user->is_admin;
        });

        Gate::define('dinas', function (User $user) {
            return $user->user_kategori == 'dinas';
        });

        Paginator::useBootstrap();

        View::composer('*', function ($view) {
            $user = auth()->user(); // or however you retrieve the user object

            // Check if user is authenticated
            if ($user) {
                $bengkel_name = $user->bengkel_name;
                $perusahaan_name = $user->perusahaan_name;
            } else {
                // Provide default values or an empty object
                $bengkel_name = '';
                $perusahaan_name = '';
            }

            $view->with([
                'bengkel_name' => $bengkel_name,
                'perusahaan_name' => $perusahaan_name,
            ]);
        });
    }
}
