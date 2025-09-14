<?php
use App\Http\Controllers\EntrenadorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\EscuelaController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CanchaController;

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');


Route::get('/', function () {
    // If the user is authenticated, check their role ID
    if (Auth::check()) {
        $user = Auth::user();

        // Redirect based on the foreign key for the role
        if ($user->fk_role_id == 1) {
            return redirect()->route('admin.dash_admin');
        } elseif ($user->fk_role_id == 2) {
            return redirect()->route('entrenador.principalEntrenador');
        } elseif ($user->fk_role_id == 3) {
            return redirect()->route('jugador.principal');
        }
    }

    // If the user is not authenticated, show the welcome page
    return view('landinpage');
})->name('landinpage');

Route::get('/registro', [RegisteredUserController::class, 'create'])->name('registro');
Route::post('/registro', [RegisteredUserController::class, 'store'])->name('registro');

Route::middleware(['auth'])->group(function () {
    Route::middleware([CheckRole::class . ':1'])->group(function () {
        Route::get('/admin/dash_admin', [AdminController::class, 'index'])
            ->name('admin.dash_admin');
    });

    Route::middleware([CheckRole::class . ':2'])->group(function () {
        Route::get('/entrenador/principalEntrenador', [EntrenadorController::class, 'index'])
            ->name('entrenador.principalEntrenador');
    });

    Route::middleware([CheckRole::class . ':3'])->group(function () {
        Route::get('/jugador/principal', [JugadorController::class, 'index'])
            ->name('jugador.principal');
    });
});

Route::middleware('guest')->group(function () {
    // 1. Muestra el formulario de inicio de sesión
    Route::get('inicioSesion', [AuthenticatedSessionController::class, 'create'])
        ->name('inicioSesion');

    // 2. Procesa los datos del formulario (la lógica de autenticación)
    Route::post('inicioSesion', [AuthenticatedSessionController::class, 'store']);
});


Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/admin/modificarPerfil', [ProfileController::class, 'edit'])->name('admin.perfil.edit');
    Route::put('/admin/modificarPerfil', [ProfileController::class, 'update'])->name('admin.perfil.update');
});

Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/entrenador/modificarPerfil', [ProfileController::class, 'edit'])->name('entrenador.perfil.edit');
    Route::put('/entrenador/modificarPerfil', [ProfileController::class, 'update'])->name('entrenador.perfil.update');
});

Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/jugador/modificarPerfil', [ProfileController::class, 'edit'])->name('jugador.perfil.edit');
    Route::put('/jugador/modificarPerfil', [ProfileController::class, 'update'])->name('jugador.perfil.update');
    Route::get('/jugador/perfil', [JugadorController::class, 'mostrarPerfil'])->name('jugador.perfil');
});

Route::middleware('auth')->group(function () {
    Route::resource('escuelas', EscuelaController::class);
    Route::get('/usuarios', [ProfileController::class, 'index'])->name('usuarios.index');
    Route::post('/escuelas/{id}/asignar-usuario', [EscuelaController::class, 'asignarUsuario'])
        ->name('escuelas.asignarUsuario');
    Route::delete('/usuarios/{id}/eliminar-asignacion', [EscuelaController::class, 'eliminarAsignacion'])
        ->name('usuarios.eliminarAsignacion');
    Route::get('/usuarios/{id}', [ProfileController::class, 'show'])->name('usuarios.show');

    // Eliminar usuario definitivamente del sistema
    Route::delete('/usuarios/{id}', [ProfileController::class, 'eliminarUsuario'])->name('usuarios.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Index de categorías (vista diferente según rol)
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

    // CRUD solo para admins
    Route::middleware(['auth', 'role:1'])->group(function () {
        Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
        Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
        Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
        Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
        Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
        Route::post('/categorias/usuarios/{user}', [CategoriaController::class, 'asignarUsuario'])
            ->name('categorias.asignarUsuario');
        Route::delete('/usuarios/{id}/eliminar-categoria', [CategoriaController::class, 'eliminarCategoria'])
            ->name('usuarios.eliminarCategoria');
    });
});
//Rutas canchas
Route::get('/canchas', [CanchaController::class, 'index'])
    ->name('canchas.index')
    ->middleware('auth');
//Rutas solo para admins
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/admin/dash_admin', [CanchaController::class, 'dash_admin'])->name('admin.dash_admin');
    Route::get('/canchas/create', [CanchaController::class, 'create'])->name('canchas.create');
    Route::post('/canchas', [CanchaController::class, 'store'])->name('canchas.store');
    Route::get('/canchas/{id}/edit', [CanchaController::class, 'edit'])->name('canchas.edit');
    Route::put('/canchas/{id}', [CanchaController::class, 'update'])->name('canchas.update');
    Route::delete('/canchas/{id}', [CanchaController::class, 'destroy'])->name('canchas.destroy');
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
require __DIR__ . '/auth.php';
