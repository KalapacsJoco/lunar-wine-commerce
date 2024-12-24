<!-- Modal -->
 <template x-teleport="body">
 <div class="flex items-center justify-center">
<div x-show="open" x-cloak class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-screen h-screen p-6 relative">
        <!-- Bezárás gomb -->
        <button @click="open = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-2xl">
            ✖
        </button>

        <!-- Termék adatok -->
        <div class="text-center flex items-center justify-center h-full">
            <img class="w-1/3 h-auto object-cover rounded-lg mb-4"
                src="{{ asset($product->image_path) }}"
                alt="{{ $product->translateAttribute('name') }}">
                <div>
            <h3 class="text-4xl font-bold text-gray-900 mb-4">
                {{ $product->translateAttribute('name') }}
            </h3>
            <p class="text-gray-700 mb-4 max-w-2xl text-center">
                {!! $product->translateAttribute('description') !!}
            </p>
            </div>
            <p class="text-green-500 text-3xl font-semibold mb-6">
                Price: ${{ $product->variants->first()?->prices->first()?->price->value / 100 ?? 'N/A' }}
            </p>

            <!-- Kosárba gomb -->
            @if ($product->variants->isNotEmpty())
            <div class="text-center">
                @if (Auth::check())
                <livewire:add-to-cart
                    :product="$product"
                    :purchasable="$product->variants->first()"
                    :wire:key="$product->variants->first()->id" />
                @else
                <a href="{{ route('login') }}"
                    class="inline-flex items-center px-5 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition duration-300">
                    Login to Add to Cart
                </a>a
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
</div>
</template>
