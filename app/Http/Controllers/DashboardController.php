<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lunar\Models\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        // Gyűjtemények és a kapcsolódó termékek betöltése
        $collections = Collection::with('products.variants.prices')->get();

        return view('dashboard', compact('collections'));
    }
}

