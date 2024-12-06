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
            1 => 'storage/1/tokaji_furmint.jpg',
            2 => 'storage/2/sauvignon_blanc.jpg',
            3 => 'storage/3/chardonnay.jpg',
            4 => 'storage/4/riesling.jpg',
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
