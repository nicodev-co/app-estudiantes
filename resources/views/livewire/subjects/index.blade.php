<div>
    <div class="container mx-auto mt-4">
        <div class="flex justify-end mb-4">
            <button @click="$dispatch('open-modal','subjectModal')" wire:click="create"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Crear Materia</button>
        </div>

        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="w-1/2 py-2">Nombre</th>
                    <th class="w-1/2 py-2">Profesor</th>
                    <th class="w-1/2 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $subject->name }}</td>
                        <td class="py-2 px-4">
                            {{ $subject->teacher->name }}
                        </td>
                        <td class="py-2 px-4">
                            <button @click="$dispatch('open-modal','subjectModal')" wire:click="edit({{ $subject->id }})"
                                class="bg-yellow-500 text-white px-3 py-1 rounded-full hover:bg-yellow-700 transition duration-300 ease-in-out">Editar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $subjects->links() }}
        </div>
    </div>

    <x-modal name="subjectModal">
        <div class="p-4">
            <h1 class="text-2xl font-bold mb-4">{{ $title }}</h1>
            <form wire:submit="save">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre: <span class="text-red-500">*</span></label>
                    <input wire:model="form.name" type="text" name="name" id="name"
                    placeholder="Nombre de la materia"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('form.name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="teacher_id" class="block text-sm font-medium text-gray-700">Profesor: <span class="text-red-500">*</span></label>
                    <select wire:model="form.teacher_id" name="teacher_id" id="teacher_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Seleccione un profesor</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                    @error('form.teacher_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
                </div>
            </form>
        </div>
    </x-modal>
</div>
