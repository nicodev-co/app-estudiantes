<?php

namespace App\Livewire\Forms\Users;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user = null;

    #[Validate('required',message: 'El nombre es requerido.')]
    #[Validate('string',message: 'El nombre debe ser un texto.')]
    #[Validate('max:255',message: 'El nombre no puede tener más de 255 caracteres.')]
    public $name = '';

    #[Validate('nullable')]
    #[Validate('email',message: 'El email debe ser un correo válido.')]
    #[Validate('max:255',message: 'El email no puede tener más de 255 caracteres.')]
    public $email = '';

    #[Validate('required', message: 'El documento es requerido.')]
    #[Validate('string', message: 'El documento debe ser un número.')]
    #[Validate('max:10', message: 'El documento no puede tener más de 10 caracteres.')]
    public $document = '';

    #[Validate('nullable', 'string')]
    public $role = 'user';

    public function setUser(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->document = $user->document;
        $this->role = $user->role;
    }

    public function save()
    {
        $this->validate();

        $password = User::generatePassword($this->name, $this->document);

        User::updateOrCreate(['id' => $this->user?->id], [
            'name' => $this->name,
            'email' => $this->email,
            'document' => $this->document,
            'role' => $this->role,
            'password' => $password,
        ]);
    }
}
