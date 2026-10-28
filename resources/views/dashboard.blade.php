@extends('layouts.app')

@section('titulo', 'Inicio')

@push('estilos')
<style>
    .hero {
        background: linear-gradient(120deg, var(--cafe-oscuro), var(--caramelo));
        color: #fff; border-radius: 16px; padding: 1.6rem 1.8rem;
        box-shadow: 0 6px 20px var(--sombra);
    }
    .hero h2 { margin: 0; }
    .hero .chip {
        display: inline-block; background: rgba(255,255,255,.18);
        border-radius: 20px; padding: .1rem .8rem; font-size: .75rem; letter-spacing: .08em; font-weight: 700;
    }
    .stat-card { border-radius: 14px; color: #fff; padding: 1.1rem 1.3rem; box-shadow: 0 4px 14px var(--sombra); height: 100%; }
    .stat-card .num { font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; line-height: 1; }
    .stat-card .lbl { font-size: .75rem; letter-spacing: .1em; font-weight: 700; margin-top: .3rem; }
    .stat-card .sub { font-size: .75rem; opacity: .85; }
    .stat-card i { font-size: 2.2rem; opacity: .35; }
    .bg-st-prod { background: linear-gradient(135deg, #C4742A, #E8A84C); }
    .bg-st-emp  { background: linear-gradient(135deg, #3B1F0E, #6B3A2A); }
    .bg-st-vta  { background: linear-gradient(135deg, #2e7d32, #4caf50); }
    .bg-st-prv  { background: linear-gradient(135deg, #c2577f, #e8a0b8); }

    .acceso {
        display: block; text-decoration: none; text-align: center;
        background: var(--blanco-hueso); border-radius: 12px; padding: 1rem .5rem;
        border-top: 3px solid var(--caramelo);
        box-shadow: 0 3px 10px var(--sombra); color: var(--texto-oscuro);
        transition: transform .15s, box-shadow .15s; height: 100%;
    }
    a.acceso:hover { transform: translateY(-3px); box-shadow: 0 8px 18px var(--sombra); color: var(--texto-oscuro); }
    .acceso i { font-size: 1.7rem; color: var(--cafe-medio); }
    .acceso .nombre { font-family: 'Playfair Display', serif; font-weight: 700; margin-top: .3rem; }
    .acceso small { color: #8a6b55; }
    .acceso.proximamente { opacity: .55; border-top-color: #bbb; cursor: default; }
</style>
@endpush

@section('contenido')
@php
    $permiso = (int) session('empleado_permiso');
    $fecha   = now()->locale('es')->translatedFormat('j \d\e F \d\e Y');
@endphp

{{-- Hero --}}
<div class="hero mb-4">
    <span class="chip">SISTEMA DE INVENTARIO</span>
    <h2 class="mt-2">¡Bienvenido, {{ session('empleado_nombre') }}!</h2>
    <div class="small mt-1">
        <i class="bi bi-calendar3"></i> {{ $fecha }}
        &nbsp;·&nbsp; <i class="bi bi-shield-check"></i> Rol: {{ session('empleado_rol') }}
    </div>
</div>

{{-- Estadísticas --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="stat-card bg-st-prod d-flex justify-content-between align-items-center">
            <div>
                <div class="num">{{ $stats['productos'] }}</div>
                <div class="lbl">PRODUCTOS</div>
                <div class="sub">En inventario</div>
            </div>
            <i class="bi bi-box-seam-fill"></i>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card bg-st-emp d-flex justify-content-between align-items-center">
            <div>
                <div class="num">{{ $stats['empleados'] }}</div>
                <div class="lbl">EMPLEADOS</div>
                <div class="sub">Activos en sistema</div>
            </div>
            <i class="bi bi-people-fill"></i>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card bg-st-vta d-flex justify-content-between align-items-center">
            <div>
                <div class="num">${{ number_format($stats['ventas_hoy'], 2) }}</div>
                <div class="lbl">VENTAS HOY</div>
                <div class="sub">Total del día</div>
            </div>
            <i class="bi bi-cash-coin"></i>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card bg-st-prv d-flex justify-content-between align-items-center">
            <div>
                <div class="num">{{ $stats['proveedores'] }}</div>
                <div class="lbl">PROVEEDORES</div>
                <div class="sub">Registrados</div>
            </div>
            <i class="bi bi-truck"></i>
        </div>
    </div>
</div>

{{-- Accesos rápidos (según rol) --}}
<h4 class="mb-3" style="border-left: 4px solid var(--caramelo); padding-left: .6rem;">Accesos Rápidos</h4>
<div class="row g-3 mb-4">
    @if ($permiso === 1)
        <div class="col-6 col-md-4 col-lg-2">
            <a class="acceso" href="{{ route('empleados.index') }}">
                <i class="bi bi-person-fill"></i>
                <div class="nombre">Empleados</div>
                <small>Gestionar personal</small>
            </a>
        </div>
    @endif

    @if (in_array($permiso, [1, 2]))
        <div class="col-6 col-md-4 col-lg-2">
            <div class="acceso proximamente">
                <i class="bi bi-truck"></i>
                <div class="nombre">Proveedores</div>
                <small>Próximamente</small>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="acceso proximamente">
                <i class="bi bi-box-seam"></i>
                <div class="nombre">Productos</div>
                <small>Próximamente</small>
            </div>
        </div>
    @endif

    @if (in_array($permiso, [1, 3]))
        <div class="col-6 col-md-4 col-lg-2">
            <div class="acceso proximamente">
                <i class="bi bi-cart3"></i>
                <div class="nombre">Nueva Venta</div>
                <small>Próximamente</small>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="acceso proximamente">
                <i class="bi bi-bar-chart-fill"></i>
                <div class="nombre">Reportes</div>
                <small>Próximamente</small>
            </div>
        </div>
    @endif

    <div class="col-6 col-md-4 col-lg-2">
        <form action="{{ route('logout') }}" method="POST" class="h-100">
            @csrf
            <button type="submit" class="acceso w-100 border-0">
                <i class="bi bi-door-open-fill"></i>
                <div class="nombre">Cerrar Sesión</div>
                <small>Salir del sistema</small>
            </button>
        </form>
    </div>
</div>

<div class="row g-3">
    {{-- Actividad reciente --}}
    <div class="col-lg-6">
        <div class="card-dulce h-100">
            <div class="card-header-dulce"><i class="bi bi-clock-history me-1"></i> Actividad Reciente</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-transparent d-flex justify-content-between">
                    <span><i class="bi bi-person-check-fill text-success"></i> Usuario conectado</span>
                    <strong>{{ session('empleado_usuario') }}</strong>
                </li>
                <li class="list-group-item bg-transparent d-flex justify-content-between">
                    <span><i class="bi bi-database-fill {{ $bdConectada ? 'text-success' : 'text-danger' }}"></i> Conexión a la BD</span>
                    <strong class="{{ $bdConectada ? 'text-success' : 'text-danger' }}">
                        {{ $bdConectada ? 'Conectada' : 'Sin conexión' }}
                    </strong>
                </li>
                <li class="list-group-item bg-transparent d-flex justify-content-between">
                    <span><i class="bi bi-clock-fill text-warning"></i> Hora de inicio de sesión</span>
                    <strong>{{ session('inicio_sesion') }}</strong>
                </li>
            </ul>
        </div>
    </div>

    {{-- Bajo stock --}}
    <div class="col-lg-6">
        <div class="card-dulce h-100">
            <div class="card-header-dulce card-header-peligro">
                <i class="bi bi-exclamation-triangle-fill me-1"></i> Productos con Bajo Stock
            </div>
            <div class="table-responsive">
                <table class="table table-sm mb-0 align-middle">
                    <thead>
                        <tr><th>Producto</th><th class="text-center">Stock</th><th class="text-center">Estado</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($bajoStock as $p)
                            <tr>
                                <td>{{ $p->NomProducto }} <small class="text-muted">({{ $p->idProductos }})</small></td>
                                <td class="text-center">{{ $p->Stock }}</td>
                                <td class="text-center"><span class="badge bg-{{ $p->clase }}">{{ $p->nivel }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted py-3">
                                <i class="bi bi-check-circle"></i> Todo el inventario está en buen nivel.
                            </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
