<x-guest-layout>
    <x-slot name="title">Iniciar sesión</x-slot>
    <x-slot name="subtitle">Escuela de Informática</x-slot>

    {{-- Tabs: arriba del logo --}}
    <div class="mb-4 -mt-8 -mx-4 px-4">
        <div class="flex justify-center">
            <div class="inline-flex items-center gap-1 rounded-full border border-slate-200 bg-white/90 backdrop-blur px-1 py-1 shadow-sm">
                {{-- Activo (login) --}}
                <span class="px-4 py-1.5 text-sm font-semibold rounded-full bg-emerald-600 text-white select-none">
                    Iniciar sesión
                </span>
                {{-- Link a registro de empresa --}}
                <a href="{{ route('empresa.register') }}"
                   class="px-4 py-1.5 text-sm font-semibold rounded-full text-emerald-700 hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-emerald-400 transition">
                    Registrar empresa
                </a>
            </div>
        </div>
    </div>

    {{-- Mensajes de estado --}}
    @if (session('status'))
        <div class="mb-4 rounded-md bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-2 text-sm">
            {{ session('status') }}
        </div>
    @endif

    {{-- Errores --}}
    @if ($errors->any())
        <div class="mb-4 rounded-md bg-rose-50 border border-rose-200 text-rose-700 px-4 py-2 text-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario --}}
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        {{-- Correo --}}
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700">Correo institucional</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                   placeholder="ej: example@unitru.edu.pe"
                   class="mt-1 w-full rounded-lg border border-slate-300 bg-white text-slate-900 placeholder-slate-400 px-3 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 outline-none transition">
            @error('email')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Contraseña --}}
        <div>
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium text-slate-700">Contraseña</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-indigo-600 hover:text-indigo-500">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <div class="relative mt-1">
                <input id="password" name="password" type="password" placeholder="•••••••••" required
                       class="w-full rounded-lg border border-slate-300 bg-white text-slate-900 placeholder-slate-400 px-3 py-2 pr-10 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                <button type="button" id="togglePwd"
                        class="absolute inset-y-0 right-0 flex items-center px-3 text-slate-500 hover:text-slate-700"
                        aria-label="Mostrar contraseña">
                    <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 hidden" fill="currentColor">
                        <path d="M12 4.5c-4.5 0-8.2 2.7-10 7.5 1.8 4.8 5.5 7.5 10 7.5s8.2-2.7 10-7.5c-1.8-4.8-5.5-7.5-10-7.5zm0 12a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9z"/><circle cx="12" cy="12" r="2.25"/>
                    </svg>
                    <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor">
                        <path d="m3.5 3.5-1.4 1.4 4 4C4 10 2.5 12 2 12c1.8 4.8 5.5 7.5 10 7.5 2 0 3.8-.5 5.3-1.3l4.6 4.6 1.4-1.4-20-20zM12 6.5c3.6 0 6.8 2 8.7 5.5-.6 1.2-1.3 2.2-2.2 3l-3.1-3.1c.1-.4.2-.9.2-1.4A4.5 4.5 0 0 0 11 6.5c-.5 0-1 .1-1.4.2l-1.6-1.6c1.3-.6 2.7-.9 3.9-.9z"/>
                        <path d="M9.8 11.2a2.25 2.25 0 0 0 3 3l-3-3z"/>
                    </svg>
                </button>
            </div>
            @error('password')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Recordarme + Acceder --}}
        <div class="flex items-center justify-between">
            <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" name="remember"
                       class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                <span>Recordarme</span>
            </label>
            <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-5 py-2 font-semibold text-white hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 transition">
                Acceder
            </button>
        </div>
    </form>

    {{-- Toggle password --}}
    <script>
        (function () {
            const input = document.getElementById('password');
            const btn = document.getElementById('togglePwd');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');
            btn.addEventListener('click', () => {
                const show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                eyeOpen.classList.toggle('hidden', !show);
                eyeClosed.classList.toggle('hidden', show);
                btn.setAttribute('aria-label', show ? 'Ocultar contraseña' : 'Mostrar contraseña');
            });
        })();
    </script>
</x-guest-layout>
