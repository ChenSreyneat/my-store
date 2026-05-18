<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \Illuminate\Support\Facades\Gate::define('isAdmin', function ($user) {
            return $user->role === 'admin';
        });

        \Illuminate\Support\Facades\Gate::define('isOwner', function ($user) {
            return $user->role === 'owner';
        });

        // Global Categories for Navbar
        \Illuminate\Support\Facades\View::composer('components.navbar', function ($view) {
            $view->with('navCategories', \App\Models\Category::all());
        });

        // Dashboard Data
        \Illuminate\Support\Facades\View::composer('layouts.dashboard', function ($view) {
            if (auth()->check()) {
                $user = auth()->user();
                if ($user->isAdmin()) {
                    $view->with('pendingOrdersCount', \App\Models\Order::where('status', 'pending')->count());
                } elseif ($user->isOwner() && $user->store) {
                    $view->with('pendingOrdersCount', \App\Models\Order::whereHas('items.product', function($q) use ($user) {
                        $q->where('store_id', $user->store_id);
                    })->where('status', 'pending')->count());
                }
            }
        });
    }
}
