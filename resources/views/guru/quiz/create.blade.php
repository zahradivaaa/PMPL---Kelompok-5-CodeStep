<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Quiz - CodeStep</title>
    @vite(['resources/css/welcome.css', 'resources/js/app.js'])
    <style>
        :root {
            --blue:       #3B82F6;
            --blue-dark:  #1D4ED8;
            --blue-light: #EFF6FF;
            --green:      #22C55E;
            --yellow:     #F59E0B;
            --red:        #EF4444;
            --text:       #1E293B;
            --text-muted: #64748B;
            --border:     #E2E8F0;
            --white:      #FFFFFF;
            --sidebar-w:  260px;
            --topbar-h:   60px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #F1F5F9;
            min-height: 100vh;
            margin: 0;
        }

        a { text-decoration: none; color: inherit; }

        .shell { display: flex; min-height: 100vh; }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--white);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 9999;
            transition: transform .3s ease;
        }

        .sidebar-logo {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }
        .sidebar-logo img { height: 44px; object-fit: contain; }

        .sidebar-nav {
            flex: 1;
            padding: 1.25rem .75rem;
            overflow-y: auto;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .7rem 1rem;
            border-radius: 10px;
            font-size: .9rem;
            font-weight: 500;
            color: var(--text-muted);
            transition: all .2s;
            margin-bottom: .2rem;
            cursor: pointer;
        }
        .nav-item:hover { background: var(--blue-light); color: var(--blue); }
        .nav-item.active { background: var(--blue); color: var(--white); font-weight: 600; }
        .nav-item svg { width: 20px; height: 20px; flex-shrink: 0; }

        .sidebar-footer {
            padding: 1rem .75rem 1.5rem;
            border-top: 1px solid var(--border);
        }
        .logout-btn {
            display: flex; align-items: center; gap: .75rem;
            padding: .7rem 1rem; border-radius: 10px;
            font-size: .9rem; font-weight: 600;
            color: #EF4444;
            background: none; border: none; width: 100%;
            cursor: pointer; transition: all .2s;
            font-family: 'Poppins', sans-serif;
        }
        .logout-btn:hover { background: #FEE2E2; }
        .logout-btn svg { width: 20px; height: 20px; }

        /* ── Main ── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── Topbar ── */
        .topbar {
            height: var(--topbar-h);
            border-bottom: 1px solid var(--border);
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 2rem;
            position: sticky; top: 0; z-index: 100;
            gap: 1rem;
        }
        .topbar .hamburger {
            display: none; background: none; border: none;
            cursor: pointer; margin-right: auto;
        }
        .topbar .hamburger svg { width: 24px; height: 24px; }

        .avatar-btn {
            display: flex; align-items: center; gap: .6rem;
            background: none; border: none; cursor: pointer;
            padding: 0; font-family: 'Poppins', sans-serif;
            text-decoration: none;
        }
        .avatar-circle {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: .85rem; font-weight: 700;
            letter-spacing: .5px; flex-shrink: 0;
            transition: transform .2s, box-shadow .2s;
        }
        .avatar-btn:hover .avatar-circle {
            transform: scale(1.08);
            box-shadow: 0 2px 10px rgba(59,130,246,.4);
        }
        .topbar .username { font-weight: 600; color: var(--blue); font-size: .95rem; }

        /* ── Page content ── */
        .page-content { flex: 1; padding: 2rem; }

        .page-heading {
            font-size: 1.75rem; font-weight: 800;
            color: var(--blue-dark); margin-bottom: .25rem;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex; align-items: center; gap: .4rem;
            font-size: .85rem; color: var(--text-muted); margin-bottom: 1.75rem;
        }
        .breadcrumb a { color: var(--blue); font-weight: 500; }
        .breadcrumb a:hover { text-decoration: underline; }
        .breadcrumb span { color: var(--text-muted); }

        /* ── Form card ── */
        .form-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }
        .form-group { display: flex; flex-direction: column; gap: .4rem; }
        .form-group.full { grid-column: 1 / -1; }

        .form-label {
            font-size: .82rem; font-weight: 600;
            color: var(--text-muted); letter-spacing: .3px;
        }

        .form-control {
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: .6rem .9rem;
            font-size: .875rem;
            font-family: 'Poppins', sans-serif;
            color: var(--text);
            background: var(--white);
            outline: none;
            transition: border .2s, box-shadow .2s;
            width: 100%;
            box-sizing: border-box;
        }
        .form-control:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(59,130,246,.12);
        }
        .form-control.is-invalid { border-color: var(--red); }
        textarea.form-control { resize: vertical; min-height: 90px; }

        .invalid-feedback {
            font-size: .78rem; color: var(--red); margin-top: .2rem;
        }

        /* Radio group */
        .radio-group { display: flex; flex-direction: column; gap: .6rem; margin-top: .2rem; }
        .radio-item {
            display: flex; align-items: center; gap: .6rem;
            font-size: .875rem; color: var(--text); cursor: pointer;
        }
        .radio-item input[type="radio"] { accent-color: var(--blue); width: 15px; height: 15px; }

        /* Duration */
        .duration-wrap { display: flex; align-items: center; gap: .75rem; }
        .duration-wrap .form-control { width: 100px; }
        .duration-unit { font-size: .875rem; color: var(--text-muted); font-weight: 500; }

        /* Buttons */
        .btn-row {
            display: flex; justify-content: flex-end; gap: .75rem;
            margin-top: 1.75rem; padding-top: 1.5rem;
            border-top: 1px solid var(--border);
        }
        .btn-cancel {
            padding: .6rem 1.4rem; border-radius: 10px;
            border: 1.5px solid var(--border); background: var(--white);
            font-size: .875rem; font-family: 'Poppins', sans-serif;
            font-weight: 600; color: var(--text-muted);
            cursor: pointer; transition: all .2s; text-decoration: none;
            display: inline-flex; align-items: center;
        }
        .btn-cancel:hover { border-color: var(--text-muted); color: var(--text); }

        .btn-primary {
            padding: .6rem 1.4rem; border-radius: 10px;
            background: var(--blue); color: var(--white);
            border: none; font-size: .875rem;
            font-family: 'Poppins', sans-serif; font-weight: 600;
            cursor: pointer; transition: background .2s;
            display: inline-flex; align-items: center; gap: .4rem;
        }
        .btn-primary:hover { background: var(--blue-dark); }
        .btn-primary svg { width: 16px; height: 16px; }

        /* Sidebar overlay mobile */
        .sidebar-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,.4); z-index: 150;
        }

        /* Footer */
        .dash-footer {
            background: #F8FAFC;
            border-top: 1px solid var(--border);
            padding: 2.5rem 2rem 0;
            margin: 0 -2rem;
        }
        .footer-inner {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 3rem; align-items: start; padding-bottom: 2rem;
        }
        .footer-logo img { height: 60px; object-fit: contain; margin-bottom: 1rem; display: block; }
        .footer-desc { font-size: .875rem; color: var(--text-muted); line-height: 1.7; max-width: 380px; }
        .contact-section h4 { font-size: 1.1rem; font-weight: 700; color: var(--green); margin-bottom: 1rem; }
        .contact-item {
            display: flex; align-items: center; gap: .75rem;
            font-size: .875rem; color: var(--text); margin-bottom: .75rem;
        }
        .contact-icon {
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--blue-light);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .contact-icon img { width: 18px; height: 18px; object-fit: contain; }
        .contact-item a { color: var(--blue); }
        .footer-copyright {
            text-align: center; padding: 1.25rem 0;
            font-size: .8rem; color: var(--text-muted);
            border-top: 1px solid var(--border);
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .topbar .hamburger { display: flex; }
            .sidebar-overlay.open { display: block; }
            .page-content { padding: 1.25rem 1rem; }
            .form-grid { grid-template-columns: 1fr; }
            .form-group.full { grid-column: 1; }
            .dash-footer { margin: 0 -1rem; padding-left: 1rem; padding-right: 1rem; }
            .footer-inner { grid-template-columns: 1fr; gap: 2rem; }
        }
    </style>
