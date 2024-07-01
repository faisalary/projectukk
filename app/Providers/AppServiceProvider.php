<?php

namespace App\Providers;

use Illuminate\View\View;
use App\Helpers\MenuHelper;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View as ViewFacade;

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
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
        ViewFacade::composer('partials.sidemenu', function (View $view) {
            $data = ['menu' => MenuHelper::getInstance()];
            $view->with($data);
        });
    }
}
