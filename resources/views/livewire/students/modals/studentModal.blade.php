<x-modal name="studentModal">
    <div class="p-4">
        <h1 class="text-2xl font-bold mb-4">{{$title}}</h1>
        <form wire:submit="save">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input wire:model="form.name" type="text" name="name" id="name"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('form.name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

            </div>
            <div class="mb-4">
                <label for="subjects" class="block text-sm font-medium text-gray-700">Materias</label>
                @foreach ($subjects as $subject)
                    <div class="flex items-center mb-2">
                        <input wire:model="form.subjects" type="checkbox" name="subjects[]" id="subject{{ $subject->id }}" value="{{ $subject->id }}"
                            class="mr-2 rounded border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <label for="subject{{ $subject->id }}" class="text-sm text-gray-700">{{ $subject->name }}</label>
                    </div>
                @endforeach
                @error('form.subjects')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
            </div>
        </form>
    </div>
</x-modal>
