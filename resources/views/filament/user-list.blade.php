<div x-data="{ showDetails: false }" class="p-6 bg-white rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4">Registered Users</h1>

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Registered At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td class="border px-4 py-2">{{ $user->id }}</td>
                <td class="border px-4 py-2">{{ $user->name }}</td>
                <td class="border px-4 py-2">{{ $user->email }}</td>
                <td class="border px-4 py-2">{{ $user->created_at->format('Y-m-d H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- További Livewire interaktív rész -->
    <button @click="showDetails = !showDetails" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">
        Toggle Details
    </button>

    <div x-show="showDetails" class="mt-4 p-4 bg-gray-100 rounded">
        <p class="text-gray-700">You can add more user details or statistics here.</p>
    </div>
</div>
