<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\Shop;
use App\Models\Category;
use Livewire\Component;

class CategoryComponent extends Component
{
    use Shop;
    public $category;
    public function mount($slug)
    {
        $this->category = Category::where('slug', '=', $slug)->with('products')->first();
        if (!$this->category) abort(404);
        $this->mountComponent();
    }

    public function render()
    {
        return view('livewire.category-component');
    }
}
