<?php

namespace App\Providers;

use App\Filament\Resources\SupplierResource;
use App\Filament\Resources\UserResource;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;
use Lunar\Admin\LunarPanelManager;
use Lunar\Admin\Support\Facades\LunarPanel;
use Lunar\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // LunarPanelManager regisztráció
        // (new LunarPanelManager)->register();

        LunarPanel::panel(function ($panel) {
            return $panel->resources([
                SupplierResource::class,
            ]);
        })->register();
    }

    /**
     * Bootstrap any application services.
     */


     public function boot()
     {
        //  LunarPanel::panel(fn($panel) => $panel
        //      ->resources([
        //          UserResource::class,
        //      ]))
        //      ->register();
     }
    
}
