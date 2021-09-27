<?php

namespace App\Http\Livewire\Traits;

use App\Models\Product;
use Cart;
use Livewire\Event;

trait Shop
{
    use CartFromToDatabase;

    /**
     * @param $prod_id
     * @return Event
     */
    public function addToCart($prod_id): Event
    {
        $product = Product::find($prod_id);
        if(!$product) return $this->emit('error', 'Something happened throw the request please try again later.');
        Cart::instance('cart')->add($prod_id, $product->name, 1, $product->price)->associate('App\Models\Product');
        $this->storeCartToDatabase();
        $this->emitTo('partials.cart-count', 'refreshComponent');
        return $this->emit('success', 'Item Added To Your Cart');
    }

    /**
     * @param $product_id
     */
    public function removeFromCart($product_id)
    {
        foreach(Cart::instance('cart')->content() as $wItem)
        {
            if($wItem->id == $product_id)
            {
                Cart::instance('cart')->remove($wItem->rowId);
                $this->storeCartToDatabase();
//                $this->emitTo('partials.cart-count-component', 'refreshComponent');
                $this->emit('success', 'Item Removed From Your Cart');
            }
        }
    }

}
