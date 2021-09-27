<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\CartFromToDatabase;
use Auth;
use Cart;
use Livewire\Component;

class HomeComponent extends Component
{
    use CartFromToDatabase;

    public function render()
    {
        $this->restoreCartFromDatabase();
        return view('livewire.home-component');
    }
}
