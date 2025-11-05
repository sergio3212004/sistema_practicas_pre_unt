<x-app-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Mis Alumnos Asignados</h1>
                    <p class="text-gray-600 mt-1">
                        Profesor: <span class="font-semibold">{{ $profesor->nombres }}</span>
                    </p>
                </div>
                <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg">
                    <span class="text-2xl font-bold">{{ $alumnos->count() }}</span>
                    <span class="text-sm ml-1">{{ $alumnos->count() === 1 ? 'Alumno' : 'Alumnos' }}</span>
                </div>
            </div>
        </div>

        <!-- Lista de Alumnos -->
        @if($alumnos->isEmpty())
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No tienes alumnos asignados</h3>
                <p class="mt-1 text-gray-500">Aún no se te han asignado alumnos para supervisar.</p>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <!-- Tabla para desktop -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre Completo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo Electrónico</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($alumnos as $alumno)
                            @php
                                $ficha = $alumno->profesorAsignado->fichaRegistro ?? null;
                                $cronogramas = $ficha ? $ficha->cronogramas : collect();
                                function estadoClass($estado) {
                                    return match($estado) {
                                        'aceptado' => 'bg-green-100 text-green-800',
                                        'enviado' => 'bg-blue-100 text-blue-800',
                                        'rechazado' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-500',
                                    };
                                }
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $alumno->codigo_matricula }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $alumno->nombres }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $alumno->user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2 flex flex-wrap items-center gap-2">
                                    <!-- Ficha -->
                                    @if($ficha)
                                        <span class="px-2 py-1 rounded {{ estadoClass($ficha->estado) }} text-sm font-semibold">
                                            {{ ucfirst($ficha->estado) }}
                                        </span>
                                    @else
                                        <span class="px-2 py-1 rounded bg-gray-100 text-gray-500 text-sm font-semibold">Pendiente</span>
                                    @endif

                                    <!-- Cronograma -->
                                    @if($ficha && $cronogramas->isNotEmpty())
                                        @php
                                            $allCronogramasAceptados = $cronogramas->every(fn($c) => $c->estado === 'aceptado');
                                        @endphp
                                        @if($allCronogramasAceptados)
                                            <a href="{{ route('cronograma.ver', $ficha->id) }}" class="px-2 py-1 rounded bg-blue-100 text-blue-800 text-sm font-medium hover:bg-blue-200">Ver cronograma</a>
                                        @else
                                            <span class="px-2 py-1 rounded bg-gray-100 text-gray-500 text-sm font-semibold">Cronograma pendiente</span>
                                        @endif
                                    @else
                                        <span class="px-2 py-1 rounded bg-gray-100 text-gray-500 text-sm font-semibold">Cronograma no enviado</span>
                                    @endif

                                    <!-- Reporte -->
                                    @if($ficha && $ficha->estado === 'aceptado' && $cronogramas->every(fn($c) => $c->estado === 'aceptado'))
                                        <a href="{{ route('reporte.ver', $alumno->id) }}" class="px-2 py-1 rounded bg-green-100 text-green-800 text-sm font-medium hover:bg-green-200">Ver reporte</a>
                                    @else
                                        <span class="px-2 py-1 rounded bg-gray-100 text-gray-500 text-sm font-semibold">Reporte no disponible</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Cards para móvil -->
                <div class="md:hidden divide-y divide-gray-200">
                    @foreach($alumnos as $alumno)
                        @php
                            $ficha = $alumno->profesorAsignado->fichaRegistro ?? null;
                            $cronogramas = $ficha ? $ficha->cronogramas : collect();
                        @endphp
                        <div class="p-4 hover:bg-gray-50 transition-colors space-y-1">
                            <div class="text-sm font-medium text-gray-900">{{ $alumno->nombres }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}</div>
                            <div class="text-xs text-gray-500">Código: {{ $alumno->codigo_matricula }}</div>
                            <div class="text-xs text-gray-500">Email: {{ $alumno->user->email }}</div>

                            <div class="flex flex-col space-y-1 mt-2 text-sm">
                                <!-- Ficha -->
                                @if($ficha)
                                    <span class="px-2 py-1 rounded {{ estadoClass($ficha->estado) }} text-sm font-semibold">
                                        {{ ucfirst($ficha->estado) }}
                                    </span>
                                @else
                                    <span class="px-2 py-1 rounded bg-gray-100 text-gray-500 text-sm font-semibold">Ficha pendiente</span>
                                @endif

                                <!-- Cronograma -->
                                @if($ficha && $cronogramas->isNotEmpty())
                                    @php
                                        $allCronogramasAceptados = $cronogramas->every(fn($c) => $c->estado === 'aceptado');
                                    @endphp
                                    @if($allCronogramasAceptados)
                                        <a href="{{ route('cronograma.ver', $ficha->id) }}" class="px-2 py-1 rounded bg-blue-100 text-blue-800 text-sm font-medium hover:bg-blue-200">Ver cronograma</a>
                                    @else
                                        <span class="px-2 py-1 rounded bg-gray-100 text-gray-500 text-sm font-semibold">Cronograma pendiente</span>
                                    @endif
                                @else
                                    <span class="px-2 py-1 rounded bg-gray-100 text-gray-500 text-sm font-semibold">Cronograma no enviado</span>
                                @endif

                                <!-- Reporte -->
                                @if($ficha && $ficha->estado === 'aceptado' && $cronogramas->every(fn($c) => $c->estado === 'aceptado'))
                                    <a href="{{ route('reporte.ver', $alumno->id) }}" class="px-2 py-1 rounded bg-green-100 text-green-800 text-sm font-medium hover:bg-green-200">Ver reporte</a>
                                @else
                                    <span class="px-2 py-1 rounded bg-gray-100 text-gray-500 text-sm font-semibold">Reporte no disponible</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
