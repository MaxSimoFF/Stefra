<?php

namespace App\Http\Livewire\Partials;

use App\Models\Product;
use Livewire\Component;

class ProductsMayAlsoLike extends Component
{
    public $mayLikesItems;
    public $product;
    public $products;
    public function mount($product = null, $products = null)
    {
        $this->mayLikesItems = Product::all();
    }
    public function render()
    {
        return view('livewire.partials.products-may-also-like');
    }
}
