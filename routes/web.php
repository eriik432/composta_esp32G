<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;

Route::get('/', [PageController::class, 'index'])->name('index');

Route::post('/registro', [ClientController::class, 'registro'])->name('client.registro');
Route::get('/registro', function () {
    return view('registro');
})->name('registro');

Route::get('/productos-usuario/{id}', [PageController::class, 'productsByUser'])->name('products.userProducts');
// Otras vistas
Route::get('/proyecto', [PageController::class, 'proyecto'])->name('proyecto');
Route::get('/nosotros', [PageController::class, 'nosotros'])->name('nosotros');
Route::post('/contactar', [PageController::class, 'store'])->name('contact.store');
Route::get('/contactanos', [PageController::class, 'contactanos'])->name('contactanos');

Route::get('/mapa', [MapController::class, 'ver'])->name('mapa.ver');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login');



// Página protegida
/*Route::middleware('auth')->group(function () {
    // Rutas aquí dentro solo son accesibles si el usuario está logueado
    Route::get('/dashboard', function (){
        return view('dashboard');
    });
});*/
Route::middleware(['auth'])->group(function () {
    
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboardAdmin'])->name('dashboardAdmin');

    Route::get('/getUserG', [AdminController::class, 'dashboardAdminG'])->name('gU');

    Route::get('/crear', function () {
        return view('create');
    })->name('verCrear');

    Route::get('/dashboardA', function () {
        return view('admin.dashboard');
    })->name('dash');
    
});

// Rutas para usuario común
Route::middleware(['auth', 'role:user'])->group(function () {
    //Route::get('/user/dashboard', function () {
        //return view('user.dashboard');
    //});
    
    Route::get('/user/dashboard', [DashboardController::class, 'datos'])->name('gUs');
    Route::get('/user/historial', [DashboardController::class, 'paginacionDatos'])->name('historial');
    Route::get('/dashboard/datos-json', [DashboardController::class, 'datosJson'])->name('dashboard.datosJson');
    Route::get('/cambiarCU', [UserController::class, 'cambiarContrasenia'])->name('cambiarCU');
    Route::post('/actualizarC', [UserController::class, 'actualizarContrasenia'])->name('contrasenia');
    
});



Route::middleware(['auth', 'role:client'])->group(function () {
     Route::get('/client/dashboard', function () {
        return redirect()->route('index'); // Redirige a la vista index.blade.php
    });
});
