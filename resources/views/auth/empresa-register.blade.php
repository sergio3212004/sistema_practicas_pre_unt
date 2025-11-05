<x-guest-layout>
    {{-- PESTAÑAS arriba (Registrar empresa activo) --}}
    <div class="-mt-8 -mx-4 px-4 pt-4">
        <div class="flex items-center justify-between">
            <a href="{{ route('login') }}"
               class="inline-flex items-center gap-2 rounded-lg border border-emerald-600 text-emerald-700 px-3 py-1.5 text-sm font-semibold hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-emerald-400 transition">
                Iniciar sesión
            </a>

            <span class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-3 py-1.5 text-sm font-semibold text-white shadow">
                Registrar empresa
            </span>
        </div>
        <div class="mt-3 border-b border-slate-200"></div>
    </div>

    <x-slot name="title">Registro de Empresa</x-slot>
    <x-slot name="subtitle">Crea tu cuenta de empresa</x-slot>

    {{-- Mensajes / errores --}}
    @if (session('status'))
        <div class="mb-4 rounded-md bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-2 text-sm">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="mb-4 rounded-md bg-rose-50 border border-rose-200 text-rose-700 px-4 py-2 text-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('empresa.register.store') }}" class="space-y-6" novalidate>
        @csrf

        {{-- Identificación y catálogo --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700">RUC (11 dígitos)</label>
                <input name="ruc"
                       value="{{ old('ruc') }}"
                       required inputmode="numeric" maxlength="11" pattern="\d{11}"
                       class="mt-1 w-full rounded-lg px-3 py-2 border @error('ruc') border-rose-400 @else border-slate-300 @enderror focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                @error('ruc') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Razón social</label>
                <select name="razon_social_id" required
                        class="mt-1 w-full rounded-lg px-3 py-2 border @error('razon_social_id') border-rose-400 @else border-slate-300 @enderror focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                    <option value="" disabled {{ old('razon_social_id') ? '' : 'selected' }}>Selecciona...</option>
                    @forelse(($razones ?? []) as $rz)
                        <option value="{{ $rz->id }}" {{ old('razon_social_id') == $rz->id ? 'selected' : '' }}>
                            {{ $rz->razon_label ?? ('Opción #'.$rz->id) }}
                        </option>
                    @empty
                        <option value="" disabled>No hay razones sociales cargadas</option>
                    @endforelse
                </select>
                @error('razon_social_id') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Datos de la empresa --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700">Nombre comercial</label>
                <input name="nombre" value="{{ old('nombre') }}" required
                       class="mt-1 w-full rounded-lg px-3 py-2 border @error('nombre') border-rose-400 @else border-slate-300 @enderror focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                @error('nombre') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Teléfono (opcional)</label>
                <input name="telefono" value="{{ old('telefono') }}" inputmode="tel" maxlength="30"
                       class="mt-1 w-full rounded-lg px-3 py-2 border @error('telefono') border-rose-400 @else border-slate-300 @enderror focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                @error('telefono') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Cascada Departamento / Provincia / Distrito (una sola instancia Alpine) --}}
            <div x-data="ubigeo()" x-init="init()" class="grid grid-cols-1 md:grid-cols-2 gap-4 md:col-span-2">
                {{-- Departamento --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700">Departamento</label>
                    <select name="departamento"
                            x-model="dep"
                            @change="onDepChange(dep)"
                            required
                            class="mt-1 w-full rounded-lg px-3 py-2 border @error('departamento') border-rose-400 @else border-slate-300 @enderror focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        <option value="" disabled {{ old('departamento') ? '' : 'selected' }}>Selecciona...</option>
                        <template x-for="d in departamentos" :key="d">
                            <option :value="d" x-text="d"></option>
                        </template>
                    </select>
                    @error('departamento') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Provincia --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700">Provincia</label>
                    <select name="provincia"
                            x-model="prov"
                            :disabled="!dep"
                            @change="onProvChange(prov)"
                            required
                            class="mt-1 w-full rounded-lg px-3 py-2 border @error('provincia') border-rose-400 @else border-slate-300 @enderror focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 disabled:bg-slate-100 disabled:text-slate-400">
                        <option value="" disabled {{ old('provincia') ? '' : 'selected' }}>Selecciona...</option>
                        <template x-for="p in provincias" :key="p">
                            <option :value="p" x-text="p"></option>
                        </template>
                    </select>
                    @error('provincia') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Distrito (2 columnas) --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700">Distrito</label>
                    <select name="distrito"
                            x-model="dist"
                            :disabled="!prov"
                            required
                            class="mt-1 w-full rounded-lg px-3 py-2 border @error('distrito') border-rose-400 @else border-slate-300 @enderror focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 disabled:bg-slate-100 disabled:text-slate-400">
                        <option value="" disabled {{ old('distrito') ? '' : 'selected' }}>Selecciona...</option>
                        <template x-for="dt in distritos" :key="dt">
                            <option :value="dt" x-text="dt"></option>
                        </template>
                    </select>
                    @error('distrito') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700">Dirección</label>
                <input name="direccion" value="{{ old('direccion') }}" autocomplete="street-address" maxlength="255"
                       class="mt-1 w-full rounded-lg px-3 py-2 border @error('direccion') border-rose-400 @else border-slate-300 @enderror focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                @error('direccion') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Credenciales de acceso (users) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700">Correo de acceso</label>
                <input name="email" type="email" value="{{ old('email') }}" required autocomplete="email"
                       class="mt-1 w-full rounded-lg px-3 py-2 border @error('email') border-rose-400 @else border-slate-300 @enderror focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                @error('email') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Contraseña</label>
                <input name="password" type="password" required minlength="8" autocomplete="new-password"
                       class="mt-1 w-full rounded-lg px-3 py-2 border @error('password') border-rose-400 @else border-slate-300 @enderror focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                @error('password') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Confirmar contraseña: MISMA ALTURA, más LARGO (2 columnas) --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700">Confirmar contraseña</label>
                <input name="password_confirmation" type="password" required autocomplete="new-password"
                       class="mt-1 w-full rounded-lg px-3 py-2 border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('login') }}" class="text-sm text-slate-600 hover:text-slate-800">Volver al login</a>
            <button type="submit"
                    class="inline-flex items-center rounded-lg bg-emerald-600 px-5 py-2 font-semibold text-white hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400">
                Crear cuenta
            </button>
        </div>
    </form>

    {{-- Alpine.js (si no lo cargas por Vite, deja este CDN) --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Componente Alpine para ubigeo (lee public/ubigeo.json) --}}
    <script>
        function ubigeo() {
            return {
                data: [],
                departamentos: [],
                provincias: [],
                distritos: [],
                dep: @json(old('departamento')),
                prov: @json(old('provincia')),
                dist: @json(old('distrito')),
                async init() {
                    try {
                        const res = await fetch('{{ asset('ubigeo.json') }}');
                        this.data = await res.json();
                        this.departamentos = this.data.map(d => d.nombre);

                        // restaurar selección si viene de old()
                        if (this.dep) {
                            this.onDepChange(this.dep, { keepProv: true });
                            if (this.prov) {
                                this.onProvChange(this.prov, { keepDist: true });
                                if (this.dist && !this.distritos.includes(this.dist)) this.dist = '';
                            }
                        }
                    } catch (e) {
                        console.error('No se pudo cargar ubigeo.json', e);
                    }
                },
                onDepChange(val, opt = {}) {
                    this.dep = val;
                    const d = this.data.find(x => x.nombre === val);
                    this.provincias = d ? d.provincias.map(p => p.nombre) : [];
                    if (!opt.keepProv) this.prov = '';
                    this.distritos = [];
                    this.dist = '';
                },
                onProvChange(val, opt = {}) {
                    this.prov = val;
                    const d = this.data.find(x => x.nombre === this.dep);
                    const p = d?.provincias.find(x => x.nombre === val);
                    this.distritos = p ? p.distritos : [];
                    if (!opt.keepDist) this.dist = '';
                }
            }
        }
    </script>
</x-guest-layout>
