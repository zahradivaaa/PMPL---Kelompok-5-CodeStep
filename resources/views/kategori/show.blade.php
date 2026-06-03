<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kategori->nama }} – CodeStep</title>
    @vite(['resources/css/welcome.css', 'resources/js/app.js'])
    <style>
        :root {
            --blue:       #3B82F6;
            --blue-dark:  #1D4ED8;
            --blue-light: #EFF6FF;
            --green:      #22C55E;
            --text:       #1E293B;
            --text-muted: #64748B;
            --border:     #E2E8F0;
            --white:      #FFFFFF;
            --sidebar-w:  260px;
            --topbar-h:   60px;
            --radius:     12px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #EFF6FF;
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
            z-index: 200;
            transition: transform .3s ease;
        }
        .sidebar-logo {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }
        .sidebar-logo img { height: 44px; object-fit: contain; }
        .sidebar-nav { flex: 1; padding: 1.25rem .75rem; overflow-y: auto; }

        .nav-item {
            display: flex; align-items: center; gap: .75rem;
            padding: .7rem 1rem; border-radius: 10px;
            font-size: .9rem; font-weight: 500;
            color: var(--text-muted);
            transition: all .2s; margin-bottom: .2rem;
        }
        .nav-item:hover { background: var(--blue-light); color: var(--blue); }
        .nav-item.active { background: var(--blue); color: var(--white); font-weight: 600; }
        .nav-item svg { width: 20px; height: 20px; flex-shrink: 0; }
        .nav-item img.nav-icon { width: 20px; height: 20px; object-fit: contain; }

        .nav-toggle {
            display: flex; align-items: center; justify-content: space-between;
            padding: .7rem 1rem; border-radius: 10px;
            font-size: .9rem; font-weight: 500; color: var(--text-muted);
            cursor: pointer; transition: all .2s; margin-bottom: .2rem;
            user-select: none;
        }
        .nav-toggle:hover { background: var(--blue-light); color: var(--blue); }
        .nav-toggle .left { display: flex; align-items: center; gap: .75rem; }
        .nav-toggle img.nav-icon { width: 20px; height: 20px; object-fit: contain; }
        .nav-toggle .arrow { transition: transform .3s; width: 16px; height: 16px; }
        .nav-toggle.open .arrow { transform: rotate(180deg); }
        .nav-sub { display: none; padding-left: 1rem; }
        .nav-sub.open { display: block; }
        .nav-sub .nav-item { font-size: .85rem; font-weight: 400; }

        .sidebar-footer { padding: 1rem .75rem 1.5rem; border-top: 1px solid var(--border); }
        .logout-btn {
            display: flex; align-items: center; gap: .75rem;
            padding: .7rem 1rem; border-radius: 10px;
            font-size: .9rem; font-weight: 600; color: #EF4444;
            background: none; border: none; width: 100%;
            cursor: pointer; transition: all .2s;
            font-family: 'Poppins', sans-serif;
        }
        .logout-btn:hover { background: #FEE2E2; }
        .logout-btn svg { width: 20px; height: 20px; }

        /* ── Main ── */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }

        /* ── Topbar ── */
        .topbar {
            height: var(--topbar-h);
            border-bottom: 1px solid var(--border);
            background: var(--white);
            display: flex; align-items: center;
            justify-content: flex-end;
            padding: 0 2rem;
            position: sticky; top: 0; z-index: 100; gap: 1rem;
        }
        .avatar-btn {
            display: flex; align-items: center; gap: .6rem;
            background: none; border: none; cursor: pointer;
            font-family: 'Poppins', sans-serif; text-decoration: none;
        }
        .avatar-circle {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: .85rem; font-weight: 700;
        }
        .username { font-weight: 600; color: var(--blue); font-size: .95rem; }
        .hamburger { display: none; background: none; border: none; cursor: pointer; margin-right: auto; }
        .hamburger svg { width: 24px; height: 24px; }

        /* ── Page content ── */
        .page-content { flex: 1; padding: 2rem; max-width: 900px; }

        /* ── Breadcrumb ── */
        .breadcrumb {
            font-size: .85rem; color: var(--text-muted);
            margin-bottom: 1.5rem;
        }
        .breadcrumb a { color: var(--text-muted); }
        .breadcrumb a:hover { color: var(--blue); }

        /* ── Judul kategori ── */
        .kategori-title {
            font-size: 1.75rem; font-weight: 800;
            color: var(--text); margin-bottom: 1.5rem;
        }

        /* ── Info umum card ── */
        .info-card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--border);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }
        .info-header {
            display: flex; align-items: center; gap: .75rem;
            padding: 1rem 1.5rem;
            cursor: pointer;
            user-select: none;
            font-weight: 600; font-size: .95rem;
        }
        .info-header .chevron {
            width: 28px; height: 28px; border-radius: 6px;
            background: var(--blue-light);
            display: flex; align-items: center; justify-content: center;
            transition: transform .3s;
        }
        .info-header .chevron svg { width: 16px; height: 16px; color: var(--blue); }
        .info-header.open .chevron { transform: rotate(0deg); }
        .info-body {
            padding: 1.5rem;
            border-top: 1px solid var(--border);
            display: none;
        }
        .info-body.open { display: block; }
        .info-body h3 { text-align: center; font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem; }
        .info-body p { font-size: .9rem; line-height: 1.8; color: var(--text-muted); }

        /* ── Materi list ── */
        .materi-list { display: flex; flex-direction: column; gap: .75rem; }
        .materi-item {
            display: flex; align-items: center;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            font-size: .95rem; font-weight: 600;
            color: var(--text);
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
        }
        .materi-item:hover:not(.terkunci) {
            border-color: var(--blue);
            box-shadow: 0 2px 12px rgba(59,130,246,.12);
        }
        .materi-item.terkunci {
            color: var(--text-muted);
            cursor: not-allowed;
            background: #F8FAFC;
        }
        .materi-item .icon-kunci { margin-left: .5rem; font-size: .85rem; }

        /* ── Responsive ── */
        .sidebar-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,.4); z-index: 150;
        }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .hamburger { display: flex; }
            .sidebar-overlay.open { display: block; }
            .page-content { padding: 1.25rem 1rem; }
        }

        .materi-item.sudah-dibaca {
        border-color: var(--green);
        background: #F0FDF4;
        color: var(--text);
        }

    </style>
