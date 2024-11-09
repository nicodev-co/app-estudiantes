<x-modal name="confirmDeleteModal">
    <div class="p-4">
        <h1 class="text-2xl font-bold mb-4">Confirmar Eliminación</h1>
        <p>¿Estás seguro de que deseas eliminar a {{ $studentToDelete?->name }}?</p>
        <div class="mt-4 flex justify-end">
            <button wire:click="closeConfirmDelete" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700 mr-2">Cancelar</button>
            <button wire:click="delete" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Eliminar</button>
        </div>
    </div>
</x-modal>
