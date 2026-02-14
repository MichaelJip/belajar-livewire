<?php

namespace App\Livewire\Forms;

use App\Models\Contact;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ContactForm extends Form
{
    #[Validate('required|email:dns')]
    public $email = '';
    #[Validate('required|min:5')]
    public $subject = '';
    #[Validate('required|min:5')]
    public $message = '';

    public function store()
    {
        $this->validate();

        Contact::create($this->all());

        $this->reset();

    }
}
