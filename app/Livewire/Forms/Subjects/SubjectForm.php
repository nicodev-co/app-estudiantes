<?php

namespace App\Livewire\Forms\Subjects;

use App\Models\Subject;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SubjectForm extends Form
{
    public ?Subject $subject = null;

    #[Validate('required',message: 'El nombre es requerido.')]
    public $name = '';

    #[Validate('required', message: 'El profesor es requerido.')]
    public $teacher_id = '';

    public function setSubject(Subject $subject)
    {
        $this->subject = $subject;
        $this->name = $subject->name;
        $this->teacher_id = $subject->user_id;
    }

    public function save()
    {
        $this->validate();

        Subject::updateOrCreate(['id' => $this->subject?->id], [
            'name' => $this->name,
            'user_id' => $this->teacher_id,
        ]);
    }
}
