<div>
    <div class="container mx-auto mt-4">
        <div class="flex justify-end mb-4">
            @can('isAdmin')
                <button @click="$dispatch('open-modal','studentModal')" wire:click="create"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Crear Estudiante</button>
            @endcan

        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Nombre</th>
                        <th class="py-3 px-4 text-left">Promedio</th>
                        <th class="py-3 px-4 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($students as $student)
                        <tr class="hover:bg-gray-100 transition duration-150 ease-in-out">
                            <td class="py-3 px-4">{{ $student->name }}</td>
                            <td class="py-3 px-4">{{ $student->promedio($subject) }}</td>
                            <td class="py-3 px-4">
                                <div class="flex space-x-2">
                                    @if ($student->grades->count() > 0)
                                        <button @click="$dispatch('open-modal','gradesModal')"
                                            wire:click="showGrades({{ $student->id }})"
                                            class="bg-blue-500 text-white px-3 py-1 rounded-full hover:bg-blue-700 transition duration-300 ease-in-out">Ver
                                            Notas</button>
                                    @endif

                                    <button @click="$dispatch('open-modal','assignGradeModal')"
                                        wire:click="assignGrade({{ $student->id }})"
                                        class="bg-green-500 text-white px-3 py-1 rounded-full hover:bg-green-700 transition duration-300 ease-in-out">Asignar
                                        Nota</button>
                                    @can('isAdmin')
                                        <button @click="$dispatch('open-modal','studentModal')"
                                            wire:click="edit({{ $student->id }})"
                                            class="bg-yellow-500 text-white px-3 py-1 rounded-full hover:bg-yellow-700 transition duration-300 ease-in-out">Editar</button>
                                        <button @click="$dispatch('open-modal','confirmDeleteModal')"
                                            wire:click="confirmDelete({{ $student->id }})"
                                            class="bg-red-500 text-white px-3 py-1 rounded-full hover:bg-red-700 transition duration-300 ease-in-out">Eliminar</button>
                                    @endcan


                                    @if ($student->grades->avg('grade') >= 4.5)
                                        <button @click="$dispatch('open-modal','certificateModal')"
                                            wire:click="showCertificate({{ $student->id }})"
                                            class="bg-purple-500 text-white px-3 py-1 rounded-full hover:bg-purple-700 transition duration-300 ease-in-out">Ver
                                            Certificado</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $students->links() }}
        </div>
    </div>

    <x-modal name="certificateModal" class="w-full overflow-hidden">
        <div class="p-4" style="height: 600px">
            <iframe src="{{ $pdfUrl }}" class="w-full h-full"></iframe>
        </div>
    </x-modal>

    @can('isAdmin')
        @include('livewire.students.modals.studentModal')
        @include('livewire.students.modals.confirmDeleteModal')
    @endcan

    @include('livewire.students.modals.assignGradeModal')
    @include('livewire.students.modals.gradesModal')
</div>
