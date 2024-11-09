<x-modal name="assignGradeModal">
    <div class="p-4">
        <div class="flex items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Asignar Nota</h1>
            <svg class="ml-2 w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5v14"></path>
            </svg>
        </div>
        <div class="flex items-center mb-4">
            <p class="text-gray-600">Por favor, asigna las notas correspondientes a las materias del estudiante.</p>
        </div>

        @if ($studentToAssignGrade?->subjects->count() > 0)
            <div class="mb-4">
                <h2 class="text-xl font-semibold">Estudiante: {{ $studentToAssignGrade->name }}</h2>
            </div>
            <form wire:submit.prevent="saveGrade">
                <div class="mb-4">
                    <label for="subject" class="block text-sm font-medium text-gray-700">Materia</label>
                    <select wire:change="changeSubject" wire:model="assignGradeForm.subject_id" id="subject" name="subject"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Seleccione una materia</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    @error('assignGradeForm.subject_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                @error('assignGradeForm.grades')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                @for ($i = 0; $i < 5; $i++)
                    <div class="mb-4">
                        <label for="grade{{ $i }}" class="block text-sm font-medium text-gray-700">Nota {{ $i + 1 }}</label>
                        <input wire:model="assignGradeForm.grades.{{ $i  }}" type="number" name="grade{{ $i }}" id="grade{{ $i }}" step="0.01" min="0" max="5"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" >
                        @error('grades.' . $i)
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                @endfor
                <div class="mb-4">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
                </div>
            </form>
        @else
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                <p class="font-bold">Atención</p>
                <p>El estudiante no tiene materias asignadas.</p>
            </div>
        @endif

    </div>
</x-modal>
