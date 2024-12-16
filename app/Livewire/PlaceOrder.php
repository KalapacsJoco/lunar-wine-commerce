<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Lunar\Facades\CartSession;
use Lunar\Models\Cart;
use Lunar\Models\Channel;
use Lunar\Models\Order;
use Lunar\Models\OrderLine;
use Lunar\Base\ValueObjects\Cart\TaxBreakdown;
use Lunar\Base\ValueObjects\Cart\TaxBreakdownAmount;



class PlaceOrder extends Component
{

    public ?Cart $cart = null; // Definiáljuk a Cart példányt

    public function mount(): void
    {
        $this->cart = CartSession::current(); // Betöltjük a jelenlegi kosarat

    }

    public function placeOrder()
    {
        // Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
        $user = Auth::user();

        if (!$user) {
            session()->flash('error', 'You must be logged in to place an order.');
            return;
        }

        // Kosár lekérése
        $cart = CartSession::current();

        if (!$cart || $cart->lines->isEmpty()) {
            session()->flash('error', 'Your cart is empty.');
            return;
        }

        DB::beginTransaction();

        try {
            $channel = Channel::default()->first(); // Alapértelmezett csatorna lekérése

            if (!$channel) {
                throw new \Exception('Default channel not found.');
            }

            // Kosár teljes értékének kiszámítása
            $subTotal = $cart->lines->sum(fn($line) => $line->quantity * $line->unitPrice->value);

            $taxAmount = round($cart->subTotal->value * 0.19); // TVA 19% érték számítása

            $taxBreakdown = new TaxBreakdown();

            $currencyCode = $this->cart->currency->code ?? 'USD';

            $order = Order::create([
                'user_id' => $user->id,
                'channel_id' => $channel->id,
                'status' => 'placed',
                'sub_total' => $cart->subTotal->value,
                'discount_total' => 0,
                'shipping_total' => $cart->total->value ?? $cart->subTotal->value,
                'tax_breakdown' => $taxBreakdown, // TaxBreakdown objektum
                'tax_total' => ($cart->total->value * 100) / 19,
                'total' => $cart->subTotal->value + $taxAmount,
                'customer_id' => $user->customer->id, // Lunar customer ID
                'currency_code' => $currencyCode,
            ]);




            // Kosár sorok hozzáadása a rendeléshez
            foreach ($this->cart->lines as $line) {
                if (!isset($line->purchasable) || !isset($line->purchasable->product)) {
                    throw new \Exception('Invalid purchasable item in cart line.');
                }

                // dd($line->purchasable->prices()->first()->price->value);




                $price = $line->purchasable->prices()->first()->price->value; // Az ár konkrét értéke
                $quantity = $line->quantity;
                $subTotal = $price * $quantity; // Részösszeg
                $taxTotal = round($subTotal * 0.19); // 19% ÁFA

                OrderLine::create([
                    'order_id' => $order->id,
                    'purchasable_id' => $line->purchasable->id,
                    'purchasable_type' => get_class($line->purchasable),
                    'quantity' => $quantity,
                    'unit_price' => $price, // Egységár
                    'sub_total' => $subTotal, // Részösszeg
                    'description' => $line->purchasable->sku ?? 'No description',
                    'identifier' => $line->purchasable->sku ?? 'UNKNOWN',
                    'type' => 'product',
                    'discount_total' => 0,
                    'tax_breakdown' => $taxBreakdown,
                    'tax_total' => $taxTotal, // Adó összesen
                    'total' => $subTotal + $taxTotal, // Végösszeg
                    'meta' => json_encode([]),
                ]);
            }


            DB::commit();

            // Kosár ürítése
            // Kosár ürítése
            CartSession::destroy($cart->id);

            session()->flash('success', 'Your order has been placed successfully!');

            // Visszairányítás a dashboardra
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            DB::rollBack();

            // Részletes hibaüzenet
            session()->flash('error', 'Something went wrong: ' . $e->getMessage());

            // Dobd vissza a teljes hibát a hibakereséshez
            dd([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.place-order');
    }
}
