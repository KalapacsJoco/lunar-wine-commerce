<div class="py-16 bg-gray-100 h-screen">
    <div class="max-w-7xl mx-auto h-full flex flex-col">
        <!-- Fő tartalom: két oszlop -->
        <div class="flex gap-8 flex-1">
            <!-- Kosár tartalma (bal oldal) -->
            <div class="w-2/3 bg-white shadow-2xl rounded-2xl p-6 flex flex-col overflow-y-auto h-[calc(100vh-10rem)]">
                <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Your Shopping Cart</h2>

                @if($lines)
                <div class="space-y-6">
                    @foreach($lines as $index => $line)
                    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex justify-between items-center">
                        <!-- Bal oldali tartalom: kép és részletek -->
                        <div class="flex items-center space-x-4">
                            <!-- Termék kép -->
                            <img class="w-20 h-20 object-cover rounded-lg shadow-sm"
                                src="{{ $line['thumbnail'] }}"
                                alt="{{ $line['description'] }}">

                            <!-- Termék részletek -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $line['description'] }}
                                </h3>
                                <p class="text-sm text-gray-700 dark:text-gray-400">
                                    Quantity:
                                    <!-- Mennyiség mező -->
                                    <input type="number" min="1"
                                        wire:model="lines.{{ $loop->index }}.quantity"
                                        wire:change="updateLines"
                                        class="w-16 px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Unit Price: ${{ number_format($line['unit_price'] / 100, 2) }}
                                </p>
                                <p class="text-sm font-bold text-green-500 dark:text-green-400">
                                    Sub Total: ${{ number_format($line['quantity'] * $line['unit_price'] / 100, 2) }}
                                </p>
                            </div>
                        </div>

                        <!-- Törlés gomb -->
                        <button wire:click="removeLine('{{ $line['id'] }}')" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-center text-gray-600 text-lg">Your cart is empty.</p>
                @endif
            </div>

            <!-- Felhasználói adatok (jobb oldal) -->
            <div class="w-2/3 bg-white shadow-2xl rounded-2xl p-6 flex flex-col h-[calc(100vh-10rem)]">
                <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Your Details</h2>
                <div class="w-full">
                    @livewire('user-details')
                </div>
            </div>
        </div>

        <!-- Alsó rész: Total és Order gomb -->
        <div class="bg-white shadow-2xl rounded-2xl py-4 px-6 mt-4 flex justify-between items-center sticky bottom-0">
            <div class="text-2xl font-bold text-gray-800">
                Total: <span class="text-green-600">${{ number_format($total, 2) }}</span>
            </div>
            @livewire('place-order')
        </div>
    </div>
</div>