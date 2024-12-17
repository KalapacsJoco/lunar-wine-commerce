<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-8">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Explore Our Wine Collection</h1>
            @foreach ($collections as $collection)
            <div class="mb-12">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6 border-b pb-2 border-gray-300">
                    Categories: {{ json_decode($collection->attribute_data)->name->en ?? 'N/A' }}
                </h2>

                <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($collection->products as $product)
                    <li class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-lg">
                        <!-- Termékkép -->
                        <img class="w-full h-48 object-cover" src="{{ asset($product->image_path) }}" alt="{{ $product->translateAttribute('name') }}">

                        <!-- Tartalom -->
                        <div class="p-4">
                            <!-- Terméknév -->
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $product->translateAttribute('name') }}</h3>

                            <!-- Leírás -->
                            <p class="text-gray-600 text-sm mb-4">
                                {!! $product->translateAttribute('description') !!}
                            </p>

                            <!-- Ár -->
                            <p class="text-lg font-semibold text-green-600 mb-4">
                                Price: ${{ $product->variants->first()?->prices->first()?->price->value / 100 ?? 'N/A' }}
                            </p>

                            <!-- Kosárba gomb -->
                            @if($product->variants->isNotEmpty())
                            <div class="text-center">
                                <livewire:add-to-cart :purchasable="$product->variants->first()" :wire:key="$product->variants->first()->id">
                            </div>
                            @endif
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</div>

</x-app-layout>