<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar – CodeStep</title>
    @vite(['resources/css/welcome.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue:      #3B82F6;
            --blue-dark: #1D4ED8;
            --blue-light:#EFF6FF;
            --green:     #22C55E;
            --text:      #1E293B;
            --text-muted:#64748B;
            --border:    #E2E8F0;
            --white:     #FFFFFF;
            --radius:    12px;
        }

        /* ── Navbar ── */
        .navbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 12px rgba(0,0,0,.04);
        }
        .navbar .logo { height: 38px; }

        /* ── Card ── */
        .page-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .card {
            background: var(--white);
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 8px 40px rgba(59,130,246,.14);
            animation: slideUp .4s ease both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .card-logo {
            text-align: center;
            margin-bottom: 1rem;
        }
        .card-logo img { height: 64px; }

        .card-title {
            text-align: center;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--green);
            margin-bottom: 1.75rem;
        }

        /* ── Form ── */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: .4rem;
            margin-bottom: 1rem;
        }
        .form-group label {
            font-size: .875rem;
            font-weight: 600;
            color: var(--text);
        }
        .form-group input {
            padding: .75rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            font-family: 'Poppins', sans-serif;
            font-size: .9rem;
            color: var(--text);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            width: 100%;
        }
        .form-group input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(59,130,246,.15);
        }
        .form-group input::placeholder { color: #CBD5E1; }
        .form-group input.error { border-color: #EF4444; }
        .error-msg { font-size: .8rem; color: #EF4444; }

        /* password wrapper */
        .input-password { position: relative; }
        .input-password input { padding-right: 3rem; }
        .toggle-password {
            position: absolute;
            right: .875rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
        }
        .toggle-password img {
            width: 22px;
            height: 22px;
            opacity: 0.4;
            transition: opacity .2s;
        }
        .toggle-password img.visible { opacity: 1; }

        /* alert */
        .alert-error {
            background: #FEE2E2;
            color: #991B1B;
            border: 1px solid #FECACA;
            border-radius: var(--radius);
            padding: .75rem 1rem;
            font-size: .85rem;
            margin-bottom: 1rem;
        }

        /* button */
        .btn-daftar {
            width: 100%;
            padding: .85rem;
            background: var(--blue);
            color: var(--white);
            border: none;
            border-radius: var(--radius);
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s, transform .2s, box-shadow .2s;
            margin-top: .5rem;
        }
        .btn-daftar:hover {
            background: var(--blue-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(59,130,246,.35);
        }

        .divider { height: 1px; background: var(--border); margin: 1.25rem 0; }

        .login-link {
            text-align: center;
            font-size: .875rem;
            color: var(--text-muted);
        }
        .login-link a {
            color: var(--blue);
            font-weight: 600;
            text-decoration: none;
        }
        .login-link a:hover { text-decoration: underline; }

        /* ── Responsive ── */
        @media (max-width: 520px) {
            .card { padding: 2rem 1.25rem; }
            .card-title { font-size: 1.2rem; }
            .navbar { padding: 0 1rem; }
        }
    </style>
</head>
<body class="login-page">

    {{-- Navbar --}}
    <nav class="navbar">
        <a href="{{ url('/') }}">
            <img src="{{ asset('img/logo dan codestep.png') }}" class="logo" alt="CodeStep Logo">
        </a>
    </nav>

    {{-- Card --}}
    <div class="page-wrapper">
        <div class="card">

            <div class="card-logo">
                <img src="{{ asset('img/logosaja.png') }}" alt="CodeStep Icon">
            </div>

            <h1 class="card-title">Buat Akun Baru</h1>

            {{-- Error --}}
            @if ($errors->any())
                <div class="alert-error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Username --}}
                <div class="form-group">
                    <label for="name">Username</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        placeholder="Masukan usernamemu"
                        value="{{ old('name') }}"
                        required autofocus autocomplete="name"
                        class="{{ $errors->has('name') ? 'error' : '' }}"
                    >
                    @error('name')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="Masukan emailmu"
                        value="{{ old('email') }}"
                        required autocomplete="username"
                        class="{{ $errors->has('email') ? 'error' : '' }}"
                    >
                    @error('email')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-password">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Masukan passwordmu"
                            required autocomplete="new-password"
                            class="{{ $errors->has('password') ? 'error' : '' }}"
                        >
                        <button type="button" class="toggle-password" onclick="togglePw('password', 'eye1')">
                            <img id="eye1" src="{{ asset('img/eye close.png') }}" alt="Toggle Password">
                        </button>
                    </div>
                    @error('password')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-password">
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            placeholder="Ulangi passwordmu"
                            required autocomplete="new-password"
                        >
                        <button type="button" class="toggle-password" onclick="togglePw('password_confirmation', 'eye2')">
                            <img id="eye2" src="{{ asset('img/eye close.png') }}" alt="Toggle Password">
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-daftar">Daftar Sekarang</button>
            </form>

            <div class="divider"></div>

            <p class="login-link">
                Sudah Punya Akun? <a href="{{ route('login') }}">Masuk</a>
            </p>

        </div>
    </div>

    <script>
    function togglePw(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon  = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.add('visible');
        } else {
            input.type = 'password';
            icon.classList.remove('visible');
        }
    }
    </script>

<body class="login-page">
</html>