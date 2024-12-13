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
        // dd($this->purchasable);
        $this->validate();

        if ($this->purchasable->stock < $this->quantity) {
            $this->addError('quantity', 'The quantity exceeds the available stock.');

            return;
        }
        

        
        try {
            // Alapértelmezett valuta lekérése
            $currency = Currency::where('default', true)->first();
        
            if (!$currency) {
                throw new \Exception('No default currency found!');
            }
        
            // Kosár létrehozása a megfelelő currency_id-vel
            $cart = Cart::create([
                'user_id' => null, // Ha nincs felhasználó, használj null-t
                'currency_id' => $currency->id,
                'channel_id' => 1, // Győződj meg róla, hogy van érvényes csatorna
            ]);
        
            // CartSession használata az új kosárral
            CartSession::use($cart);
        
            // Termék hozzáadása a kosárhoz
            CartSession::manager()->add($this->purchasable, $this->quantity);
        
            // dd('Successfully added to cart!', $cart);
        } catch (\Exception $e) {
            dd('Error adding to cart:', $e->getMessage());
        }
        
    }

    public function render(): View
    {
        return view('livewire.add-to-cart');
    }
}
