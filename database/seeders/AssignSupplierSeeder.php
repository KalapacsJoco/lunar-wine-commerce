<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Lunar\Models\Product;

class AssignSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Összes beszállító ID-k listája
        $supplierIds = Supplier::pluck('id')->toArray();

        // Minden termék frissítése véletlenszerű beszállítóval
        Product::all()->each(function ($product) use ($supplierIds) {
            $product->supplier_id = $supplierIds[array_rand($supplierIds)];
            $product->save();
        });
    }
}
