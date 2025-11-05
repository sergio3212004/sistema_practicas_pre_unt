<x-app-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h1 class="text-2xl font-bold text-gray-900">Panel de Alumno</h1>
            <p class="text-gray-600 mt-1">Gestiona tu ficha de registro y cronograma de actividades.</p>
        </div>

        <!-- Sección: Descargar ficha de registro -->
        <div class="bg-white rounded-lg shadow-sm p-6 space-y-4">
            <h2 class="text-xl font-semibold text-gray-800">Ficha de Registro</h2>
            <p class="text-gray-600">Descarga el formato de ficha de registro para completarlo y firmarlo.</p>

            <a href="{{ route('alumno.ficha.descargar') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
                Descargar Formato
            </a>

            @if($ficha ?? false)
                <p class="mt-2 text-gray-700">
                    Estado de la ficha:
                    @if($ficha->estado === 'aceptado')
                        <span class="text-green-600 font-semibold">Aprobada ✔</span>
                    @elseif($ficha->estado === 'enviado')
                        <span class="text-blue-600 font-semibold">Enviada</span>
                    @elseif($ficha->estado === 'rechazado')
                        <span class="text-red-600 font-semibold">Rechazada ❌</span>
                    @else
                        <span class="text-gray-500 font-semibold">Pendiente</span>
                    @endif
                </p>
            @endif
        </div>

        <!-- Sección: Subir Cronograma -->
        <div class="bg-white rounded-lg shadow-sm p-6 space-y-4">
            <h2 class="text-xl font-semibold text-gray-800">Cronograma de Actividades</h2>
            <p class="text-gray-600">
                Sube tu cronograma completado y previamente firmado según el formato proporcionado para revisión del profesor.
            </p>

            <form action="{{ route('alumno.cronograma.subir') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label for="cronograma" class="block text-sm font-medium text-gray-700">Selecciona tu archivo</label>
                    <input type="file" name="cronograma" id="cronograma"
                           class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           accept=".pdf,.doc,.docx">
                    @error('cronograma')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-700 transition">
                        Enviar Cronograma
                    </button>
                </div>
            </form>

            @if($cronograma ?? false)
                <p class="mt-2 text-gray-700">
                    Estado del cronograma:
                    @if($cronograma->estado === 'aceptado')
                        <span class="text-green-600 font-semibold">Aprobado ✔</span>
                    @elseif($cronograma->estado === 'enviado')
                        <span class="text-blue-600 font-semibold">Enviado</span>
                    @elseif($cronograma->estado === 'rechazado')
                        <span class="text-red-600 font-semibold">Rechazado ❌</span>
                    @else
                        <span class="text-gray-500 font-semibold">Pendiente</span>
                    @endif
                </p>
            @endif
        </div>
    </div>
</x-app-layout>
