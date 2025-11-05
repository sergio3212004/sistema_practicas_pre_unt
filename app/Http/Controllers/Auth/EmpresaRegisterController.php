<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
// === agregado para logging y validaciones elegantes
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class EmpresaRegisterController extends Controller
{
    public function create()
    {
        if (!Schema::hasTable('razones_sociales')) {
            $razones = collect();
        } else {
            $razones = DB::table('razones_sociales')
                ->select('id', 'acronimo as razon_label')
                ->orderBy('acronimo')
                ->get();
        }

        if ($razones->isEmpty()) {
            session()->flash('status', 'No hay razones sociales cargadas. Por favor, ejecuta el seeder de razones sociales.');
        }

        return view('auth.empresa-register', compact('razones'));
    }


    public function store(Request $request)
    {
        // Validación según TU esquema de empresas y users
        $validated = $request->validate([
            'ruc'              => ['required', 'digits:11', Rule::unique('empresas', 'ruc')],
            'razon_social_id'  => ['required', 'integer', Rule::exists('razones_sociales', 'id')],
            'nombre'           => ['required', 'string', 'max:255'],
            'telefono'         => ['nullable', 'string', 'max:30'],
            'departamento'     => ['nullable', 'string', 'max:100'],
            'provincia'        => ['nullable', 'string', 'max:100'],
            'distrito'         => ['nullable', 'string', 'max:100'],
            'direccion'        => ['nullable', 'string', 'max:255'],

            'email'            => ['required', 'string', 'email:rfc,dns', 'max:255', Rule::unique('users', 'email')],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // === agregado: re-chequeo por si el catálogo cambió entre la vista y el submit
        $existeRazon = DB::table('razones_sociales')->where('id', $validated['razon_social_id'])->exists();
        if (!$existeRazon) {
            throw ValidationException::withMessages([
                'razon_social_id' => 'La razón social seleccionada ya no está disponible. Actualiza la página e inténtalo nuevamente.',
            ]);
        }

        // Normaliza
        $validated['ruc']          = preg_replace('/\D+/', '', $validated['ruc']);
        $validated['nombre']       = Str::squish($validated['nombre']);
        if (!empty($validated['telefono']))     $validated['telefono']     = Str::squish($validated['telefono']);
        if (!empty($validated['departamento'])) $validated['departamento'] = Str::squish($validated['departamento']);
        if (!empty($validated['provincia']))    $validated['provincia']    = Str::squish($validated['provincia']);
        if (!empty($validated['distrito']))     $validated['distrito']     = Str::squish($validated['distrito']);
        if (!empty($validated['direccion']))    $validated['direccion']    = Str::squish($validated['direccion']);
        $validated['email'] = mb_strtolower(trim($validated['email']));

        // Rol empresa
        $roleEmpresaId = DB::table('roles')->where('rol', 'empresa')->value('id');
        if (!$roleEmpresaId) {
            return back()->withErrors(['rol' => 'No se encontró el rol "empresa". Corre el RolesSeeder.'])->withInput();
        }

        DB::beginTransaction();
        try {
            // Crea usuario
            $user = (new User())->forceFill([
                'email'             => $validated['email'],
                'password'          => Hash::make($validated['password']),
                'role_id'           => $roleEmpresaId,
                'email_verified_at' => now(), // opcional
            ]);
            $user->save();

            // Crea empresa con PK = ruc (string)
            $empresa = (new Empresa())->forceFill([
                'ruc'              => $validated['ruc'],           // <- PK lógica en tu modelo
                'user_id'          => $user->id,
                'razon_social_id'  => $validated['razon_social_id'],
                'nombre'           => $validated['nombre'],
                'telefono'         => $validated['telefono'] ?? null,
                'departamento'     => $validated['departamento'] ?? null,
                'provincia'        => $validated['provincia'] ?? null,
                'distrito'         => $validated['distrito'] ?? null,
                'direccion'        => $validated['direccion'] ?? null,
            ]);
            $empresa->save();

            DB::commit();

            Auth::login($user);
            return redirect()->route('dashboard')->with('status', '¡Cuenta de empresa creada!');
        } catch (\Throwable $e) {
            DB::rollBack();

            // === agregado: log para depurar rápidamente en storage/logs/laravel.log
            Log::error('Error registrando empresa', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            $msg = 'No se pudo completar el registro.';
            if (str_contains($e->getMessage(), 'users_email_unique')) {
                $msg = 'El correo ya está registrado.';
            }
            if (str_contains($e->getMessage(), 'empresas_pkey') || str_contains($e->getMessage(), 'empresas_ruc_unique')) {
                $msg = 'El RUC ya está registrado.';
            }

            return back()->withErrors(['general' => $msg])->withInput();
        }
    }
}
