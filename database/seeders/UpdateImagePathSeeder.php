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
            12 => 'storage/10/pinot_noir.jpg',
            13 => 'storage/11/provence.jpg',
            14 => 'storage/12/tempranillo.jpg',
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
