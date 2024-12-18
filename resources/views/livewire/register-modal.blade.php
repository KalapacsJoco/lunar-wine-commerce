<div x-data="{ showModal: @entangle('showModal') }" class="relative z-50">
    <!-- Regisztrációs gomb -->
    <button @click="showModal = true"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-md transition duration-200">
        Registration
    </button>

    <!-- Modal háttér -->
    <div x-show="showModal" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <!-- Modal ablak -->
        <div @click.away="showModal = false"
            class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-6 dark:bg-gray-800 md:max-h-[90vh] overflow-y-auto relative">
            <!-- Bezáró gomb -->
            <button @click="showModal = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white text-lg">
                &times;
            </button>

            <!-- Modal cím -->
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-900 dark:text-white">Registration</h2>

            <!-- Form -->
            <form wire:submit.prevent="register" class="space-y-5">
                <!-- First Name -->
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                    <input wire:model="first_name" id="first_name" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    @error('first_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                    <input wire:model="last_name" id="last_name" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    @error('last_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input wire:model="email" id="email" type="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input wire:model="password" id="password" type="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                    <input wire:model="password_confirmation" id="password_confirmation" type="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600">
                    @error('password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                    <input wire:model="phone" id="phone" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600">
                    @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Address Line 1 -->
                <div>
                    <label for="address_line_1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address Line 1</label>
                    <input wire:model="address_line_1" id="address_line_1" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600">
                    @error('address_line_1') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- City -->
                <div>
                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                    <input wire:model="city" id="city" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600">
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


                <!-- Submit and Cancel -->
                <div class="flex justify-end space-x-2 mt-6">
                    <button type="submit"
                        class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Submit
                    </button>
                    <button @click="showModal = false" type="button"
                        class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
