<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Subject;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'name' => 'Rodrigo',
                'email' => 'rodrigo@example.com',
                'password' => User::generatePassword('Rodrigo', '12345678'),
                'role' => 'teacher',
                'document' => '12345678'
            ],
            [
                'name' => 'Helena',
                'email' => 'helena@example.com',
                'password' => User::generatePassword('Helena', '87654321'),
                'role' => 'teacher',
                'document' => '87654321'
            ],
            [
                'name' => 'Emilio',
                'email' => 'emilio@example.com',
                'password' => User::generatePassword('Emilio', '11223344'),
                'role' => 'teacher',
                'document' => '11223344'
            ],
            [
                'name' => 'Marthin',
                'email' => 'marthin@example.com',
                'password' => User::generatePassword('Marthin', '44332211'),
                'role' => 'teacher',
                'document' => '44332211'
            ],
        ];

        $subjects = [
            'Matemática' => 'Rodrigo',
            'Artística' => 'Helena',
            'Ed. Física' => 'Emilio',
            'Inglés' => 'Marthin',
        ];

        foreach ($teachers as $teacherData) {
            $teacher = User::create($teacherData);
            $subjectName = array_search($teacher->name, $subjects);
            if ($subjectName !== false) {
                Subject::create(['name' => $subjectName, 'user_id' => $teacher->id]);
            }
        }
    }
}
