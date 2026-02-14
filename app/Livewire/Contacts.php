<?php

namespace App\Livewire;

use App\Livewire\Forms\ContactForm;
use App\Models\Contact;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Contact Page')]
class Contacts extends Component
{
    public ContactForm $form;
    public function createMessage()
    {
        $this->form->store();

        session()->flash('success', 'Message send successfully');
    }
    public function render()
    {
        return view('livewire.contacts');
    }
}
