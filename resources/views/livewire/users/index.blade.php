<div>
    <div class="container mx-auto mt-4">
        <div class="flex justify-end mb-4">
            <button @click="$dispatch('open-modal','userModal')" wire:click="create"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Crear Usuario</button>
        </div>

        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="w-1/2 py-2">Nombre</th>
                    <th class="w-1/2 py-2">Rol</th>
                    <th class="w-1/2 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $user->name }}</td>
                        <td class="py-2 px-4">{{ $user->role }}</td>
                        <td class="py-2 px-4">
                            <button @click="$dispatch('open-modal','userModal')" wire:click="edit({{ $user->id }})"
                                class="bg-yellow-500 text-white px-3 py-1 rounded-full hover:bg-yellow-700 transition duration-300 ease-in-out">Editar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>

    <x-modal name="userModal">
        <div class="p-4">
            <h1 class="text-2xl font-bold mb-4">{{ $title }}</h1>
            <form wire:submit="save">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre: <span class="text-red-500">*</span></label>
                    <input wire:model="form.name" type="text" name="name" id="name"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('form.name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="document" class="block text-sm font-medium text-gray-700">Documento:  <span class="text-red-500">*</span></label>
                    <input wire:model="form.document" type="number" name="document" id="document" maxlength="10"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('form.document')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input wire:model="form.email" type="email" name="email" id="email"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('form.email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700">Rol: </label>
                    <select wire:model="form.role" name="role" id="role"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Seleccione un rol</option>
                        <option value="teacher">Teacher</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('form.role')
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
