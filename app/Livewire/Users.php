<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Users extends Component
{
    use WithFileUploads, WithPagination;

    public $query = '';


    #[Validate('required|min:3')]
    public $name = '';
    #[Validate('required|email:dns|unique:users')]
    public $email = '';
    #[Validate('required|min:6')]
    public $password = '';
    #[Validate('image|max:5000')]
    public $avatar;

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function search()
    {
        $this->resetPage();
    }


    public function createNewUser()
    {

        $validated =  $this->validate();

        if ($this->avatar) {
            $validated['avatar'] = $this->avatar->store('avatar', 'public');
        }

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'avatar' => $validated['avatar']
        ]);

        // $this->reset(['name', 'email', 'password']);
        $this->reset();

        session()->flash('success', 'User successfully created');
    }

    public function render()
    {

        return view('users', [
            'title' => 'Users Page',
            'users' => User::latest()->where('name', 'like', "%{$this->query}%")->paginate(6),
        ]);
    }
}
