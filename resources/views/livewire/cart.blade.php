<div>
    <h2>Cart</h2>
    @foreach($lines as $line)
        <div>
            <img src="{{ $line['thumbnail'] }}" alt="{{ $line['description'] }}">
            <p>{{ $line['description'] }}</p>
            <p>Quantity: {{ $line['quantity'] }}</p>
            <p>Unit Price: {{ $line['unit_price'] }}</p>
            <p>Sub Total: {{ $line['sub_total'] }}</p>
            <button wire:click="removeLine('{{ $line['id'] }}')">Remove</button>
        </div>
    @endforeach

    <button wire:click="updateLines">Update Cart</button>
</div>

