<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-900 leading-tight text-center">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  shadow-2xl rounded-2xl p-8">
                <h1 class="text-5xl font-extrabold text-gray-800 mb-12 text-center tracking-tight">
                    Explore Our Exclusive Wine Collection
                </h1>

                @foreach ($collections as $collection)
                <div class="mb-16">
                    <h2 class="text-3xl font-bold text-gray-700 mb-8 pb-3 border-b-2 border-gray-300">
                        Categories: {{ json_decode($collection->attribute_data)->name->en ?? 'N/A' }}
                    </h2>

                    <!-- Termékek Grid -->
                    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        @foreach ($collection->products as $product)
                        <li class="bg-white rounded-xl shadow-md  transform transition duration-500 hover:scale-105 hover:shadow-2xl">
                            <!-- Termékkép -->
                            <img class="w-full h-56 object-cover" 
                                 src="{{ asset($product->image_path) }}" 
                                 alt="{{ $product->translateAttribute('name') }}">

                            <!-- Tartalom -->
                            <div class="p-6 space-y-4">
                                <!-- Terméknév -->
                                <h3 class="text-2xl font-bold text-gray-800 truncate">
                                    {{ $product->translateAttribute('name') }}
                                </h3>

                                <!-- Leírás -->
                                <p class="text-gray-600 text-sm line-clamp-3">
                                    {!! $product->translateAttribute('description') !!}
                                </p>

                                <!-- Ár -->
                                <p class="text-xl font-semibold text-green-500">
                                    Price: ${{ $product->variants->first()?->prices->first()?->price->value / 100 ?? 'N/A' }}
                                </p>

                                <!-- Kosárba gomb -->
                                @if ($product->variants->isNotEmpty())
                                <div class="text-center mt-4">
                                    @if (Auth::check())
                                        <!-- Csak bejelentkezett felhasználóknak -->
                                        <livewire:add-to-cart 
                                            :purchasable="$product->variants->first()" 
                                            :wire:key="$product->variants->first()->id" />
                                    @else
                                        <!-- Ha nincs bejelentkezve -->
                                        <a href="{{ route('login') }}"
                                           class="inline-block text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 px-5 py-2 rounded-lg shadow-md transition duration-300">
                                            Login to Add to Cart
                                        </a>
                                    @endif
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
