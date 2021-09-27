<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\CartFromToDatabase;
use App\Models\Category;
use Auth;
use Cart;
use Livewire\Component;

class StoreComponent extends Component
{
    use CartFromToDatabase;
    public $categories;
    public function mount()
    {
        $this->categories = Category::all();
        $this->restoreCartFromDatabase();
    }
    public function render()
    {
        return view('livewire.store-component');
    }
}
