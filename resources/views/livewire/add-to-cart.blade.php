<div x-data="{ cartTotal: 0 }" @cart-updated.window="cartTotal = $event.detail.total">
    <!-- Input mező és gomb -->
    <div>
        <input type="number" wire:model="quantity" min="1" value="1" class="border rounded p-2" />
        <x-primary-button wire:click="addToCart" class="mt-4 bottom-4">
            Add to Cart
        </x-primary-button>
    </div>

    <!-- Cart gomb -->
    <!-- <a href="/cart" class="flex items-center space-x-2 text-lg font-semibold hover:text-green-300">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="currentColor">
            <path d="M7 18c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm10 0c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm-9.142-1h8.658c.721 0 1.322-.5 1.474-1.197l2.71-10.803c.038-.151.057-.307.057-.462 0-.827-.673-1.5-1.5-1.5H5.594l-.354-1.732A1.498 1.498 0 0 0 3.763 1H1v2h2.763l2.92 14.682A2.984 2.984 0 0 0 7 21c1.654 0 3-1.346 3-3h-2c0 .551-.449 1-1 1s-1-.449-1-1 .449-1 1-1z" />
        </svg>
        <span>Cart (<span x-text="cartTotal"></span>)</span>
    </a> -->
</div>
