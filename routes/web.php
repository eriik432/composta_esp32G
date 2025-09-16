<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FertilizerController;
use App\Http\Controllers\FertilizerAdminController;
use App\Http\Controllers\UserReferenceController;

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
    Route::put('/profile/update', [UserReferenceController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
    Route::post('/references/store', [UserReferenceController::class, 'addressReferences'])->name('references.store')->middleware('auth');
    
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

    Route::resource('products', FertilizerAdminController::class);
    Route::get('productos-eliminados', [FertilizerAdminController::class, 'delete'])->name('products.delete');
    Route::put('productos/{id}/activar', [FertilizerAdminController::class, 'activate'])->name('products.activate');
    Route::resource('user_references', UserReferenceController::class);
    
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
    Route::post('/destacado/{id}', [FertilizerController::class, 'starw'])->name('destacado');
    Route::get('/verProductos', [FertilizerController::class, 'index'])->name('vista');
    Route::resource('fertilizers', FertilizerController::class);
    
});



Route::middleware(['auth', 'role:client'])->group(function () {
     Route::get('/client/dashboard', function () {
        return redirect()->route('index'); // Redirige a la vista index.blade.php
    });

    
});
