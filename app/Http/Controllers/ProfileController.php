<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Rol;
use App\Models\Escuela;
class ProfileController extends Controller
{
    // Mostrar formulario
    public function edit()
    {
        $user = Auth::user();

        if ($user->fk_role_id == 1) { // Admin
            return view('admin.modificarPerfil', compact('user'));
        } elseif ($user->fk_role_id == 2) { // Entrenador
            return view('entrenador.modificarPerfil', compact('user'));
        } elseif ($user->fk_role_id == 3) { // Jugador
            return view('jugador.modificarPerfil', compact('user'));
        }

        // Si el rol no se reconoce, redirigir a una página de error o por defecto
        return abort(403, 'Acceso no autorizado.');
    }

    // Actualizar perfil
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Debug: ver qué datos llegan
        Log::info('Request profile update:', $request->all());

        // Validación simple
        $request->validate([
            'nombres' => ['nullable', 'string', 'max:255'],
            'apellidos' => ['nullable', 'string', 'max:255'],
            'documento' => ['nullable', 'integer', 'unique:users,documento,' . $user->id],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'fecha_nacimiento' => ['nullable', 'date'],
            'telefono' => ['nullable', 'string', 'max:15'],
            'password_actual' => ['nullable', 'string'],
            'password_nueva' => ['nullable', 'string', 'min:8'],
        ]);

        // Actualizar campos generales
        $data = $request->only(['nombres', 'apellidos', 'documento', 'email', 'fecha_nacimiento', 'telefono']);
        $user->fill($data);

        // Actualizar contraseña si viene
        if ($request->filled('password_nueva')) {
            if ($request->filled('password_actual') && Hash::check($request->password_actual, $user->password)) {
                $user->password = Hash::make($request->password_nueva);
            } else {
                return back()->withErrors(['password_actual' => 'La contraseña actual no es correcta.'])->withInput();
            }
        }

        // Resetear email verificado si cambió
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return back()->with('status', 'Perfil actualizado correctamente');
    }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function index(Request $request)
    {
        $admin = Auth::user();

        // No se cambia la variable $misEscuelas. Se mantiene la lógica original.
        $misEscuelas = $admin->escuelas->pluck('id');

        // Se obtienen las listas para los filtros de la vista
        $roles = Rol::all();
        $escuelas = Escuela::all();

        // Se inicia la consulta con los filtros de seguridad del administrador
        $usuarios = User::with('rol', 'escuela', 'asignaciones.categoria')
            ->whereIn('fk_role_id', [2, 3])
            ->where(function ($query) use ($misEscuelas) {
                $query->whereNull('escuela_id')
                    ->orWhereIn('escuela_id', $misEscuelas);
            });

        // --- Aplicar los filtros de búsqueda sin cambiar $misEscuelas ---

        // Filtro por nombre
        if ($request->filled('nombre')) {
            $usuarios->where('nombres', 'like', '%' . $request->nombre . '%');
        }

        // Filtro por rol
        if ($request->filled('rol')) {
            $usuarios->where('fk_role_id', $request->rol);
        }

        // Filtro por escuela
        if ($request->filled('escuela')) {
            $usuarios->where('escuela_id', $request->escuela);
        }

        // --- Fin de la lógica de búsqueda ---

        // Se obtienen los resultados de la consulta final
        $usuarios = $usuarios->get();

        // Lógica para obtener las categorías
        $categorias = collect();
        if ($admin->fk_role_id == 1) {
            $categorias = Categoria::whereHas('escuelas', function ($q) use ($admin) {
                $q->where('user_id', $admin->id);
            })->with('escuelas')->get();
        }

        // Se pasan las variables a la vista, incluyendo los datos para los filtros
        return view('admin.usuarios', compact('usuarios', 'admin', 'categorias', 'roles', 'escuelas'));
    }


    public function show($id)
    {
        $admin = Auth::user();

        // Solo admins pueden consultar
        if ($admin->fk_role_id != 1) {
            abort(403, 'Acceso no autorizado.');
        }

        $usuario = User::with('rol', 'escuela')->findOrFail($id);

        return view('admin.verUsuario', compact('usuario'));
    }

    public function eliminarUsuario($id)
    {
        $admin = Auth::user();

        if ($admin->fk_role_id != 1) {
            abort(403, 'Acceso no autorizado.');
        }

        $usuario = User::findOrFail($id);

        if ($usuario->id == $admin->id) {
            return back()->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }


}
