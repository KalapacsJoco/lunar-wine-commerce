<div x-data="{ showModal: false }">
    <!-- Login gomb -->
    <x-primary-button @click="showModal = true" class="bg-blue-500  px-4 py-2 rounded">
        Login
    </x-primary-button>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-semibold mb-4">Login</h2>

            <!-- Login form -->
            <form wire:submit.prevent="login">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" wire:model="email" class="w-full border rounded p-2" id="email">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" wire:model="password" class="w-full border rounded p-2" id="password">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center mb-4">
                    <input type="checkbox" wire:model="remember" id="remember" class="mr-2">
                    <label for="remember" class="text-gray-700">Remember me</label>
                </div>

                <x-primary-button type="submit" class="bg-green-500  px-4 py-2 rounded">Login</x-primary-button>
                <x-danger-button @click="showModal = false" class="ml-2 text-gray-500">Cancel</x-danger-button>
            </form>

            <!-- Hibaüzenet -->
            @if (session()->has('error'))
                <p class="text-red-500 mt-2">{{ session('error') }}</p>
            @endif
        </div>
    </div>
</div>
