<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'Inicio') — Confitería El Dulce Arte</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">

    <style>
        :root {
            --cafe-oscuro: #3B1F0E;
            --cafe-medio: #6B3A2A;
            --caramelo: #C4742A;
            --dorado: #E8A84C;
            --crema: #FDF3E3;
            --blanco-hueso: #FAFAF7;
            --texto-oscuro: #2C1A10;
            --sombra: rgba(59, 31, 14, 0.15);
        }
        body {
            background: var(--crema);
            color: var(--texto-oscuro);
            font-family: 'Lato', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main { flex: 1; }
        h1, h2, h3, h4, h5, .titulo { font-family: 'Playfair Display', serif; }

        /* Navbar */
        .navbar-dulce { background: linear-gradient(90deg, var(--cafe-oscuro), var(--cafe-medio)); }
        .navbar-dulce .navbar-brand { font-family: 'Playfair Display', serif; color: var(--dorado); font-weight: 700; }
        .navbar-dulce .nav-link { color: #f3e3cf; font-weight: 700; }
        .navbar-dulce .nav-link:hover,
        .navbar-dulce .nav-link.active { color: var(--dorado); }

        /* Cards */
        .card-dulce {
            background: var(--blanco-hueso);
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 16px var(--sombra);
            overflow: hidden;
        }
        .card-dulce .card-header-dulce {
            background: linear-gradient(90deg, var(--cafe-oscuro), var(--caramelo));
            color: #fff;
            padding: .75rem 1.1rem;
            font-family: 'Playfair Display', serif;
            font-weight: 600;
        }
        .card-header-peligro { background: linear-gradient(90deg, #b3261e, #e0523f) !important; }

        /* Botones */
        .btn-caramelo {
            background: linear-gradient(90deg, var(--caramelo), var(--dorado));
            color: #fff; border: none; font-weight: 700;
        }
        .btn-caramelo:hover { color: #fff; filter: brightness(.93); }
        .btn-outline-cafe { border: 1px solid var(--cafe-medio); color: var(--cafe-medio); }
        .btn-outline-cafe:hover { background: var(--cafe-medio); color: #fff; }

        /* Formularios */
        .form-control:focus, .form-select:focus {
            border-color: var(--caramelo);
            box-shadow: 0 0 0 .2rem rgba(196, 116, 42, .2);
        }
        .form-label { font-weight: 700; font-size: .85rem; color: var(--cafe-medio); }

        /* Tablas */
        .tabla-dulce thead th { background: var(--cafe-oscuro); color: #fff; font-weight: 700; border: none; }
        .tabla-dulce tbody tr:hover { background: rgba(232, 168, 76, .12); }

        .avatar-inicial {
            width: 36px; height: 36px; border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; background: var(--caramelo);
        }
    </style>
    @stack('estilos')
</head>
<body>
    @include('partials.navbar')

    <main class="container py-4">
        @include('partials.alertas')
        @yield('contenido')
    </main>

    @include('partials.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
