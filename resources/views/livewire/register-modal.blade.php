<div x-data="{ showModal: @entangle('showModal') }" class="relative z-50">
    <!-- Regisztrációs gomb -->
    <x-primary-button @click="showModal = true"
        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow-md transition duration-200">
        Registration
    </x-primary-button>

    <!-- Modal háttér -->
    <div x-show="showModal" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <!-- Modal ablak -->
        <div @click.away="showModal = false" class="bg-white rounded-lg shadow-lg w-full max-w-3xl h-screen md:h-auto md:max-h-[90vh] overflow-y-auto p-6 relative">
            <!-- Bezáró gomb -->
            <button @click="showModal = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-lg">
                &times;
            </button>

            <!-- Modal cím -->
            <h2 class="text-2xl font-semibold mb-4 text-center text-gray-700">Regisztráció</h2>

            <!-- Form -->
            <form wire:submit.prevent="register" class="space-y-4">
                <!-- First Name -->
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input wire:model="first_name" id="first_name" type="text" placeholder=""
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('first_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input wire:model="last_name" id="last_name" type="text" placeholder=""
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('last_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- További mezők (email, password, address stb.) -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input wire:model="email" id="email" type="email" placeholder=""
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input wire:model="password" id="password" type="password" placeholder=""
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm password</label>
                    <input wire:model="password_confirmation" id="password_confirmation" type="password" placeholder=""
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone number</label>
                    <input wire:model="phone" id="phone" type="text" placeholder=""
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="address_line_1" class="block text-sm font-medium text-gray-700">Adress line 1</label>
                    <input wire:model="address_line_1" id="address_line_1" type="text" placeholder=""
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('address_line_1') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="address_line_2" class="block text-sm font-medium text-gray-700">Adress line 2 (optional)</label>
                    <input wire:model="address_line_2" id="address_line_2" type="text" placeholder=""
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('address_line_2') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                    <input wire:model="city" id="city" type="text" placeholder=""
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                    <input wire:model="state" id="state" type="text" placeholder=""
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('state') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="postcode" class="block text-sm font-medium text-gray-700">Postal Code</label>
                    <input wire:model="postcode" id="postcode" type="text" placeholder=""
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('postcode') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                    <input wire:model="country" id="country" type="text" placeholder=""
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('country') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="birth_date" class="block text-sm font-medium text-gray-700">Date of birth</label>
                    <input wire:model="birth_date" id="birth_date" type="date" placeholder=""
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                    @error('birth_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Itt folytasd a mezőidet... -->
                <div class="flex justify-between items-center mt-6">
                    <x-primary-button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow-md transition duration-200">
                        Submit
                    </x-primary-button>
                    <x-danger-button @click="showModal = false" type="button" class="text-gray-500 hover:text-gray-700">
                        Cancel
                    </x-danger-button>
                </div>
            </form>
        </div>
    </div>
</div>
