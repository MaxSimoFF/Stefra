<?php

namespace App\Http\Livewire\Partials;

use Livewire\Component;

class CartCount extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function render()
    {
        return view('livewire.partials.cart-count');
    }
}
