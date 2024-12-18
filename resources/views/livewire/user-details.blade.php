<div class="p-6 bg-white shadow-md rounded-md">
    <h2 class="text-xl font-semibold mb-4">Your Details</h2>

    <p><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Phone:</strong> {{ $user->phone }}</p>
    <p><strong>Address:</strong> {{ $user->address_line_1 }}, {{ $user->address_line_2 }}</p>
    <p><strong>City:</strong> {{ $user->city }}</p>
    <p><strong>State:</strong> {{ $user->state }}</p>
    <p><strong>Postcode:</strong> {{ $user->postcode }}</p>
    <p><strong>Country:</strong> {{ $user->country }}</p>
    <livewire:edit-user-details :user="$user" />
    </div>

