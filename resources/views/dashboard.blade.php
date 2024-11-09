<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-100 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Materias Asignadas</h3>
                    <ul class="mt-4 space-y-4">
                        @foreach ($subjects as $materia)
                            <li class="p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-xl font-semibold text-gray-800">{{ $materia->name }}</h4>
                                        <p class="text-gray-600">{{ $materia->students->count() }} estudiantes</p>
                                        <p class="text-gray-600">Promedio de notas: {{ $materia->grades->avg('grade') ?? 0}}</p>
                                    </div>
                                    <div class="text-right">
                                        <a href="{{route('students.index',$materia->id)}}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Ver detalles</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
