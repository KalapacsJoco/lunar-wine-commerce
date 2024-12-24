<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="results"        
            class="bg-white shadow-2xl rounded-2xl p-8">
            <livewire:search-bar />
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
                        <li class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 transform transition duration-500 hover:scale-105 hover:shadow-2xl">
                            <!-- Alpine.js Data Binding -->
                            <div x-data="{ open: false }">
                                <!-- Termékkép -->
                                <button @click="open = true">
                                    <img class="w-full h-56 object-cover rounded-t-lg"
                                        src="{{ asset($product->image_path) }}"
                                        alt="{{ $product->translateAttribute('name') }}">
                                </button>

                                <!-- Tartalom -->
                                <div class="p-5 space-y-4">
                                    <!-- Terméknév -->
                                    <h3 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white truncate">
                                        {{ $product->translateAttribute('name') }}
                                    </h3>

                                    <!-- Ár -->
                                    <p class="text-xl font-semibold text-green-500">
                                        Price: ${{ $product->variants->first()?->prices->first()?->price->value / 100 ?? 'N/A' }}
                                    </p>

                                    <!-- Kosárba gomb -->
                                    @if ($product->variants->isNotEmpty())
                                    <div class="text-center mt-4">
                                        @if (Auth::check())
                                        <livewire:add-to-cart
                                            :product="$product"
                                            :purchasable="$product->variants->first()"
                                            :wire:key="$product->variants->first()->id" />
                                        @else
                                        <a href="{{ route('login') }}"
                                            class="inline-flex items-center px-5 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition duration-300">
                                            Login to Add to Cart
                                        </a>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                <x-productModal :product="$product" />
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