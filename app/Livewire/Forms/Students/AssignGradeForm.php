<?php

namespace App\Livewire\Forms\Students;

use App\Models\Student;
use App\Models\Subject;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AssignGradeForm extends Form
{
    public ?Student $student = null;
    public $gradeNames = ['Nota 1', 'Nota 2', 'Nota 3', 'Nota 4', 'Nota 5'];

    public $grades = [];
    public $subject_id;

    protected $rules = [
        'subject_id' => 'required|exists:subjects,id',
        'grades' => 'required|array',
        'grades.*' => 'nullable|numeric|min:0|max:5',
    ];

    public function setStudent(Student $student)
    {
        $this->student = $student;
    }

    public function setGrades()
    {
        $grades = $this->student->grades()
            ->where('subject_id', $this->subject_id)
            ->orderBy('name')
            ->get();

        foreach ($grades as $grade) {
            $index = array_search($grade->name, $this->gradeNames);
            if ($index !== false) {
                $this->grades[$index] = $grade->grade;
            }
        }
    }


    public function save()
    {
        $this->validate();

        foreach ($this->grades as $grade) {

            $gradeIndex = array_search($grade, $this->grades);
            $gradeName = $this->gradeNames[$gradeIndex] ?? 'Nota';


            $this->student->grades()->updateOrCreate(
                [
                    'subject_id' => $this->subject_id,
                    'name' => $gradeName
                ],
                ['grade' => $grade]
            );
        }

    }
}
