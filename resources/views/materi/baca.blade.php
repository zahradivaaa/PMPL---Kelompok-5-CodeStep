<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $materi->judul }} – CodeStep</title>
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
        }

        body { font-family: 'Poppins', sans-serif; background: #F1F5F9; min-height: 100vh; margin: 0; }
        a { text-decoration: none; color: inherit; }
        .shell { display: flex; min-height: 100vh; }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-w); background: var(--white);
            border-right: 1px solid var(--border);
            display: flex; flex-direction: column;
            position: fixed; top: 0; left: 0; bottom: 0;
            z-index: 200; transition: transform .3s ease;
        }
        .sidebar-logo { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); }
        .sidebar-logo img { height: 44px; object-fit: contain; }
        .sidebar-nav { flex: 1; padding: 1.25rem .75rem; overflow-y: auto; }
        .nav-item {
            display: flex; align-items: center; gap: .75rem;
            padding: .7rem 1rem; border-radius: 10px;
            font-size: .9rem; font-weight: 500; color: var(--text-muted);
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
            cursor: pointer; transition: all .2s; font-family: 'Poppins', sans-serif;
        }
        .logout-btn:hover { background: #FEE2E2; }
        .logout-btn svg { width: 20px; height: 20px; }

        /* Main */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

        /* Topbar */
        .topbar {
            height: var(--topbar-h); border-bottom: 1px solid var(--border);
            background: var(--white); display: flex; align-items: center;
            justify-content: flex-end; padding: 0 2rem;
            position: sticky; top: 0; z-index: 100; gap: 1rem;
        }
        .hamburger { display: none; background: none; border: none; cursor: pointer; margin-right: auto; }
        .hamburger svg { width: 24px; height: 24px; }
        .avatar-btn { display: flex; align-items: center; gap: .6rem; background: none; border: none; cursor: pointer; font-family: 'Poppins', sans-serif; text-decoration: none; }
        .avatar-circle {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: .85rem; font-weight: 700;
        }
        .username { font-weight: 600; color: var(--blue); font-size: .95rem; }

        /* Page content */
        .page-content { flex: 1; padding: 2rem; max-width: 960px; }

        /* Breadcrumb */
        .breadcrumb { font-size: .85rem; color: var(--text-muted); margin-bottom: 1.5rem; }
        .breadcrumb a { color: var(--text-muted); }
        .breadcrumb a:hover { color: var(--blue); }

        /* Judul */
        .materi-title { font-size: 1.5rem; font-weight: 800; color: var(--text); margin-bottom: .5rem; }
        .materi-desc { font-size: .9rem; color: var(--text-muted); margin-bottom: 1.5rem; line-height: 1.7; }

        /* Badge sudah dibaca */
        .badge-dibaca {
            display: inline-flex; align-items: center; gap: .4rem;
            background: #DCFCE7; color: #16A34A;
            border-radius: 99px; padding: .3rem .875rem;
            font-size: .8rem; font-weight: 600; margin-bottom: 1.5rem;
        }

        /* PDF viewer */
        .pdf-card {
            background: var(--white); border: 1.5px solid var(--border);
            border-radius: 16px; overflow: hidden; margin-bottom: 1.5rem;
        }
        .pdf-header {
            padding: 1rem 1.5rem; border-bottom: 1px solid var(--border);
            display: flex; align-items: center; gap: .75rem;
            font-weight: 600; font-size: .95rem; color: var(--text);
        }
        .pdf-header svg { width: 20px; height: 20px; color: var(--blue); }
        .pdf-viewer { width: 100%; height: 70vh; border: none; display: block; }

        /* Navigasi materi */
        .nav-materi {
            display: flex; justify-content: space-between;
            gap: 1rem; margin-bottom: 2rem;
        }
        .btn-nav {
            display: flex; align-items: center; gap: .5rem;
            padding: .75rem 1.5rem; border-radius: 12px;
            font-size: .875rem; font-weight: 600;
            font-family: 'Poppins', sans-serif; cursor: pointer;
            transition: all .2s; text-decoration: none;
        }
        .btn-prev {
            border: 1.5px solid var(--border); color: var(--text-muted);
            background: var(--white);
        }
        .btn-prev:hover { border-color: var(--blue); color: var(--blue); }
        .btn-next {
            background: var(--blue); color: white; border: none;
            margin-left: auto;
        }
        .btn-next:hover { background: var(--blue-dark); }
        .btn-next:disabled { background: #94A3B8; cursor: not-allowed; }

        /* Sidebar overlay mobile */
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.4); z-index: 150; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .hamburger { display: flex; }
            .sidebar-overlay.open { display: block; }
            .page-content { padding: 1.25rem 1rem; }
            .pdf-viewer { height: 50vh; }
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
            @php
                $nameParts = explode(' ', Auth::user()->name);
                $initials = strtoupper(substr($nameParts[0], 0, 1));
                if (count($nameParts) > 1) $initials .= strtoupper(substr($nameParts[1], 0, 1));
            @endphp
            <a href="{{ route('profile.edit') }}" class="avatar-btn">
                <div class="avatar-circle">{{ $initials }}</div>
                <span class="username">{{ Auth::user()->name }}</span>
            </a>
        </header>

        <div class="page-content">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a> /
                <a href="{{ route('kategori.show', $kategori->slug) }}">{{ $kategori->nama }}</a> /
                <span>{{ $materi->judul }}</span>
            </div>

            {{-- Judul & deskripsi --}}
            <h1 class="materi-title">{{ $materi->judul }}</h1>
            @if($materi->deskripsi)
                <p class="materi-desc">{{ $materi->deskripsi }}</p>
            @endif

            {{-- Badge sudah dibaca --}}
            <div class="badge-dibaca">
                ✅ Materi sudah dibaca
            </div>

            {{-- PDF Viewer --}}
            @if($materi->file_pdf)
                <div class="pdf-card">
                    <div class="pdf-header">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                        </svg>
                        {{ basename($materi->file_pdf) }}
                    </div>
                    <iframe
                        src="{{ Storage::url($materi->file_pdf) }}"
                        class="pdf-viewer"
                        type="application/pdf">
                    </iframe>
                </div>
            @else
                <div style="background:var(--white);border:1.5px solid var(--border);border-radius:16px;padding:3rem;text-align:center;color:var(--text-muted);margin-bottom:1.5rem;">
                    📄 Belum ada file PDF untuk materi ini.
                </div>
            @endif

            {{-- Navigasi materi --}}
            @php
                $semuaMateri = $kategori->materis()->orderBy('urutan')->get();
                $currentIndex = $semuaMateri->search(fn($m) => $m->id === $materi->id);
                $materiSebelumnya = $currentIndex > 0 ? $semuaMateri->get($currentIndex - 1) : null;
                $materiSelanjutnya = $semuaMateri->get($currentIndex + 1);
            @endphp

            <div class="nav-materi">
                @if($materiSebelumnya)
                    <a href="{{ route('materi.baca', $materiSebelumnya->id) }}" class="btn-nav btn-prev">
                        ← {{ $materiSebelumnya->judul }}
                    </a>
                @else
                    <div></div>
                @endif

                @if($materiSelanjutnya)
                    <a href="{{ route('materi.baca', $materiSelanjutnya->id) }}" class="btn-nav btn-next">
                        {{ $materiSelanjutnya->judul }} →
                    </a>
                @else
                    <a href="{{ route('kategori.show', $kategori->slug) }}" class="btn-nav btn-next">
                        Kembali ke {{ $kategori->nama }} →
                    </a>
                @endif
            </div>

        </div>
    </div>
</div>

<script>
    function toggleKategori() {
        document.getElementById('kategoriToggle').classList.toggle('open');
        document.getElementById('kategoriSub').classList.toggle('open');
    }
    function openSidebar()  { document.getElementById('sidebar').classList.add('open'); document.getElementById('overlay').classList.add('open'); }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('overlay').classList.remove('open'); }
</script>
</body>
</html>