</head>
<body>
<div class="shell">

    {{-- Sidebar --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <a href="{{ route('guru.dashboard') }}">
                <img src="{{ asset('img/logo dan codestep.png') }}" alt="CodeStep">
            </a>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('guru.dashboard') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('guru.siswa') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                Siswa
            </a>

            <a href="{{ route('guru.materi') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10 9 9 9 8 9"/>
                </svg>
                Materi
            </a>

            <a href="{{ route('guru.quiz.index') }}" class="nav-item active">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                Quiz
            </a>


        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <div class="sidebar-overlay" id="overlay" onclick="closeSidebar()"></div>

    {{-- Main --}}
    <div class="main">
        <header class="topbar">
            <button class="hamburger" onclick="openSidebar()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>

            @php
                $nameParts = explode(' ', Auth::user()->name);
                $initials  = strtoupper(substr($nameParts[0], 0, 1));
                if (count($nameParts) > 1) $initials .= strtoupper(substr($nameParts[1], 0, 1));
            @endphp

            <a href="{{ route('guru.profile') }}" class="avatar-btn">
                <div class="avatar-circle">{{ $initials }}</div>
                <span class="username">{{ Auth::user()->name }}</span>
            </a>
        </header>

        <div class="page-content">

            <h1 class="page-heading">Buat Quiz Baru</h1>

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                <a href="{{ route('guru.quiz.index') }}">Quiz</a>
                <span>›</span>
                <span>Buat Quiz</span>
            </div>

            {{-- Form --}}
            <div class="form-card">
                <form action="{{ route('guru.quiz.store') }}" method="POST">
                    @csrf
                    <div class="form-grid">

                        {{-- Judul Quiz --}}
                        <div class="form-group">
                            <label class="form-label" for="judul">Judul Quiz</label>
                            <input
                                type="text"
                                id="judul"
                                name="judul"
                                class="form-control @error('judul') is-invalid @enderror"
                                placeholder="Contoh: Quiz HTML Dasar"
                                value="{{ old('judul') }}"
                            >
                            @error('judul')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Tanggal Mulai --}}
                        <div class="form-group">
                            <label class="form-label" for="tanggal_mulai">Tanggal Mulai</label>
                            <input
                                type="date"
                                id="tanggal_mulai"
                                name="tanggal_mulai"
                                class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                value="{{ old('tanggal_mulai') }}"
                            >
                            @error('tanggal_mulai')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="form-group full">
                            <label class="form-label" for="deskripsi">Deskripsi</label>
                            <textarea
                                id="deskripsi"
                                name="deskripsi"
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                placeholder="Deskripsi singkat tentang quiz ini..."
                            >{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Deadline --}}
                        <div class="form-group">
                            <label class="form-label" for="deadline">Deadline</label>
                            <input
                                type="date"
                                id="deadline"
                                name="deadline"
                                class="form-control @error('deadline') is-invalid @enderror"
                                value="{{ old('deadline') }}"
                            >
                            @error('deadline')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

        

                        {{-- Pilih Materi --}}
                        <div class="form-group">
                            <label class="form-label" for="materi_id">Pilih Materi</label>
                            <select
                                id="materi_id"
                                name="materi_id"
                                class="form-control @error('materi_id') is-invalid @enderror"
                            >
                                <option value="">-- Pilih Materi --</option>
                                @foreach($materis as $materi)
                                    <option value="{{ $materi->id }}" {{ old('materi_id') == $materi->id ? 'selected' : '' }}>
                                        {{ $materi->judul }}
                                    </option>
                                @endforeach
                            </select>
                            @error('materi_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Durasi --}}
                        <div class="form-group">
                            <label class="form-label" for="durasi">Durasi</label>
                            <div class="duration-wrap">
                                <input
                                    type="number"
                                    id="durasi"
                                    name="durasi"
                                    class="form-control @error('durasi') is-invalid @enderror"
                                    placeholder="30"
                                    min="1"
                                    value="{{ old('durasi', 30) }}"
                                >
                                <span class="duration-unit">menit</span>
                            </div>
                            @error('durasi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    {{-- Buttons --}}
                    <div class="btn-row">
                        <a href="{{ route('guru.quiz.index') }}" class="btn-cancel">Batal</a>
                        <button type="submit" class="btn-primary">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            Simpan Quiz
                        </button>
                    </div>
                </form>
            </div>

            {{-- Footer --}}
            <div class="dash-footer">
                <div class="footer-inner">
                    <div class="footer-brand">
                        <div class="footer-logo">
                            <img src="{{ asset('img/logo dan codestep.png') }}" alt="CodeStep">
                        </div>
                        <p class="footer-desc">Di CodeStep, kami membantu siswa belajar pemrograman dasar secara bertahap dan terarah.</p>
                    </div>
                    <div class="contact-section">
                        <h4>Contact Us</h4>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <img src="{{ asset('img/emailicon.png') }}" alt="Email">
                            </div>
                            <a href="mailto:codestep@gmail.com">codestep@gmail.com</a>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <img src="{{ asset('img/telepon.png') }}" alt="Phone">
                            </div>
                            <a href="tel:08138231921">0813-8231-1921</a>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <img src="{{ asset('img/instagramicon.png') }}" alt="Instagram">
                            </div>
                            <a href="https://instagram.com/codeStep.id" target="_blank">@codeStep.id</a>
                        </div>
                    </div>
                </div>
                <div class="footer-copyright">© 2026 CodeStep. All rights reserved.</div>
            </div>

        </div>
    </div>
</div>

<script>
    function openSidebar()  {
        document.getElementById('sidebar').classList.add('open');
        document.getElementById('overlay').classList.add('open');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('overlay').classList.remove('open');
    }
</script>
</body>
</html>