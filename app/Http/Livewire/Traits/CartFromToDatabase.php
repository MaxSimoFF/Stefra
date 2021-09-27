<?php

namespace App\Http\Livewire\Traits;

use Auth;
use Cart;

trait CartFromToDatabase
{
    public function storeCartToDatabase()
    {
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
        }
    }

    public function restoreCartFromDatabase()
    {
        if (Auth::check()) {
            Cart::instance('cart')->restore(Auth::user()->email);
        }
    }
}
