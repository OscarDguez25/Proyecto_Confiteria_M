<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión — Confitería El Dulce Arte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    <style>
        :root {
            --cafe-oscuro: #3B1F0E; --cafe-medio: #6B3A2A; --caramelo: #C4742A;
            --dorado: #E8A84C; --crema: #FDF3E3;
        }
        body {
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, var(--cafe-oscuro) 0%, var(--cafe-medio) 45%, var(--caramelo) 100%);
            font-family: 'Lato', sans-serif;
        }
        .login-card {
            width: 100%; max-width: 400px;
            background: var(--crema);
            border-radius: 20px;
            border-top: 4px solid var(--caramelo);
            padding: 2.2rem 2rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .35);
        }
        .login-card h1 { font-family: 'Playfair Display', serif; color: var(--cafe-oscuro); font-size: 1.5rem; line-height: 1.2; }
        .login-card h1 em { color: var(--cafe-medio); }
        .subtitulo { color: var(--caramelo); font-size: .7rem; letter-spacing: .15em; font-weight: 700; }
        .form-label { font-size: .75rem; letter-spacing: .08em; font-weight: 700; color: var(--cafe-medio); }
        .form-control:focus { border-color: var(--caramelo); box-shadow: 0 0 0 .2rem rgba(196,116,42,.2); }
        .btn-ingresar {
            background: linear-gradient(90deg, var(--caramelo), var(--dorado));
            color: #fff; border: none; font-family: 'Playfair Display', serif; font-weight: 700;
            padding: .65rem; border-radius: 10px;
        }
        .btn-ingresar:hover { color: #fff; filter: brightness(.93); }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <i class="bi bi-cake2-fill" style="font-size: 2.5rem; color: var(--caramelo);"></i>
            <h1 class="mt-2 mb-1">Confitería<br><em>El Dulce Arte</em></h1>
            <div class="subtitulo">SISTEMA DE INVENTARIO</div>
        </div>

        @if (session('error'))
            <div class="alert alert-danger py-2 small">
                <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success py-2 small">
                <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger py-2 small mb-3">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" autocomplete="off">
            @csrf

            <div class="mb-3">
                <label for="usuario" class="form-label"><i class="bi bi-person"></i> USUARIO</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-person-fill" style="color: var(--caramelo);"></i></span>
                    <input type="text" id="usuario" name="usuario" class="form-control"
                           placeholder="Ingresa tu usuario" value="{{ old('usuario') }}" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label"><i class="bi bi-lock"></i> CONTRASEÑA</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-lock-fill" style="color: var(--caramelo);"></i></span>
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="Ingresa tu contraseña" required>
                </div>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="recordar" name="recordar">
                <label class="form-check-label small" for="recordar">Recordar mi sesión</label>
            </div>

            <button type="submit" class="btn btn-ingresar w-100">
                <i class="bi bi-box-arrow-in-right me-1"></i> Ingresar al Sistema
            </button>
        </form>

        <div class="text-center mt-4 small text-muted">
            <i class="bi bi-cake2"></i> © {{ date('Y') }} Confitería El Dulce Arte
        </div>
    </div>
</body>
</html>
