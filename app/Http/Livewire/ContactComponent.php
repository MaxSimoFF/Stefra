<?php

namespace App\Http\Livewire;

use App\Models\ContactUs;
use Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Event;

class ContactComponent extends Component
{
    public $name, $email, $phone, $message;

    protected $rules = [
        'name'      => 'required|string|max:255',
        'email'     => 'required|email',
        'phone'     => 'nullable|string',
        'message'   => 'required|string|max:2000',
    ];

    public function mount()
    {
        if (Auth::check()) {
            $this->name     = Auth::user()->name;
            $this->email    = Auth::user()->email;
        }
    }

    /**
     * @throws ValidationException
     */
    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function sendMessage(): Event
    {
        $this->validate();
        $contact            = new ContactUs;
        $contact->name      = $this->name;
        $contact->email     = $this->email;
        $contact->phone     = $this->phone;
        $contact->message   = $this->message;
        $contact->save();
        $this->reset('phone', 'message');
        return $this->emit('success', 'Message has been sent');
    }

    public function render()
    {
        return view('livewire.contact-component');
    }
}
