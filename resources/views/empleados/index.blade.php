@extends('layouts.app')

@section('titulo', 'Empleados')

@section('contenido')
<div class="d-flex align-items-center mb-3">
    <h3 class="mb-0"><i class="bi bi-people-fill" style="color: var(--caramelo);"></i> Gestión de Empleados</h3>
</div>

<div class="row g-4">

    {{-- ── Formulario (crear / editar) ── --}}
    <div class="col-lg-4">
        <div class="card-dulce">
            <div class="card-header-dulce" id="tituloForm">
                <i class="bi bi-person-plus-fill me-1"></i> Nuevo Empleado
            </div>
            <div class="p-3">
                <form id="formEmpleado" method="POST" action="{{ route('empleados.store') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="_method" id="metodo" value="POST" disabled>
                    <input type="hidden" name="editando_id" id="editando_id" value="{{ old('editando_id') }}">

                    <div class="mb-2">
                        <label class="form-label" for="NomEmpleado">Nombre completo</label>
                        <input type="text" class="form-control" id="NomEmpleado" name="NomEmpleado"
                               value="{{ old('NomEmpleado') }}" maxlength="100" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="Usuario">Usuario</label>
                        <input type="text" class="form-control" id="Usuario" name="Usuario"
                               value="{{ old('Usuario') }}" maxlength="50" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="Telefono">Teléfono</label>
                        <input type="text" class="form-control" id="Telefono" name="Telefono"
                               value="{{ old('Telefono') }}" maxlength="20" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="Direccion">Dirección</label>
                        <input type="text" class="form-control" id="Direccion" name="Direccion"
                               value="{{ old('Direccion') }}" maxlength="150" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" minlength="6">
                        <div class="form-text" id="ayudaPass">Mínimo 6 caracteres.</div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label" for="idPermiso">Rol</label>
                            <select class="form-select" id="idPermiso" name="idPermiso" required>
                                <option value="">Selecciona…</option>
                                @foreach ($permisos as $permiso)
                                    <option value="{{ $permiso->id }}" @selected(old('idPermiso') == $permiso->id)>{{ $permiso->Permiso }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="idEstado">Estado</label>
                            <select class="form-select" id="idEstado" name="idEstado" required>
                                <option value="">Selecciona…</option>
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->id }}" @selected(old('idEstado', 1) == $estado->id)>{{ $estado->Estado }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-caramelo" id="btnGuardar">
                            <i class="bi bi-save me-1"></i> Guardar empleado
                        </button>
                        <button type="button" class="btn btn-outline-cafe d-none" id="btnCancelar">
                            <i class="bi bi-x-circle me-1"></i> Cancelar edición
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ── Tabla ── --}}
    <div class="col-lg-8">
        <div class="card-dulce">
            <div class="card-header-dulce d-flex justify-content-between align-items-center">
                <span><i class="bi bi-list-ul me-1"></i> Empleados registrados</span>
                <span class="badge bg-light text-dark">Total: <span id="contador">{{ $empleados->count() }}</span></span>
            </div>
            <div class="p-3">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" id="buscador" class="form-control" placeholder="Buscar por nombre, usuario, teléfono o rol…">
                </div>

                <div class="table-responsive">
                    <table class="table tabla-dulce align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID</th><th>Empleado</th><th>Usuario</th><th>Teléfono</th>
                                <th>Rol</th><th>Estado</th><th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpoTabla">
                            @forelse ($empleados as $e)
                                <tr>
                                    <td>{{ $e->idEmpleado }}</td>
                                    <td>
                                        <span class="avatar-inicial me-2">{{ strtoupper(mb_substr($e->NomEmpleado, 0, 1)) }}</span>
                                        {{ $e->NomEmpleado }}
                                    </td>
                                    <td>{{ $e->Usuario }}</td>
                                    <td>{{ $e->Telefono }}</td>
                                    <td><span class="badge bg-secondary">{{ $e->permiso->Permiso ?? '—' }}</span></td>
                                    <td>
                                        @if ($e->idEstado == 1)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    <td class="text-center text-nowrap">
                                        <button type="button" class="btn btn-sm btn-outline-primary btn-editar"
                                                data-id="{{ $e->idEmpleado }}"
                                                data-nombre="{{ $e->NomEmpleado }}"
                                                data-usuario="{{ $e->Usuario }}"
                                                data-telefono="{{ $e->Telefono }}"
                                                data-direccion="{{ $e->Direccion }}"
                                                data-permiso="{{ $e->idPermiso }}"
                                                data-estado="{{ $e->idEstado }}"
                                                title="Editar">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>

                                        <form action="{{ route('empleados.destroy', $e->idEmpleado) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('¿Eliminar a {{ addslashes($e->NomEmpleado) }}? Esta acción no se puede deshacer.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="text-center text-muted py-4">No hay empleados registrados.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // URL base construida con url() de Laravel (no rutas absolutas hardcodeadas)
    const URL_EMPLEADOS = "{{ url('empleados') }}";

    function modoCrear() {
        $("#formEmpleado").attr("action", URL_EMPLEADOS);
        $("#metodo").prop("disabled", true);
        $("#editando_id").val("");
        $("#tituloForm").html('<i class="bi bi-person-plus-fill me-1"></i> Nuevo Empleado');
        $("#btnGuardar").html('<i class="bi bi-save me-1"></i> Guardar empleado');
        $("#btnCancelar").addClass("d-none");
        $("#password").prop("required", true);
        $("#ayudaPass").text("Mínimo 6 caracteres.");
    }

    function cargarEditar(id) {
        const $b = $('.btn-editar[data-id="' + id + '"]');
        $("#formEmpleado").attr("action", URL_EMPLEADOS + "/" + id);
        $("#metodo").val("PUT").prop("disabled", false);
        $("#editando_id").val(id);

        $("#NomEmpleado").val($b.data("nombre"));
        $("#Usuario").val($b.data("usuario"));
        $("#Telefono").val($b.data("telefono"));
        $("#Direccion").val($b.data("direccion"));
        $("#idPermiso").val($b.data("permiso"));
        $("#idEstado").val($b.data("estado"));
        $("#password").val("").prop("required", false);

        $("#ayudaPass").text("Déjala vacía para conservar la contraseña actual.");
        $("#tituloForm").html('<i class="bi bi-pencil-square me-1"></i> Editar Empleado #' + id);
        $("#btnGuardar").html('<i class="bi bi-save me-1"></i> Actualizar empleado');
        $("#btnCancelar").removeClass("d-none");
        $("html, body").animate({ scrollTop: 0 }, 250);
    }

    $(function () {
        // Estado inicial: crear (password obligatorio)
        $("#password").prop("required", true);

        // Si una validación falló mientras se editaba, volver al modo edición
        const editando = $("#editando_id").val();
        if (editando) {
            $("#formEmpleado").attr("action", URL_EMPLEADOS + "/" + editando);
            $("#metodo").val("PUT").prop("disabled", false);
            $("#password").prop("required", false);
            $("#ayudaPass").text("Déjala vacía para conservar la contraseña actual.");
            $("#tituloForm").html('<i class="bi bi-pencil-square me-1"></i> Editar Empleado #' + editando);
            $("#btnGuardar").html('<i class="bi bi-save me-1"></i> Actualizar empleado');
            $("#btnCancelar").removeClass("d-none");
        }

        $(".btn-editar").on("click", function () {
            cargarEditar($(this).data("id"));
        });

        $("#btnCancelar").on("click", function () {
            $("#formEmpleado")[0].reset();
            modoCrear();
            $("#idEstado").val("1");
        });

        // Buscador en tiempo real
        $("#buscador").on("keyup", function () {
            const q = $(this).val().toLowerCase();
            let visibles = 0;
            $("#cuerpoTabla tr").each(function () {
                const coincide = $(this).text().toLowerCase().indexOf(q) > -1;
                $(this).toggle(coincide);
                if (coincide) visibles++;
            });
            $("#contador").text(visibles);
        });
    });
</script>
@endpush
