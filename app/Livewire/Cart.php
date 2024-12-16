<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Lunar\Facades\CartSession;

class Cart extends Component
{
    public array $lines;
    public bool $linesVisible = false;
    public string $total;

    protected $listeners = [
        'add-to-cart' => 'handleAddToCart',
    ];

    public function rules(): array
    {
        return [
            'lines.*.quantity' => 'required|numeric|min:1|max:10000',
        ];
    }

    public function mount(): void
    {
        $this->mapLines();
        $this->calculateTotal();
    }

    public function getCartProperty()
    {
        return CartSession::current();
    }

    public function getCartLinesProperty(): Collection
    {
        return $this->cart->lines ?? collect();
    }

    public function updateLines(): void
    {
        $this->validate(); // Validáljuk a mennyiségeket
    
        // Frissítsük a kosár sorait a Livewire-ben
        CartSession::updateLines(
            collect($this->lines)->map(function ($line) {
                return [
                    'id' => $line['id'],
                    'quantity' => $line['quantity'], // Frissített mennyiség
                ];
            })
        );
    
        // Sorok és teljes összeg újraszámolása
        $this->mapLines();
        $this->calculateTotal();
    
        $this->dispatch('cartUpdated');
    }

    public function removeLine($id): void
    {
        CartSession::remove($id);
        $this->mapLines();
        $this->calculateTotal();
    }

    public function mapLines(): void
    {
        $this->lines = $this->cartLines->map(function ($line) {
            return [
                'id' => $line->id,
                'identifier' => $line->purchasable->getIdentifier(),
                'quantity' => $line->quantity,
                'description' => $line->purchasable->getDescription(),
                'thumbnail' => $line->purchasable->getThumbnail()->getUrl(),
                'option' => $line->purchasable->getOption(),
                'options' => $line->purchasable->getOptions()->implode(' / '),
                'sub_total' => $line->subTotal->value,
                'unit_price' => $line->unitPrice->value,
            ];
        })->toArray();
    }

    private function calculateTotal(): void
    {
        $this->total = array_reduce($this->lines, function ($carry, $line) {
            return $carry + (($line['quantity'] * $line['unit_price']) / 100); // Total újraszámolása
        }, 0);
    }

    public function render(): View
    {
        return view('livewire.cart');
    }
}
