<div class="py-12 bg-gray-50">
    <div class="flex">
        <div class="w-1/2 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-8">
                <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Your Shopping Cart</h2>

                @if($lines)
                <div class="space-y-6">
                    @foreach($lines as $index => $line)
                    <div class="flex items-center justify-between bg-gray-100 rounded-lg shadow-md p-4">
                        <!-- Termék kép -->
                        <div class="flex items-center space-x-4">
                            <img class="w-20 h-20 object-cover rounded-lg" src="{{ $line['thumbnail'] }}" alt="{{ $line['description'] }}">
                            <div>
                                <!-- Termék leírás -->
                                <h3 class="text-lg font-semibold text-gray-800">{{ $line['description'] }}</h3>
                                <!-- Mennyiség mező -->
                                <p class="text-sm text-gray-600">
                                    Quantity:
                                    <input type="number" min="1" wire:model="lines.{{ $loop->index }}.quantity"
                                        wire:change="updateLines"
                                        class="border-gray-300 rounded-md shadow-sm w-16" />
                                </p>

                                <p class="text-sm text-gray-600">Unit Price: ${{ number_format($line['unit_price'] / 100, 2) }}</p>
                                <p class="text-sm text-gray-800 font-semibold">Sub Total: ${{ number_format($line['quantity'] * $line['unit_price'] / 100, 2) }}</p>
                            </div>
                        </div>
                        <!-- Műveletek -->
                        <div class="flex items-center space-x-3">
                            <button wire:click="removeLine('{{ $line['id'] }}')" class="text-red-600 hover:text-red-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Kosár frissítése -->
                <div class="mt-8 text-center">
                    <button wire:click="updateLines" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg">
                        Update Cart
                    </button>
                </div>

                <!-- Összesített érték -->
                <div class="mt-4 text-center text-lg font-bold">
                    Total: ${{ number_format($total, 2) }}
                </div>

                @else
                <p class="text-center text-gray-600">Your cart is empty.</p>
                @endif
            </div>
        </div>

        <!-- Felhasználói adatok -->
        <div class="w-1/2">
            @livewire('user-details')
        </div>
    </div>

    <!-- Order gomb -->
    <div class="text-center mt-6">
        <button class="bg-blue-600 hover:bg-blue-700 font-bold py-2 px-6 rounded-lg">
            Order
        </button>
    </div>
</div>