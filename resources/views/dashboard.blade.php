<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Termékek kategóriák szerint</h1>
                @foreach ($collections as $collection)
                <div class="mb-10">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">
                        Categories: {{ json_decode($collection->attribute_data)->name->en ?? 'N/A' }}
                    </h2>

                    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($collection->products as $product)
                        <li class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img src="{{ asset($product->image_path) }}" alt="{{ $product->translateAttribute('name') }}" class="w-full h-64 object-cover">
                            <div class="p-4">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $product->translateAttribute('name') }}</h3>
                                <p class="text-gray-600 mb-2">{!! $product->translateAttribute('description') !!}</p>
                                @if ($product->variants->count() > 1)
                                <p class="text-gray-600 font-semibold mb-2">Available Sizes:</p>
                                <ul class="mb-4">
                                    @foreach ($product->variants as $variant)
                                    <li class="text-gray-700">
                                        Size: {{ json_decode($variant->values->first()?->name)->en ?? 'N/A' }} -
                                        Price: ${{ $variant->prices->first()?->price->value / 100 ?? 'N/A' }}
                                    </li>
                                    @endforeach
                                </ul>
                                @else
                                <p class="text-lg font-bold text-green-600">Price: ${{ $product->variants->first()?->prices->first()?->price->value / 100 ?? 'N/A' }}</p>
                                @endif
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>