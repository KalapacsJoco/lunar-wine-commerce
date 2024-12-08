<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Lunar\Models\Collection;
use Lunar\Models\Product;

class AttachProductToCollectionSeeder extends Seeder
{
    public function run()
    {
        // A "Red wines" kategória ID-je
        $redWineCollection = Collection::find(2);

        // Az ID-k alapján hozzárendelendő termékek
        $productIds = [5, 6, 7, 8];

        if ($redWineCollection) {
            $validProductIds = Product::whereIn('id', $productIds)->pluck('id')->toArray();

            if (!empty($validProductIds)) {
                $redWineCollection->products()->attach($validProductIds);
                echo "A következő termékek sikeresen hozzárendelve a Red wines kategóriához: " . implode(', ', $validProductIds) . "\n";
            } else {
                echo "Egyik megadott termék sem található.\n";
            }
        } else {
            echo "A kategória nem található.\n";
        }
    }
}
