<?php

namespace App\Livewire\Students;

use App\Livewire\Forms\Students\AssignGradeForm;
use App\Livewire\Forms\Students\StudentForm;
use App\Models\Student;
use App\Models\Subject;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $title = "Crear Estudiante";

    public StudentForm $form;
    public AssignGradeForm $assignGradeForm;
    public $studentToDelete;
    public $studentToAssignGrade;
    public $grades = [];
    public $pdfUrl;
    public $subject = null;
    public $subjects = [];

    public function mount(Subject $subject)
    {
        $this->subject = $subject;
        $this->subjects = Subject::when(auth()->user()->isTeacher(), fn($q) => $q->where('user_id', auth()->id()))->get();
    }

    public function render()
    {
        return view('livewire.students.index', [
            'students' => Student::whenIsTeacher()->when($this->subject->id,function($q) {
                return $q->whereHas('subjects', function ($q) {
                    $q->where('subject_id', $this->subject->id);
                });
            })->paginate(10),

        ]);
    }

    public function create()
    {
        $this->form->reset();

        $this->reset('title');
    }

    public function edit(Student $student)
    {
        $this->form->setStudent($student);

        $this->title = "Editar Estudiante";
    }

    public function save()
    {
        $this->form->save();

        $this->close();
    }

    public function confirmDelete(Student $student)
    {
        $this->studentToDelete = $student;
    }

    public function delete()
    {
        $this->studentToDelete->delete();

        $this->dispatch('close-modal', 'confirmDeleteModal');
    }

    public function closeConfirmDelete()
    {
        $this->dispatch('close-modal', 'confirmDeleteModal');
        $this->reset('studentToDelete');
    }

    public function assignGrade(Student $student)
    {
        $this->studentToAssignGrade = $student;
        $this->assignGradeForm->reset();
        $this->assignGradeForm->setStudent($student);
        $this->subjects = $student->subjects()
        ->when(auth()->user()->isTeacher(), fn($q) => $q->where('user_id', auth()->id()))
        ->when($this->subject->id,fn($q) => $q->where('subjects.id',$this->subject->id))->get();
    }

    public function showGrades(Student $student)
    {
        $this->studentToAssignGrade = $student;

        $grades = $student->grades()->with('subject')
        ->when(auth()->user()->isTeacher(),function($query) {
            $query->whereHas('subject', function ($query) {
                $query->where('user_id', auth()->id());
            });
        })->get();
        $this->grades = $grades->map(function ($grade) {
            return [
                'id' => $grade->id,
                'subject' => $grade->subject->name,
                'name' => $grade->name,
                'grade' => $grade->grade,
            ];
        })->groupBy('subject');
    }

    public function changeSubject()
    {
        $this->assignGradeForm->setGrades();
    }

    public function saveGrade()
    {
        $this->assignGradeForm->save();

        $this->assignGradeForm->reset();
        $this->dispatch('close-modal', 'assignGradeModal');
    }

    public function close()
    {
        $this->form->reset();
        $this->reset('title');

        $this->dispatch('close-modal', 'studentModal');
    }

    public function showCertificate($studentId)
    {
        $this->pdfUrl = route('students.certificate', $studentId);
    }
}
