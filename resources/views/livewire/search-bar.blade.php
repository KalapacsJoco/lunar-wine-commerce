<div>
    <input
        type="text"
        wire:model.live.debounce.300ms="query"
        placeholder="Search products..."
        class="border rounded p-2 w-full"
    />

    @if($results && !$results->isEmpty())
        <ul class="mt-4">
            @foreach ($results as $product)
                <li class="p-2 border-b">
                    {{ $product->translateAttribute('name') ?? 'No name available' }}
                </li>
            @endforeach
        </ul>
    @else
        @if(strlen($query) < 2 && !empty($query))
            <p class="text-red-500 mt-2">Please enter at least 2 characters to search.</p>
        @elseif(strlen($query) >= 2 && $results->isEmpty())
            <p class="text-red-500 mt-2">No results found.</p>
        @endif
    @endif
</div>
