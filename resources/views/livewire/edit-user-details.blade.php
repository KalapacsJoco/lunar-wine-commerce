<div x-data="{ open: false }">
    <!-- Gomb a modal megnyitásához -->
    <x-secondary-button @click="open = true">Edit Shipping Details</x-secondary-button>

    <!-- Modal -->
    <div x-show="open" x-cloak>
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center overflow-auto">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl h-screen md:h-auto md:max-h-[90vh] overflow-y-auto p-6 relative">
            <h2 class="text-xl font-semibold mb-4">Edit Your Details</h2>
            <form wire:submit.prevent="save" class="h-1/2">
                    <!-- Input mezők -->
                    <div>
                        <label>First Name</label>
                        <input type="text" wire:model="first_name" class="w-full border rounded p-2" />
                    </div>
                    <div>
                        <label>Last Name</label>
                        <input type="text" wire:model="last_name" class="w-full border rounded p-2" />
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" wire:model="email" class="w-full border rounded p-2" />
                    </div>
                    <div>
                        <label>Phone</label>
                        <input type="text" wire:model="phone" class="w-full border rounded p-2" />
                    </div>
                    <div>
                        <label>Address</label>
                        <input type="text" wire:model="address_line_1" class="w-full border rounded p-2" />
                    </div>
                    <div>
                        <label>City</label>
                        <input type="text" wire:model="city" class="w-full border rounded p-2" />
                    </div>
                    <div>
                        <label>State</label>
                        <input type="text" wire:model="state" class="w-full border rounded p-2" />
                    </div>
                    <div>
                        <label>Postcode</label>
                        <input type="text" wire:model="postcode" class="w-full border rounded p-2" />
                    </div>
                    <div>
                        <label>Country</label>
                        <input type="text" wire:model="country" class="w-full border rounded p-2" />
                    </div>

                    <!-- Gombok -->
                    <div class="mt-4 flex justify-end">
                        <x-danger-button @click="open = false" class="mr-2">Cancel</x-danger-button>
                        <x-primary-button type="submit">Save</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
