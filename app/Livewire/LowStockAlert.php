<?php

namespace App\Livewire;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class LowStockAlert extends BaseWidget
{
    protected function getStats(): array
    {
        // Adatbázis lekérdezés a kis készletű termékekért
        $lowStockProducts = DB::table('lunar_product_variants')
            ->where('stock', '<=', 20)
            ->get();

        // Stat objektumok létrehozása
        $stats = [];
        foreach ($lowStockProducts as $product) {
            $stats[] = Stat::make("Insufficient stock", $product->sku)
                ->description("Sorck: {$product->stock}")
                ->color('danger');
        }

        // Ha nincs találat, akkor egy üzenet
        if (empty($stats)) {
            $stats[] = Stat::make('Message' ,'All product variants are sufficiently stocked!')
                ->color('success');
        }

        return $stats;
    }
}