<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Lunar\Models\Product;

class UpdateImagePathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            5 => 'storage/5/cabernet_sauvignon.jpg',
            6 => 'storage/6/pinot_noir.jpg',
            7 => 'storage/7/merlot.jpg',
            8 => 'storage/8/syrah.jpg',
        ];

        foreach ($products as $id => $imagePath) {
            $product = Product::find($id);
            if ($product) {
                $product->image_path = $imagePath;
                $product->save();
            }
        }
    }
}
