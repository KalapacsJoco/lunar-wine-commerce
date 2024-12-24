<?php

namespace App\Livewire;

use Livewire\Component;
use Lunar\Models\Product;

class SearchBar extends Component
{
    public $query = '';
    public $results = [];
    public $selectedProduct = null;

    public function selectProduct($productId)
    {
        $this->selectedProduct = Product::findOrFail($productId);
    }


    public function updatedQuery()
    {
        if (strlen($this->query) < 2) {
            $this->results = [];
            return;
        }

        // dd(Product::first()->attribute_data);
        // dd($product->attribute_data['name']);



        $this->results = Product::where('attribute_data->name->value->en', 'like', "%{$this->query}%")
            ->take(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.search-bar');
    }
}
