<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Lunar\Models\Product;
use App\Livewire\Cart;
use App\Models\Supplier;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cart', Cart::class)->name('cart');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/test-relations', function () {
//     $product = Product::find(1); // Termék ellenőrzése
//     $supplier = $product->supplier;

//     $supplierProducts = Supplier::find(3)->products; // Beszállítóhoz tartozó termékek

//     return response()->json([
//         'product' => [
//             'name' => $product->translateAttribute('name'),
//             'supplier' => $supplier ? $supplier->name : 'No supplier assigned',
//         ],
//         'supplier_products' => $supplierProducts->map(function ($product) {
//             return $product->translateAttribute('name');
//         }),
//     ]);
// });

require __DIR__.'/auth.php';
