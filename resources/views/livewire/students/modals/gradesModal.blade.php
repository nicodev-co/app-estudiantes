<x-modal name="gradesModal">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Notas del Estudiante</h2>
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-700">{{ $studentToAssignGrade?->name }}</h3>
        </div>
        @foreach ($grades as $subject => $subjectGrades)
            <div class="mb-6">
                <h4 class="text-lg font-semibold mb-3 text-gray-600">{{ $subject }}</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-gray-200">
                            <tr>
                                @foreach ($subjectGrades->sortBy('name') as $grade)
                                    <th class="py-3 px-5 text-left text-gray-700 font-bold">{{ $grade['name'] }}</th>
                                @endforeach
                                <th class="py-3 px-5 text-left text-gray-700 font-bold">Promedio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t">
                                @foreach ($subjectGrades->sortBy('name') as $grade)
                                    <td class="py-3 px-5 text-gray-600">{{ $grade['grade'] }}</td>
                                @endforeach
                                <td class="py-3 px-5 text-gray-600">{{ number_format($subjectGrades->avg('grade'),2)  }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</x-modal>
