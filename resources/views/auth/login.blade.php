<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CodeStep</title>
 
    @vite(['resources/css/welcome.css', 'resources/js/app.js'])
</head>
<body class="login-page">
 
    <!-- NAVBAR -->
    <nav class="navbar">
        <img src="{{ asset('img/logo dan codestep.png') }}" class="logo" alt="CodeStep Logo">
    </nav>
 
    <!-- LOGIN CARD -->
    <div class="login-wrapper">
        <div class="login-card">
 
            <!-- Icon Logo -->
            <div class="login-logo">
                <img src="{{ asset('img/logosaja.png') }}" alt="CodeStep Icon">
            </div>
 
            <h2 class="login-title">Masuk ke akunmu</h2>
 
            <!-- Session Status -->
            @if (session('status'))
                <div class="alert-success">{{ session('status') }}</div>
            @endif
 
            <form method="POST" action="{{ route('login') }}">
                @csrf
 
                <!-- Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input
                        id="username"
                        type="text"
                        name="username"
                        placeholder="Masukan username"
                        value="{{ old('username') }}"
                        required
                        autofocus
                    >
                    @error('username')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>
 
                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-password">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Masukan password"
                            required
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <img id="eye-icon" src="{{ asset('img/eye close.png') }}" alt="Toggle Password">
                        </button>
                    </div>
                    @error('password')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>
 
                <!-- Forgot Password -->
                <div class="forgot-password">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    @endif
                </div>
 
                <!-- Submit -->
                <button type="submit" class="btn-masuk">Masuk</button>
 
                <!-- Register Link -->
                <p class="register-link">
                    Tidak Punya Akun? <a href="{{ route('register') }}">Daftar</a>
                </p>
 
            </form>
        </div>
    </div>
 
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.style.opacity = '1';
            } else {
                input.type = 'password';
                icon.style.opacity = '0.4';
            }
        }
    </script>
 
</body>
</html>
 