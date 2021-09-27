<?php

namespace App\Http\Livewire\Partials;

use App\Http\Livewire\Traits\CartFromToDatabase;
use Livewire\Component;

class CartCount extends Component
{
    use CartFromToDatabase;
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        $this->restoreCartFromDatabase();
        return view('livewire.partials.cart-count');
    }
}
