<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password – CodeStep</title>
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

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #BFDBFE;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Navbar ── */
        .navbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }
        .logo { display: flex; align-items: center; gap: .75rem; text-decoration: none; }
        .logo-text strong { display: block; font-size: 1rem; font-weight: 700; color: var(--text); }
        .logo-text strong span { color: var(--blue); }
        .logo-text small { display: block; font-size: .58rem; color: var(--text-muted); letter-spacing: .5px; }

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
            box-shadow: 0 4px 24px rgba(0,0,0,.08);
            animation: slideUp .4s ease both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .card-logo { text-align: center; margin-bottom: 1rem; }
        .card-logo img { height: 65px; object-fit: contain; }

        .card-title {
            text-align: center;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--green);
            margin-bottom: .75rem;
        }

        .card-desc {
            text-align: center;
            font-size: .875rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 1.75rem;
        }

        /* ── Form ── */
        .form-group { display: flex; flex-direction: column; gap: .4rem; margin-bottom: 1rem; }
        .form-group label { font-size: .875rem; font-weight: 600; color: var(--text); }
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

        .error-msg { font-size: .8rem; color: #EF4444; margin-top: .2rem; }

        .alert-success {
            background: #DCFCE7; color: #166534;
            border: 1px solid #BBF7D0;
            border-radius: var(--radius);
            padding: .75rem 1rem;
            font-size: .85rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .alert-error {
            background: #FEE2E2; color: #991B1B;
            border: 1px solid #FECACA;
            border-radius: var(--radius);
            padding: .75rem 1rem;
            font-size: .85rem;
            margin-bottom: 1rem;
        }

        /* ── Button ── */
        .btn-primary {
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
        .btn-primary:hover {
            background: var(--blue-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(59,130,246,.35);
        }

        .divider { height: 1px; background: var(--border); margin: 1.25rem 0; }

        .back-link {
            text-align: center;
            font-size: .875rem;
            color: var(--text-muted);
        }
        .back-link a {
            color: var(--blue);
            font-weight: 600;
            text-decoration: none;
        }
        .back-link a:hover { text-decoration: underline; }

        /* ── Responsive ── */
        @media (max-width: 520px) {
            .card { padding: 2rem 1.25rem; }
            .card-title { font-size: 1.2rem; }
            .navbar { padding: 0 1rem; }
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('img/logo dan codestep.png') }}" style="height:38px;object-fit:contain;" alt="CodeStep Logo">
        </a>
    </nav>

    {{-- Card --}}
    <div class="page-wrapper">
        <div class="card">

            <div class="card-logo">
                <img src="{{ asset('img/logosaja.png') }}" alt="CodeStep Icon">
            </div>

            <h1 class="card-title">Lupa Password?</h1>

            <p class="card-desc">
                Masukan emailmu dan kami akan mengirimkan link untuk reset passwordmu.
            </p>

            {{-- Status --}}
            @if (session('status'))
                <div class="alert-success">✅ {{ session('status') }}</div>
            @endif

            {{-- Error --}}
            @if ($errors->any())
                <div class="alert-error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="Masukan emailmu"
                        value="{{ old('email') }}"
                        required autofocus autocomplete="email"
                        class="{{ $errors->has('email') ? 'error' : '' }}"
                    >
                    @error('email')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-primary">
                    Kirim Link Reset Password
                </button>
            </form>

            <div class="divider"></div>

            <p class="back-link">
                Ingat password? <a href="{{ route('login') }}">Kembali ke Login</a>
            </p>

        </div>
    </div>

</body>
</html>