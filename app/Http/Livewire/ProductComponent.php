<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Cart;
use Livewire\Component;
use Livewire\Event;

class ProductComponent extends Component
{
    public $product;
    public $qty = 1;

    public function mount($slug)
    {
        $this->product = Product::where('slug', '=', $slug)->firstOrFail();
    }

    public function addToCart(): Event
    {
        if (!$this->qty || $this->qty <= 0) {
            $this->qty = 1;
            return $this->emit('warning', 'Quantity must be greater than 0');
        }
        Cart::instance('cart')->add($this->product->id, $this->product->name, $this->qty, $this->product->price)->associate('App\Models\Product');
        $this->emitTo('partials.cart-count', 'refreshComponent');
        return $this->emit('success', 'Item Added To Your Cart');
    }
    public function render()
    {
        return view('livewire.product-component');
    }
}
