@php $permiso = (int) session('empleado_permiso'); @endphp

<nav class="navbar navbar-expand-lg navbar-dulce navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <i class="bi bi-cake2-fill me-1"></i> El Dulce Arte
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav me-auto">
                {{-- Inicio: todos los roles --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door-fill"></i> Inicio
                    </a>
                </li>

                {{-- Empleados: solo Administrador --}}
                @if ($permiso === 1)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('empleados.*') ? 'active' : '' }}" href="{{ route('empleados.index') }}">
                            <i class="bi bi-people-fill"></i> Empleados
                        </a>
                    </li>
                @endif

                {{-- Los enlaces de Proveedores (1,2), Productos (1,2), Ventas (1,3) y
                     Reportes se agregan aquí conforme se construyan esos módulos. --}}
            </ul>

            <div class="d-flex align-items-center text-light">
                <span class="me-3 small">
                    <i class="bi bi-person-circle"></i>
                    {{ session('empleado_nombre') }}
                    <span class="badge bg-warning text-dark ms-1">{{ session('empleado_rol') }}</span>
                </span>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light">
                        <i class="bi bi-box-arrow-right"></i> Salir
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
