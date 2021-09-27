<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\CartFromToDatabase;
use Auth;
use Cart;
use Livewire\Component;

class CartComponent extends Component
{
    use CartFromToDatabase;
    public $qty;
    protected $listeners = ['updateCartQty'];

    public function mount()
    {
        $this->restoreCartFromDatabase();
    }

    public function updateCartQty($rowId)
    {
        $prod = Cart::instance('cart')->get($rowId);
        if (!$prod) return $this->emit('error', 'something went wrong please try again');
        Cart::instance('cart')->update($rowId, ['qty' => $this->qty]);
        $this->storeCartToDatabase();
        $this->emitTo('cart.cart-count-component', 'refreshComponent');
    }

    public function removeFromCart($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->storeCartToDatabase();
        $this->emit('success', 'Item Removed from your cart');
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