</head>
<body>
<div class="shell">

    {{-- Sidebar --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('img/logo dan codestep.png') }}" alt="CodeStep">
            </a>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('progress') }}" class="nav-item">
                <img src="{{ asset('img/iconprogres.png') }}" alt="Progress" class="nav-icon">
                Progress
            </a>
            <div class="nav-toggle open" id="kategoriToggle" onclick="toggleKategori()">
                <div class="left">
                    <img src="{{ asset('img/iconkategori.png') }}" alt="Kategori" class="nav-icon">
                    Kategori
                </div>
                <svg class="arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </div>
            <div class="nav-sub open" id="kategoriSub">
                <a href="{{ route('kategori.show', 'java') }}"
                   class="nav-item {{ $kategori->slug === 'java' ? 'active' : '' }}">Java</a>
                <a href="{{ route('kategori.show', 'python') }}"
                   class="nav-item {{ $kategori->slug === 'python' ? 'active' : '' }}">Python</a>
                <a href="{{ route('kategori.show', 'php') }}"
                   class="nav-item {{ $kategori->slug === 'php' ? 'active' : '' }}">PHP</a>
            </div>
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
            <a href="{{ route('profile.edit') }}" class="avatar-btn">
                @php
                    $nameParts = explode(' ', Auth::user()->name);
                    $initials = strtoupper(substr($nameParts[0], 0, 1));
                    if (count($nameParts) > 1) $initials .= strtoupper(substr($nameParts[1], 0, 1));
                @endphp
                <div class="avatar-circle">{{ $initials }}</div>
                <span class="username">{{ Auth::user()->name }}</span>
            </a>
        </header>

        <div class="page-content">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a> /
                <span>{{ $kategori->nama }}</span>
            </div>

            {{-- Judul --}}
            <h1 class="kategori-title">{{ $kategori->nama }}</h1>

            {{-- Info Umum --}}
            <div class="info-card">
                <div class="info-header open" id="infoHeader" onclick="toggleInfo()">
                    <div class="chevron">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </div>
                    Informasi umum
                </div>
                <div class="info-body open" id="infoBody">
                    <h3>{{ $kategori->nama }}</h3>
                    <p>{{ $kategori->deskripsi }}</p>
                </div>
            </div>

            {{-- Daftar Materi --}}
