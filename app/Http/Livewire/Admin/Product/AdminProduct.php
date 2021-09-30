<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AdminProduct extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $name, $slug, $image, $desc, $details, $price, $quantity, $stock_status = 'instock', $category_id = 1, $old_image, $product_edit;

    public $editableModal;


    protected $rules = [
        'name'          => 'required|string|max:255',
        'slug'          => 'required|min:2|max:255|unique:products',
        'image'         => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        'desc'          => 'required|string|min:1|max:65536',
        'details'       => 'nullable|string|min:1|max:65536',
        'price'         => 'required|numeric|min:0',
        'quantity'      => 'required|integer|min:0',
        'stock_status'  => 'required|in:instock,outstock',
        'category_id'   => 'required|integer|numeric|min:0',
    ];

    /**
     * @param $id
     * @return string[]
     */
    private function editRules($id): array
    {
        return [
            'name'          => 'required|string|max:255',
            'slug'          => 'required|min:2|max:255|unique:products,slug,'. $id,
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'desc'          => 'required|string|min:1|max:65536',
            'details'       => 'nullable|string|min:1|max:65536',
            'price'         => 'required|numeric|min:0',
            'quantity'      => 'required|integer|min:0',
            'stock_status'  => 'required|in:instock,outstock',
            'category_id' => 'required|integer|numeric|min:0',
        ];
    }


    /**
     * @throws ValidationException
     */
    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function resetInputFields()
    {
        $this->reset('name', 'slug', 'image', 'desc', 'price', 'quantity', 'old_image', 'product_edit');
        $this->resetErrorBag();
        $this->editableModal = false;
    }

    /**
     * @throws ValidationException
     */
    public function generateSlug($slugForEdit = false): array
    {
        $this->slug = Str::slug($this->name);
        if($slugForEdit)
            return $this->validateOnly('slug', self::editRules($this->product_edit->id));
        return $this->validateOnly('slug');
    }

    public function addProduct()
    {
        $this->validate();
        $imageName = $this->image->store('products', 'public');
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->image = 'storage/' . $imageName;
        $product->desc = $this->desc;
        $product->details = $this->details;
        $product->price = $this->price;
        $product->quantity = $this->quantity;
        $product->stock_status = $this->stock_status;
        $product->category_id = $this->category_id;
        $product->save();
        $this->reset();
        $this->emit('closeModal');
        $this->emit('success', 'Product Added successfully');
    }
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            if (file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $product->delete();
            return $this->emit('success', 'Product Deleted Successfully');
        }
        return $this->emit('error', 'Something went wrong please try again');
    }
    public function showEdit($id)
    {
        $this->product_edit = Product::find($id);
        if (!$this->product_edit) return $this->emit('something went wrong please try again');
        $this->name = $this->product_edit->name;
        $this->slug = $this->product_edit->slug;
        $this->old_image = $this->product_edit->image;
        $this->desc = $this->product_edit->desc;
        $this->details = $this->product_edit->details;
        $this->price = $this->product_edit->price;
        $this->quantity = $this->product_edit->quantity;
        $this->stock_status = $this->product_edit->stock_status;
        $this->category_id = $this->product_edit->category_id;
        $this->editableModal = true;
        return $this->emit('openModal');
    }
    public function editProduct()
    {
        $this->validate(self::editRules($this->product_edit->id));
        if($this->image) {
            if(file_exists(public_path($this->product_edit->image))) unlink(public_path($this->product_edit->image));
            $imageName = 'storage/' . $this->image->store('products', 'public');
        } else {
            $imageName = $this->product_edit->image;
        }
        $product           = Product::find($this->product_edit->id);
        if(!$product) return $this->emit('error', 'Something went wrong please try again');

        $product->name  = $this->name;
        $product->slug  = $this->slug;
        $product->image = $imageName;
        $product->desc  = $this->desc;
        $product->details = $this->details;
        $product->price = $this->price;
        $product->quantity  = $this->quantity;
        $product->stock_status  = $this->stock_status;
        $product->category_id   = $this->category_id;
        $product->save();
        $this->reset();
        $this->emit('closeModal');
        return $this->emit('success', 'Saved!');
    }
    public function render()
    {
        $products = Product::with('category')->paginate(config('custom.paginate.product'));
        $categories = Category::all();
        return view('livewire.admin.product.admin-product', compact('products', 'categories'))
            ->layout('layouts.admin');
    }
}
