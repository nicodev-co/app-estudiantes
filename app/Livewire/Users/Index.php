<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\Users\UserForm;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $title = "Crear Usuario";

    public UserForm $form;

    public function render()
    {
        return view('livewire.users.index',[
            'users' => User::where('name', 'like', '%'.$this->search.'%')->paginate(10)
        ]);
    }

    public function create()
    {
        $this->form->reset();

        $this->reset('title');
    }

    public function edit(User $user)
    {
        $this->form->setUser($user);

        $this->title = "Editar Usuario";
    }

    public function save()
    {
        $this->form->save();

        $this->close();
    }

    public function close()
    {
        $this->form->reset();
        $this->reset('title');

        $this->dispatch('close-modal','userModal');
    }
}