<div class="materi-list">
    @forelse($materis as $index => $materi)

        {{-- Item Materi --}}
        @if($materi->terkunci)
            <div class="materi-item terkunci">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:20px;height:20px;margin-right:.5rem;flex-shrink:0;">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                {{ $index + 1 }}. {{ $materi->judul }}
            </div>
        @else
            <a href="{{ route('materi.baca', $materi->id) }}"
               class="materi-item {{ $materi->sudah_dibaca ? 'sudah-dibaca' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:20px;height:20px;margin-right:.5rem;flex-shrink:0;color:var(--blue);">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                </svg>
                {{ $index + 1 }}. {{ $materi->judul }}
                @if($materi->sudah_dibaca)
                    <span style="margin-left:auto;color:var(--green);font-size:.8rem;font-weight:600;">✅ Selesai</span>
                @endif
            </a>
        @endif

        {{-- Quiz di bawah materi --}}
        @if($materi->jumlah_quiz > 0)
            @if($materi->quiz_terkunci)
                <div class="materi-item terkunci" style="margin-left:1.5rem;border-left:3px solid var(--border);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:20px;height:20px;margin-right:.5rem;flex-shrink:0;">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    Quiz {{ $index + 1 }} – Baca materi dulu untuk membuka quiz
                </div>
            @else
                <a href="{{ route('quiz.kerjakan', $materi->id) }}"
                   class="materi-item {{ $materi->quiz_selesai ? 'sudah-dibaca' : '' }}"
                   style="margin-left:1.5rem;border-left:3px solid {{ $materi->quiz_selesai ? 'var(--green)' : 'var(--blue)' }};">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:20px;height:20px;margin-right:.5rem;flex-shrink:0;color:{{ $materi->quiz_selesai ? 'var(--green)' : 'var(--blue)' }};">
                        <path d="M9 11l3 3L22 4"/>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                    </svg>
                    Quiz {{ $index + 1 }} – {{ $materi->judul }}
                    @if($materi->quiz_selesai)
                        <span style="margin-left:auto;color:var(--green);font-size:.8rem;font-weight:600;">✅ Selesai</span>
                    @else
                        <span style="margin-left:auto;color:var(--blue);font-size:.8rem;font-weight:600;">Kerjakan →</span>
                    @endif
                </a>
            @endif
        @endif

    @empty
        <div style="text-align:center;color:var(--text-muted);padding:2rem;">
            Belum ada materi untuk kategori ini.
        </div>
    @endforelse
</div>

        </div>
    </div>
</div>

<script>
    function toggleInfo() {
        document.getElementById('infoHeader').classList.toggle('open');
        document.getElementById('infoBody').classList.toggle('open');
    }
    function toggleKategori() {
        document.getElementById('kategoriToggle').classList.toggle('open');
        document.getElementById('kategoriSub').classList.toggle('open');
    }
    function openSidebar()  { document.getElementById('sidebar').classList.add('open'); document.getElementById('overlay').classList.add('open'); }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('overlay').classList.remove('open'); }
</script>
</body>
</html>