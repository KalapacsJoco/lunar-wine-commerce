<div class="text-center mt-8">
    <x-primary-button wire:click="placeOrder"
            class="bg-blue-600 hover:bg-blue-700 font-semibold py-2 px-6 rounded-lg">
        Order
    </x-primary-button>

    @if (session()->has('success'))
        <div class="mt-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mt-4 text-red-600">
            {{ session('error') }}
        </div>
    @endif
</div>
