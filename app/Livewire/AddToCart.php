<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Lunar\Base\Purchasable;
use Lunar\Facades\CartSession;
use Lunar\Models\Cart;
use Lunar\Models\Currency;

class AddToCart extends Component
{
    /**
     * The purchasable model we want to add to the cart.
     */
    public ?Purchasable $purchasable = null;

    /**
     * The quantity to add to cart.
     */
    public int $quantity = 1;

    

    public function rules(): array
    {
        return [
            'quantity' => 'required|numeric|min:1|max:10000',
        ];
    }

    public function addToCart(): void
    {
        $this->validate();
    
        if ($this->purchasable->stock < $this->quantity) {
            $this->addError('quantity', 'The quantity exceeds the available stock.');
            return;
        }
    
        try {
            $cart = CartSession::current();
            $newQuantity = $this->quantity;
    
            if (!$cart) {
                $currency = Currency::where('default', true)->firstOrFail();
                $cart = Cart::create([
                    'user_id' => null,
                    'currency_id' => $currency->id,
                    'channel_id' => 1,
                ]);
    
                CartSession::use($cart);
            }
    
            $existingLine = $cart->lines->first(fn($line) => $line->purchasable_id === $this->purchasable->id);
    
            if ($existingLine) {
                $newQuantity += $existingLine->quantity;
                CartSession::manager()->updateLine($existingLine->id, $newQuantity);
            } else {
                CartSession::manager()->add($this->purchasable, $this->quantity);
            }
    
            // Kibocsátjuk az új összmennyiséget
            $totalQuantity = $cart->lines->sum('quantity');
            $this->dispatch('cart-updated', total: $totalQuantity);
    
        } catch (\Exception $e) {
            dd('Error adding to cart:', $e->getMessage());
        }
    }
        
        
    public function render(): View
    {
        return view('livewire.add-to-cart');
    }
}
