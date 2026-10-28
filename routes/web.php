<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;

// ── Públicas ────────────────────────────────────────────────
Route::get('/', fn () => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ── Protegidas: requieren sesión activa ─────────────────────
Route::middleware('sesion')->group(function () {

    // Todos los roles (1, 2, 3)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Solo Administrador
    Route::middleware('rol:1')->group(function () {
        Route::resource('empleados', EmpleadoController::class)
            ->only(['index', 'store', 'update', 'destroy']);
    });

    // Los módulos de Proveedores, Productos, Ventas y Reportes se agregarán
    // en los siguientes avances (Proveedores/Productos: rol:1,2 — Ventas: rol:1,3).
});
