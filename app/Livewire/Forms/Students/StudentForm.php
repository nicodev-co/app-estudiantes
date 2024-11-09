<?php

namespace App\Livewire\Forms\Students;

use App\Models\Student;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StudentForm extends Form
{
    public ?Student $student = null;

    public $name = '';

    public $subjects = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'subjects.*' => 'nullable',
    ];

    protected $messages = [
        'name.required' => 'El campo nombre es requerido.',
    ];

    public function setStudent(Student $student)
    {
        $this->student = $student;
        $this->name = $student->name;
        $this->subjects = $student->subjects->pluck('id')->toArray();
    }


    public function save()
    {
        $this->validate();

        $student = Student::updateOrCreate(['id' => $this->student?->id], [
            'name' => $this->name,
        ]);


        $student->subjects()->sync($this->subjects);
    }
}
