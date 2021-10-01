<?php

namespace App\Http\Livewire\Admin;

use App\Models\ContactUs;
use Livewire\Component;
use Livewire\WithPagination;

class AdminContact extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $contacts = ContactUs::orderBy('created_at', 'desc')->paginate(5);
        return view('livewire.admin.admin-contact', compact('contacts'))
            ->layout('layouts.admin');
    }
}
