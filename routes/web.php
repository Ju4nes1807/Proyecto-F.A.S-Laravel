<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\EscuelaController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckRole;

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');


Route::get('/', function () {
    // If the user is authenticated, check their role ID
    if (Auth::check()) {
        $user = Auth::user();

        // Redirect based on the foreign key for the role
        if ($user->fk_role_id == 1) {
            return redirect()->route('admin.dash_admin');
        } elseif ($user->fk_role_id == 2) {
            return redirect()->route('entrenador.dashboard');
        } elseif ($user->fk_role_id == 3) {
            return redirect()->route('jugador.dashboard');
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
});

Route::middleware(['auth', 'role:Entrenador'])->group(function () {
    Route::get('/coach/dashboard', fn() => 'Bienvenido Entrenador')->name('coach.dashboard');
});

Route::middleware(['auth', 'role:Jugador'])->group(function () {
    Route::get('/player/dashboard', fn() => 'Bienvenido Jugador')->name('player.dashboard');
});

Route::middleware('guest')->group(function () {
    // 1. Muestra el formulario de inicio de sesión
    Route::get('inicioSesion', [AuthenticatedSessionController::class, 'create'])
        ->name('inicioSesion');

    // 2. Procesa los datos del formulario (la lógica de autenticación)
    Route::post('inicioSesion', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Rutas para la edición del perfil de administrador
    Route::get('/modificarPerfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/modificarPerfil', [ProfileController::class, 'update'])->name('profile.update');

});

Route::middleware('auth')->group(function () {
    Route::resource('escuelas', EscuelaController::class);
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
require __DIR__ . '/auth.php';
