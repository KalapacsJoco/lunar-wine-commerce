<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Termékek kategóriák szerint</h1>
                @foreach ($collections as $collection)
                <div class="mb-10">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">
                        Categories: {{ json_decode($collection->attribute_data)->name->en ?? 'N/A' }}
                    </h2>

                    <ul>
                        @foreach ($collection->products as $product)
                        <li>
                            <!-- Termékkép -->
                            <img src="{{ asset($product->image_path) }}" alt="{{ $product->translateAttribute('name') }}">

                            <!-- Terméknév -->
                            <h3>{{ $product->translateAttribute('name') }}</h3>

                            <!-- Leírás -->
                            <p>{!! $product->translateAttribute('description') !!}</p>

                            <!-- Ár -->
                            <p>
                                Ár: ${{ $product->variants->first()?->prices->first()?->price->value / 100 ?? 'N/A' }}
                            </p>

                            <!-- Kosárba gomb -->
                            @if($product->variants->isNotEmpty())
                            <livewire:add-to-cart :purchasable="$product->variants->first()" :wire:key="$product->variants->first()->id">
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- <script>
        function updatePrice(select, productId) {
            const selectedOption = select.options[select.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            const priceElement = document.getElementById(`price-${productId}`);
            priceElement.textContent = `Price: $${price}`;
        }
    </script> -->
</x-app-layout>