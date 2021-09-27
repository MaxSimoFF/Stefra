<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Event;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AdminCategory extends Component
{
    use WithPagination;
    use WithFileUploads;

    /**
     * @var string
     */
    protected $paginationTheme = 'bootstrap';

    public $name, $slug, $image, $new_image, $activeEdit, $category_edit;

    /**
     * @var string[]
     */
    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|unique:categories',
        'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp'
    ];

    /**
     * @param $id
     * @return string[]
     */
    private function editRules($id): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug,'. $id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp'
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
        $this->reset();
        $this->activeEdit = null;
    }

    /**
     * @throws ValidationException
     */
    public function generateSlug($slugForEdit = false): array
    {
        $this->slug = Str::slug($this->name);
        if($slugForEdit)
            return $this->validateOnly('slug', self::editRules($this->category_edit->id));
        return $this->validateOnly('slug');
    }

    /**
     * @param $id
     * @return Event
     */
    public function showEdit($id): Event
    {
        $this->category_edit = Category::find($id);
        if (!$this->category_edit) return $this->emit('something went wrong please try again');
        $this->name = $this->category_edit->name;
        $this->slug = $this->category_edit->slug;
        $this->new_image = $this->category_edit->image;
        $this->activeEdit = 1;
        return $this->emit('openModal');
    }

    /**
     * @return Event
     */
    public function editCategory(): Event
    {
        $this->validate(self::editRules($this->category_edit->id));
        if($this->image) {
            if(file_exists(public_path($this->category_edit->image))) unlink(public_path($this->category_edit->image));
            $imageName = 'storage/' . $this->image->store('categories', 'public');
        } else {
            $imageName = $this->category_edit->image;
        }

        $category           = Category::find($this->category_edit->id);
        if(!$category) return $this->emit('error', 'Something went wrong please try again');
        $category->name     = $this->name;
        $category->slug     = $this->slug;
        $category->image    = $imageName;
        $category->save();
        $this->emit('closeModal');
        $this->resetInputFields();
        return $this->emit('success', 'Saved!');
    }

    /**
     *
     */
    public function addCategory()
    {
        $this->validate();
        $imageName = $this->image->store('categories', 'public');
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->image = 'storage/' . $imageName;
        $category->save();
        $this->reset('name', 'slug', 'image');
        $this->emit('closeModal');
        $this->emit('success', 'Category Added successfully');
    }

    /**
     * @param $id
     * @return Event
     */
    public function deleteCategory($id): Event
    {
        $category = Category::find($id);
        if ($category) {
            if (file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }
            $category->delete();
            return $this->emit('success', 'Category Deleted Successfully');
        }
        return $this->emit('error', 'Something went wrong please try again');
    }

    /**
     * @return mixed
     */
    public function render()
    {
        $categories = Category::paginate(config('custom.paginate.category'));
        return view('livewire.admin.category.admin-category', compact('categories'))
            ->layout('layouts.admin');
    }
}
