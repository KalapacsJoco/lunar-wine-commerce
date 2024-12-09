<?php

namespace App\Observers;

// use App\Models\Lunar\Models\Product;
use Lunar\Models\Product;
use Illuminate\Support\Str;



class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */

     public function creating(Product $product)
     {
         // Kép generálása az image_path mezőhöz, ha hiányzik
         if (request()->hasFile('image')) {
             $file = request()->file('image');
             $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
             $path = $file->storeAs('storage/' . $product->id, $filename, 'public');
 
             // Mentés az image_path oszlopba
             $product->image_path = $path;
         }
     }

    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
