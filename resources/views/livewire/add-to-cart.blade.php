<div
    x-data="{ 
        quantity: 1, 
        stock: {{ $purchasable->stock }}, 
        error: '' 
    }"
    class="p-4">
    <!-- Mennyiség mező -->
    <input
        type="number"
        x-model="quantity"
        min="1"
        class="border rounded p-2"
        @input="error = (quantity > stock) ? 'The quantity exceeds available stock (' + stock + ' items)' : ''" />

    <!-- Hibauzenet -->
    <p
        x-show="error"
        class="text-red-500 text-sm mt-2"
        x-text="error"></p>

    <!-- Kosár gomb -->
    <x-primary-button
        wire:click="addToCart" class="mt-4 bottom-4"
        x-bind:disabled="quantity > stock"
        class="mt-4 bg-blue-500 text-white px-4 py-2 rounded disabled:bg-gray-400">
        Add to Cart
    </x-primary-button>
</div>