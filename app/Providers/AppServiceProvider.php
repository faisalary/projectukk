<?php

namespace App\Providers;

use App\Models\Industri;
use Illuminate\View\View;
use App\Helpers\MenuHelper;
use App\Models\PendaftaranMagang;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use App\Enums\PendaftaranMagangStatusEnum;
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
            $data['pengajuan_magang_count'] = Cache::remember('pengajuan_magang_count', 30, function () {
                return PendaftaranMagang::whereIn('current_step', [
                    PendaftaranMagangStatusEnum::PENDING,
                    PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL,
                    PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI
                ])->count();
            });
            
            $data['kelola_mitra_count'] = Cache::remember('kelola_mitra_count', 30, function () {
                return Industri::where('statusapprove', 0)->count();
            });

            $data['menu'] = MenuHelper::getInstance($data);
            $view->with($data);
        });
    }
}
