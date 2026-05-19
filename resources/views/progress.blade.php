<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Saya – CodeStep</title>
    @vite(['resources/css/welcome.css', 'resources/js/app.js'])
    <style>
        :root {
            --blue:       #3B82F6;
            --blue-dark:  #1D4ED8;
            --blue-light: #EFF6FF;
            --green:      #22C55E;
            --yellow:     #F59E0B;
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

        /* ── Sidebar (sama persis dengan dashboard) ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--white);
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
            transition: all .2s; margin-bottom: .2rem; cursor: pointer;
        }
        .nav-item:hover { background: var(--blue-light); color: var(--blue); }
        .nav-item.active { background: var(--blue); color: var(--white); font-weight: 600; }
        .nav-item svg { width: 20px; height: 20px; flex-shrink: 0; }
        .nav-item img.nav-icon { width: 20px; height: 20px; flex-shrink: 0; object-fit: contain; }
        .nav-toggle {
            display: flex; align-items: center; justify-content: space-between;
            padding: .7rem 1rem; border-radius: 10px;
            font-size: .9rem; font-weight: 500; color: var(--text-muted);
            cursor: pointer; transition: all .2s; margin-bottom: .2rem; user-select: none;
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

        /* ── Main ── */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

        /* ── Topbar ── */
        .topbar {
            height: var(--topbar-h); border-bottom: 1px solid var(--border);
            background: var(--white); display: flex; align-items: center;
            justify-content: flex-end; padding: 0 2rem;
            position: sticky; top: 0; z-index: 100; gap: 1rem;
        }
        .topbar .hamburger { display: none; background: none; border: none; cursor: pointer; margin-right: auto; }
        .topbar .hamburger svg { width: 24px; height: 24px; }
        .avatar-btn { display: flex; align-items: center; gap: .6rem; background: none; border: none; cursor: pointer; padding: 0; font-family: 'Poppins', sans-serif; text-decoration: none; }
        .avatar-circle {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: .85rem; font-weight: 700; flex-shrink: 0;
            transition: transform .2s, box-shadow .2s;
        }
        .avatar-btn:hover .avatar-circle { transform: scale(1.08); box-shadow: 0 2px 10px rgba(59,130,246,.4); }
        .username { font-weight: 600; color: var(--blue); font-size: .95rem; }

        /* ── Page content ── */
        .page-content { flex: 1; padding: 2rem; }
        .page-heading { font-size: 1.75rem; font-weight: 800; color: var(--blue-dark); margin-bottom: 1.5rem; }

        /* ── Progress summary cards ── */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
            margin-bottom: 2rem;
        }
        .summary-card {
            background: var(--white);
            border-radius: 16px;
            border: 1.5px solid var(--border);
            padding: 1.5rem;
            display: flex; flex-direction: column; gap: .5rem;
        }
        .summary-card .s-label { font-size: .8rem; font-weight: 600; color: var(--text-muted); }
        .summary-card .s-value { font-size: 2rem; font-weight: 800; }
        .summary-card .s-sub { font-size: .8rem; color: var(--text-muted); }

        /* ── Language progress sections ── */
        .lang-section {
            background: var(--white);
            border-radius: 16px;
            border: 1.5px solid var(--border);
            padding: 1.5rem;
            margin-bottom: 1.25rem;
        }
        .lang-section-header {
            display: flex; align-items: center; gap: 1rem;
            margin-bottom: 1.25rem;
        }
        .lang-section-header img { width: 48px; height: 48px; object-fit: contain; }
        .lang-section-header .lang-emoji { font-size: 2.5rem; }
        .lang-section-header .lang-info h3 { font-size: 1rem; font-weight: 700; color: var(--text); margin: 0 0 .25rem; }
        .lang-section-header .lang-info span { font-size: .8rem; color: var(--text-muted); }

        /* Overall bar */
        .overall-bar-wrap { margin-bottom: 1.25rem; }
        .overall-bar-label {
            display: flex; justify-content: space-between;
            font-size: .85rem; font-weight: 600; margin-bottom: .4rem;
            color: var(--text);
        }
        .bar-bg { background: #F1F5F9; border-radius: 99px; height: 10px; overflow: hidden; }
        .bar-fill { height: 100%; border-radius: 99px; transition: width .6s ease; }

        /* Sub-topic rows */
        .topic-list { display: flex; flex-direction: column; gap: .6rem; }
        .topic-row { display: flex; align-items: center; gap: 1rem; }
        .topic-name { font-size: .8rem; color: var(--text-muted); width: 140px; flex-shrink: 0; }
        .topic-bar-wrap { flex: 1; }
        .topic-bar-bg { background: #F1F5F9; border-radius: 99px; height: 6px; overflow: hidden; }
        .topic-bar-fill { height: 100%; border-radius: 99px; }
        .topic-pct { font-size: .8rem; font-weight: 600; color: var(--text-muted); width: 36px; text-align: right; flex-shrink: 0; }

        /* Badge */
        .badge {
            display: inline-flex; align-items: center; gap: .3rem;
            padding: .25rem .65rem; border-radius: 99px;
            font-size: .75rem; font-weight: 600;
        }
        .badge-blue { background: var(--blue-light); color: var(--blue); }
        .badge-yellow { background: #FEF3C7; color: #92400E; }
        .badge-green { background: #DCFCE7; color: #166534; }

        /* ── Mobile overlay ── */
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.4); z-index: 150; }

        @media (max-width: 900px) { .summary-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .topbar .hamburger { display: flex; }
            .sidebar-overlay.open { display: block; }
            .page-content { padding: 1.25rem 1rem; }
        }
        @media (max-width: 520px) {
            .summary-grid { grid-template-columns: 1fr; }
            .page-heading { font-size: 1.35rem; }
            .topic-name { width: 100px; }
        }
    </style>
</head>
<body>
<div class="shell">

    {{-- ── Sidebar ── --}}
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

            {{-- Progress — ACTIVE --}}
            <a href="{{ route('progress') }}" class="nav-item active">
                <img src="{{ asset('img/iconprogres.png') }}" alt="Progress" class="nav-icon">
                Progress
            </a>

            <div class="nav-toggle" id="kategoriToggle" onclick="toggleKategori()">
                <div class="left">
                    <img src="{{ asset('img/iconkategori.png') }}" alt="Kategori" class="nav-icon">
                    Kategori
                </div>
                <svg class="arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </div>
            <div class="nav-sub" id="kategoriSub">
                <a href="#" class="nav-item">Java</a>
                <a href="#" class="nav-item">Python</a>
                <a href="#" class="nav-item">PHP</a>
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

    {{-- ── Main ── --}}
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
                <div class="avatar-circle" title="Lihat Profil">
                    @php
                        $nameParts = explode(' ', Auth::user()->name);
                        $initials = strtoupper(substr($nameParts[0], 0, 1));
                        if (count($nameParts) > 1) $initials .= strtoupper(substr($nameParts[1], 0, 1));
                    @endphp
                    {{ $initials }}
                </div>
                <span class="username">{{ Auth::user()->name }}</span>
            </a>
        </header>

        <div class="page-content">
            <h1 class="page-heading">Progress Saya</h1>

            {{-- ── Summary cards ── --}}
            <div class="summary-grid">
                <div class="summary-card">
                    <span class="s-label">Total Materi Selesai</span>
                    <span class="s-value" style="color:var(--blue)">30</span>
                    <span class="s-sub">dari 100 materi</span>
                </div>
                <div class="summary-card">
                    <span class="s-label">Bahasa Dipelajari</span>
                    <span class="s-value" style="color:var(--green)">3</span>
                    <span class="s-sub">Java · Python · PHP</span>
                </div>
                <div class="summary-card">
                    <span class="s-label">Streak Saat Ini</span>
                    <span class="s-value" style="color:var(--yellow)">🔥 2</span>
                    <span class="s-sub">hari berturut-turut</span>
                </div>
            </div>

            {{-- ── Java ── --}}
            <div class="lang-section">
                <div class="lang-section-header">
                    <img src="{{ asset('img/java.png') }}" alt="Java"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                    <span class="lang-emoji" style="display:none">☕</span>
                    <div class="lang-info">
                        <h3>Java <span class="badge badge-blue">60%</span></h3>
                        <span>18 dari 30 materi selesai</span>
                    </div>
                </div>
                <div class="overall-bar-wrap">
                    <div class="overall-bar-label"><span>Progres keseluruhan</span><span>60%</span></div>
                    <div class="bar-bg"><div class="bar-fill" style="width:60%;background:#3B82F6;"></div></div>
                </div>
                <div class="topic-list">
                    <div class="topic-row">
                        <span class="topic-name">Pengenalan Java</span>
                        <div class="topic-bar-wrap"><div class="topic-bar-bg"><div class="topic-bar-fill" style="width:100%;background:#3B82F6;"></div></div></div>
                        <span class="topic-pct">100%</span>
                    </div>
                    <div class="topic-row">
                        <span class="topic-name">Variabel & Tipe Data</span>
                        <div class="topic-bar-wrap"><div class="topic-bar-bg"><div class="topic-bar-fill" style="width:100%;background:#3B82F6;"></div></div></div>
                        <span class="topic-pct">100%</span>
                    </div>
                    <div class="topic-row">
                        <span class="topic-name">Percabangan</span>
                        <div class="topic-bar-wrap"><div class="topic-bar-bg"><div class="topic-bar-fill" style="width:80%;background:#3B82F6;"></div></div></div>
                        <span class="topic-pct">80%</span>
                    </div>
                    <div class="topic-row">
                        <span class="topic-name">Perulangan</span>
                        <div class="topic-bar-wrap"><div class="topic-bar-bg"><div class="topic-bar-fill" style="width:40%;background:#3B82F6;"></div></div></div>
                        <span class="topic-pct">40%</span>
                    </div>
                    <div class="topic-row">
                        <span class="topic-name">OOP Dasar</span>
                        <div class="topic-bar-wrap"><div class="topic-bar-bg"><div class="topic-bar-fill" style="width:0%;background:#3B82F6;"></div></div></div>
                        <span class="topic-pct">0%</span>
                    </div>
                </div>
            </div>

            {{-- ── Python ── --}}
            <div class="lang-section">
                <div class="lang-section-header">
                    <img src="{{ asset('img/phyton.png') }}" alt="Python"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                    <span class="lang-emoji" style="display:none">🐍</span>
                    <div class="lang-info">
                        <h3>Python <span class="badge badge-yellow">35%</span></h3>
                        <span>7 dari 20 materi selesai</span>
                    </div>
                </div>
                <div class="overall-bar-wrap">
                    <div class="overall-bar-label"><span>Progres keseluruhan</span><span>35%</span></div>
                    <div class="bar-bg"><div class="bar-fill" style="width:35%;background:#F59E0B;"></div></div>
                </div>
                <div class="topic-list">
                    <div class="topic-row">
                        <span class="topic-name">Pengenalan Python</span>
                        <div class="topic-bar-wrap"><div class="topic-bar-bg"><div class="topic-bar-fill" style="width:100%;background:#F59E0B;"></div></div></div>
                        <span class="topic-pct">100%</span>
                    </div>
                    <div class="topic-row">
                        <span class="topic-name">Variabel & Tipe Data</span>
                        <div class="topic-bar-wrap"><div class="topic-bar-bg"><div class="topic-bar-fill" style="width:70%;background:#F59E0B;"></div></div></div>
                        <span class="topic-pct">70%</span>
                    </div>
                    <div class="topic-row">
                        <span class="topic-name">Fungsi</span>
                        <div class="topic-bar-wrap"><div class="topic-bar-bg"><div class="topic-bar-fill" style="width:20%;background:#F59E0B;"></div></div></div>
                        <span class="topic-pct">20%</span>
                    </div>
                    <div class="topic-row">
                        <span class="topic-name">List & Dictionary</span>
                        <div class="topic-bar-wrap"><div class="topic-bar-bg"><div class="topic-bar-fill" style="width:0%;background:#F59E0B;"></div></div></div>
                        <span class="topic-pct">0%</span>
                    </div>
                </div>
            </div>

            {{-- ── PHP ── --}}
            <div class="lang-section">
                <div class="lang-section-header">
                    <img src="{{ asset('img/php.png') }}" alt="PHP"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                    <span class="lang-emoji" style="display:none">🐘</span>
                    <div class="lang-info">
                        <h3>PHP <span class="badge badge-green">25%</span></h3>
                        <span>5 dari 20 materi selesai</span>
                    </div>
                </div>
                <div class="overall-bar-wrap">
                    <div class="overall-bar-label"><span>Progres keseluruhan</span><span>25%</span></div>
                    <div class="bar-bg"><div class="bar-fill" style="width:25%;background:#22C55E;"></div></div>
                </div>
                <div class="topic-list">
                    <div class="topic-row">
                        <span class="topic-name">Pengenalan PHP</span>
                        <div class="topic-bar-wrap"><div class="topic-bar-bg"><div class="topic-bar-fill" style="width:100%;background:#22C55E;"></div></div></div>
                        <span class="topic-pct">100%</span>
                    </div>
                    <div class="topic-row">
                        <span class="topic-name">Variabel & Echo</span>
                        <div class="topic-bar-wrap"><div class="topic-bar-bg"><div class="topic-bar-fill" style="width:50%;background:#22C55E;"></div></div></div>
                        <span class="topic-pct">50%</span>
                    </div>
                    <div class="topic-row">
                        <span class="topic-name">Form & Input</span>
                        <div class="topic-bar-wrap"><div class="topic-bar-bg"><div class="topic-bar-fill" style="width:0%;background:#22C55E;"></div></div></div>
                        <span class="topic-pct">0%</span>
                    </div>
                    <div class="topic-row">
                        <span class="topic-name">Database & MySQL</span>
                        <div class="topic-bar-wrap"><div class="topic-bar-bg"><div class="topic-bar-fill" style="width:0%;background:#22C55E;"></div></div></div>
                        <span class="topic-pct">0%</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function openSidebar()  { document.getElementById('sidebar').classList.add('open'); document.getElementById('overlay').classList.add('open'); }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('overlay').classList.remove('open'); }
    function toggleKategori() {
        document.getElementById('kategoriToggle').classList.toggle('open');
        document.getElementById('kategoriSub').classList.toggle('open');
    }
</script>
</body>
</html>