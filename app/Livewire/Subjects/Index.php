<?php

namespace App\Livewire\Subjects;

use App\Livewire\Forms\Subjects\SubjectForm;
use App\Models\Subject;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $title = 'Crear Materia';

    public SubjectForm $form;

    public function render()
    {
        return view('livewire.subjects.index', [
            'subjects' => Subject::paginate(10),
            'teachers' => User::where('role', 'teacher')->get(),
        ]);
    }

    public function create()
    {
        $this->form->reset();

        $this->reset('title');
    }

    public function edit(Subject $subject)
    {
        $this->form->setSubject($subject);

        $this->title = 'Editar Materia';
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

        $this->dispatch('close-modal','subjectModal');
    }
}
