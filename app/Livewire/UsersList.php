<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UsersList extends Component
{
    use WithPagination;
    public $query = '';
    #[On('user-created')]
    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function search()
    {
        $this->resetPage();
    }

    public function placeholder()
    {
        return view('livewire.placeholder.skeleton');
    }

    #[Computed()]
    public function users()
    {
        return User::latest()->where('name', 'like', "%{$this->query}%")->paginate(6);
    }

    public function render()
    {
        return view('livewire.users-list',);
    }
}
