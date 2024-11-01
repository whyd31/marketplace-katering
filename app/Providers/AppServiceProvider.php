<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Gate::define('user-role', function (User $user, $roles) {
            // Mengonversi role pengguna menjadi integer
            $userRole = (int) $user->role;
            // Mengonversi semua peran dalam array menjadi integer
            $allowedRoles = array_map('intval', (array) $roles);
    
            return in_array($userRole, $allowedRoles);
        });

        View::composer('*', function ($view) {
            $cartCount = auth()->check() ? Cart::where('user_id', auth()->id())->sum('quantity') : 0;
            $view->with('cartCount', $cartCount);
        });
    }
}
