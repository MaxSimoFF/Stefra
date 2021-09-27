<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\CartFromToDatabase;
use Cart;
use Livewire\Component;

class ProfileComponent extends Component
{
    use CartFromToDatabase;

    public function mount()
    {
        $this->restoreCartFromDatabase();
    }
    public function removeFromCart($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->emit('success', 'Item Removed from your cart');
        $this->storeCartToDatabase();
    }

    public function render()
    {
        return view('livewire.profile-component');
    }
}
