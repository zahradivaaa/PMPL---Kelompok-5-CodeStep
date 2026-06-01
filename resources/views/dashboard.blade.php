<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – CodeStep</title>
    @vite(['resources/css/welcome.css', 'resources/js/app.js'])
    <style>
        /* ── Reset & Variables ── */
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
            --radius:     12px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #F1F5F9;
            min-height: 100vh;
            margin: 0;
        }

        a { text-decoration: none; color: inherit; }

        /* ── Layout ── */
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
        .nav-item img.nav-icon { width: 20px; height: 20px; flex-shrink: 0; object-fit: contain; }

        .nav-sub { padding-left: 1rem; }
        .nav-sub .nav-item { font-size: .85rem; font-weight: 400; }

        .nav-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .7rem 1rem;
            border-radius: 10px;
            font-size: .9rem;
            font-weight: 500;
            color: var(--text-muted);
            cursor: pointer;
            transition: all .2s;
            margin-bottom: .2rem;
            user-select: none;
        }
        .nav-toggle:hover { background: var(--blue-light); color: var(--blue); }
        .nav-toggle .left { display: flex; align-items: center; gap: .75rem; }
        .nav-toggle img.nav-icon { width: 20px; height: 20px; object-fit: contain; }
        .nav-toggle .arrow { transition: transform .3s; width: 16px; height: 16px; }
        .nav-toggle.open .arrow { transform: rotate(180deg); }

        .nav-sub { display: none; }
        .nav-sub.open { display: block; }

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
        .topbar .username { font-weight: 600; color: var(--blue); font-size: .95rem; }
        .topbar .hamburger {
            display: none; background: none; border: none;
            cursor: pointer; margin-right: auto;
        }
        .topbar .hamburger svg { width: 24px; height: 24px; }

        /* ── Avatar inisial ── */
        .avatar-btn {
            display: flex;
            align-items: center;
            gap: .6rem;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
        }
        .avatar-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: .85rem;
            font-weight: 700;
            letter-spacing: .5px;
            flex-shrink: 0;
            transition: transform .2s, box-shadow .2s;
        }
        .avatar-btn:hover .avatar-circle {
            transform: scale(1.08);
            box-shadow: 0 2px 10px rgba(59,130,246,.4);
        }

        /* ── Page content ── */
        .page-content { flex: 1; padding: 2rem; }

        /* ── Heading ── */
        .page-heading {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--blue-dark);
            margin-bottom: 1.5rem;
        }

        /* ── Top row ── */
        .top-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        /* Streak card */
        .streak-card {
            background: linear-gradient(135deg, #F59E0B, #FBBF24);
            border-radius: 16px;
            padding: 1.5rem;
            color: var(--white);
            position: relative;
            overflow: hidden;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .streak-card::before {
            content: '';
            position: absolute;
            top: -30px; right: -30px;
            width: 140px; height: 140px;
            background: rgba(255,255,255,.15);
            border-radius: 50%;
        }
        .streak-header { display: flex; align-items: flex-start; justify-content: space-between; }
        .streak-robot { font-size: 3.5rem; line-height: 1; }
        .streak-info { text-align: right; }
        .streak-label { font-size: .8rem; font-weight: 600; opacity: .9; }
        .streak-days { font-size: 1.5rem; font-weight: 800; }
        .streak-days span { font-size: 1rem; font-weight: 500; }
        .streak-week { display: flex; gap: .5rem; align-items: center; }
        .streak-week .day { display: flex; flex-direction: column; align-items: center; gap: .2rem; }
        .streak-week .day-name { font-size: .65rem; font-weight: 600; opacity: .85; }
        .streak-week .flame { font-size: 1.1rem; filter: grayscale(1) opacity(.4); }
        .streak-week .flame.active { filter: none; }

        /* Progress card */
        .progress-card {
            background: var(--white);
            border: 2.5px solid var(--green);
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            display: flex;
            gap: 1.25rem;
            align-items: center;
        }
        .donut-wrap { position: relative; flex-shrink: 0; }
        .donut-center {
            position: absolute; inset: 0;
            display: flex; align-items: center; justify-content: center;
            flex-direction: column;
            pointer-events: none;
        }
        .donut-center .big { font-size: 1.1rem; font-weight: 800; color: var(--blue); }
        .donut-center .small { font-size: .65rem; color: var(--text-muted); font-weight: 600; }

        .progress-list { flex: 1; }
        .progress-list h3 {
            font-size: .9rem; font-weight: 700;
            color: var(--text); margin-bottom: .875rem;
            display: flex; justify-content: space-between;
        }
        .progress-list h3 a { color: var(--blue); font-size: .8rem; font-weight: 600; }
        .lang-row { margin-bottom: .7rem; }
        .lang-label { font-size: .8rem; font-weight: 600; margin-bottom: .3rem; color: var(--text-muted); }
        .bar-bg { background: #F1F5F9; border-radius: 99px; height: 6px; overflow: hidden; }
        .bar-fill { height: 100%; border-radius: 99px; }

        /* ── Category cards ── */
        .section-title { font-size: 1rem; font-weight: 700; margin-bottom: 1rem; color: var(--text); }
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
            margin-bottom: 2rem;
        }
        .lang-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 16px;
            padding: 2rem 1rem;
            text-align: center;
            cursor: pointer;
            transition: all .25s;
            display: flex; flex-direction: column;
            align-items: center; gap: .75rem;
        }
        .lang-card:hover { border-color: var(--blue); box-shadow: 0 4px 24px rgba(59,130,246,.15); transform: translateY(-3px); }
        /* Icon gambar di card kategori */
        .lang-card .lang-img {
            width: 64px;
            height: 64px;
            object-fit: contain;
        }
        /* Fallback emoji jika gambar tidak tersedia */
        .lang-card .lang-icon { font-size: 3rem; }
        .lang-card .lang-name { font-size: .95rem; font-weight: 600; color: var(--text); }

        /* ── Footer (gaya landing page) ── */
        .dash-footer {
            background: #F8FAFC;
            border-top: 1px solid var(--border);
            padding: 2.5rem 0 0;
            margin: 0 -2rem;
            padding-left: 2rem;
            padding-right: 2rem;
        }
        .footer-inner {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: start;
            padding-bottom: 2rem;
        }
        .footer-brand {}
        .footer-logo img { height: 60px; object-fit: contain; margin-bottom: 1rem; display: block; }
        .footer-desc {
            font-size: .875rem;
            color: var(--text-muted);
            line-height: 1.7;
            max-width: 380px;
        }

        .contact-section {}
        .contact-section h4 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--green);
            margin-bottom: 1rem;
        }
        .contact-row {
            display: flex;
            align-items: center;
            gap: .75rem;
            font-size: .875rem;
            color: var(--text);
            margin-bottom: .75rem;
        }
        /* Garis kuning kiri + icon bulat — persis landing page */
        .contact-item-wrap {
            display: flex;
            align-items: center;
            gap: .75rem;
            border-left: 3px solid var(--yellow);
            padding-left: .75rem;
            margin-bottom: .75rem;
        }
        .contact-icon-round {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--blue-light);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .contact-icon-round img { width: 18px; height: 18px; object-fit: contain; }
        .contact-icon-round svg { width: 18px; height: 18px; }
        .contact-text { font-size: .875rem; color: var(--text); }
        .contact-text a { color: var(--blue); }

        .footer-copyright {
            text-align: center;
            padding: 1.25rem 0;
            font-size: .8rem;
            color: var(--text-muted);
            border-top: 1px solid var(--border);
        }

        /* ── Mobile overlay ── */
        .sidebar-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,.4); z-index: 150;
        }

        /* ── Responsive ── */
        @media (max-width: 900px) {
            .top-row { grid-template-columns: 1fr; }
            .cards-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-inner { grid-template-columns: 1fr; gap: 2rem; }
        }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .topbar .hamburger { display: flex; }
            .sidebar-overlay.open { display: block; }
            .page-content { padding: 1.25rem 1rem; }
            .dash-footer { margin: 0 -1rem; padding-left: 1rem; padding-right: 1rem; }
        }
        @media (max-width: 520px) {
            .cards-grid { grid-template-columns: 1fr; }
            .page-heading { font-size: 1.35rem; }
            .progress-card { flex-direction: column; text-align: center; }
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
            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}" class="nav-item active">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>

            {{-- Progress --}}
            <a href="{{ route('progress') }}" class="nav-item">
                <img src="{{ asset('img/iconprogres.png') }}" alt="Progress" class="nav-icon">
                Progress
            </a>

            {{-- Kategori dropdown --}}
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
                <a href="{{ route('kategori.show', 'java') }}" class="nav-item">Java</a>
                <a href="{{ route('kategori.show', 'python') }}" class="nav-item">Python</a>
                <a href="{{ route('kategori.show', 'php') }}" class="nav-item">PHP</a>
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

    {{-- Mobile overlay --}}
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

            {{-- Avatar inisial + nama, link ke halaman profile --}}
            <a href="{{ route('profile.edit') }}" class="avatar-btn">
                <div class="avatar-circle" title="Lihat Profil">
                    {{-- Ambil 1-2 huruf pertama dari nama --}}
                    @php
                        $nameParts = explode(' ', Auth::user()->name);
                        $initials = strtoupper(substr($nameParts[0], 0, 1));
                        if (count($nameParts) > 1) {
                            $initials .= strtoupper(substr($nameParts[1], 0, 1));
                        }
                    @endphp
                    {{ $initials }}
                </div>
                <span class="username">{{ Auth::user()->name }}</span>
            </a>
        </header>

        <div class="page-content">

            {{-- Flash --}}
            @if(session('status'))
                <div style="background:#DCFCE7;color:#166534;border:1px solid #BBF7D0;border-radius:10px;padding:.75rem 1rem;font-size:.875rem;margin-bottom:1.25rem;">
                    ✅ {{ session('status') }}
                </div>
            @endif

            <h1 class="page-heading">Hai, {{ Auth::user()->name }}!</h1>

{{-- ── Top row ── --}}
<div class="top-row">

    {{-- Streak --}}
    <div class="streak-card">
        <div class="streak-header">
            <img src="{{ asset('img/streak.png') }}" alt="Robot" style="height:70px;object-fit:contain;">
            <div class="streak-info">
                <div class="streak-label">Current Streak</div>
                <div class="streak-days">🔥 {{ $user->streak }} <span>days</span></div>
            </div>
        </div>
        <div class="streak-week">
            @foreach(['S','M','T','W','T','F','S'] as $i => $d)
                <div class="day">
                    <span class="day-name">{{ $d }}</span>
                    <span class="flame {{ !empty($weekly['days'][$i]) ? 'active' : '' }}">🔥</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Progress --}}
    <div class="progress-card">
        <div class="donut-wrap">
            <canvas id="donut" width="110" height="110"></canvas>
            <div class="donut-center">
                <span class="big">{{ $totalPct > 0 ? round($totalPct).'%' : '0%' }}</span>
                <span class="small">selesai</span>
            </div>
        </div>
        <div class="progress-list">
            <h3>Progress saya <a href="{{ route('progress') }}" style="font-size:1.2rem;font-weight:700;">❯</a></h3>
            @foreach($progress as $p)
                <div class="lang-row">
                    <div class="lang-label" style="display:flex;justify-content:space-between;margin-bottom:.3rem;">
                        <span>{{ $p['lang'] }}</span>
                        <span style="font-size:.75rem;color:{{ $p['pct'] > 0 ? $p['color'] : '#94A3B8' }};">{{ $p['pct'] }}%</span>
                    </div>
                    <div class="bar-bg">
                        <div class="bar-fill" style="width:{{ $p['pct'] > 0 ? $p['pct'] : 100 }}%;background:{{ $p['pct'] > 0 ? $p['color'] : '#E2E8F0' }};"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
            </div>

            {{-- ── Category cards ── --}}
           {{-- ── Category cards ── --}}
<div class="cards-grid">
    <a href="{{ route('kategori.show', 'java') }}" class="lang-card">
        <img src="{{ asset('img/java.png') }}" alt="Java" class="lang-img"
             onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
        <div class="lang-icon" style="display:none">☕</div>
        <div class="lang-name">Java</div>
    </a>
    <a href="{{ route('kategori.show', 'python') }}" class="lang-card">
        <img src="{{ asset('img/phyton.png') }}" alt="Python" class="lang-img"
             onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
        <div class="lang-icon" style="display:none">🐍</div>
        <div class="lang-name">Python</div>
    </a>
    <a href="{{ route('kategori.show', 'php') }}" class="lang-card">
        <img src="{{ asset('img/php.png') }}" alt="PHP" class="lang-img"
             onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
        <div class="lang-icon" style="display:none">🐘</div>
        <div class="lang-name">PHP</div>
    </a>
</div>

              <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-content">

            <!-- Kiri: Logo + Deskripsi -->
            <div class="footer-left">
                <img src="{{ asset('img/logo dan codestep.png') }}" class="footer-logo" alt="CodeStep Logo Full">
                <p class="footer-desc">
                    Di CodeStep, kami membantu siswa belajar pemrograman dasar secara bertahap dan terarah.
                </p>
            </div>

            <!-- Kanan: Contact Us -->
            <div class="footer-right">
                <h3 class="contact-title">Contact Us</h3>

                <div class="contact-list">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <img src="{{ asset('img/emailicon.png') }}" alt="Email">
                        </div>
                        <a href="mailto:codestep@gmail.com" class="contact-link">codestep@gmail.com</a>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <img src="{{ asset('img/telepon.png') }}" alt="Phone">
                        </div>
                        <a href="tel:08138231921" class="contact-link">0813-8231-1921</a>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <img src="{{ asset('img/instagramicon.png') }}" alt="Instagram">
                        </div>
                        <a href="https://instagram.com/codeStep.id" target="_blank" class="contact-link">@codeStep.id</a>
                    </div>
                </div>
            </div>

        </div>
    </footer>

    <!-- COPYRIGHT -->
    <div class="copyright">
        <p>© 2026 CodeStep. All rights reserved.</p>
    </div>

<script>
    // ── Donut chart ──
    (function () {
        const c = document.getElementById('donut');
        if (!c) return;
        const ctx = c.getContext('2d');
        const progressData = @json($progress);
        const total = progressData.reduce((s, p) => s + p.pct, 0);
        let start = -Math.PI / 2;

        if (total === 0) {
            // Semua 0% → lingkaran abu-abu penuh
            ctx.beginPath();
            ctx.arc(55, 55, 40, 0, Math.PI * 2);
            ctx.strokeStyle = '#E2E8F0';
            ctx.lineWidth = 12;
            ctx.stroke();
        } else {
            progressData.forEach(p => {
                if (p.pct === 0) return;
                const end = start + Math.PI * 2 * (p.pct / 100);
                ctx.beginPath();
                ctx.arc(55, 55, 40, start, end);
                ctx.strokeStyle = p.color;
                ctx.lineWidth = 12;
                ctx.stroke();
                start = end;
            });
            // Sisa abu-abu
            if (total < 100) {
                const end = start + Math.PI * 2 * ((100 - total) / 100);
                ctx.beginPath();
                ctx.arc(55, 55, 40, start, end);
                ctx.strokeStyle = '#E2E8F0';
                ctx.lineWidth = 12;
                ctx.stroke();
            }
        }
    })();

    // ── Sidebar mobile ──
    function openSidebar()  { document.getElementById('sidebar').classList.add('open'); document.getElementById('overlay').classList.add('open'); }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('overlay').classList.remove('open'); }

    // ── Kategori toggle ──
    function toggleKategori() {
        document.getElementById('kategoriToggle').classList.toggle('open');
        document.getElementById('kategoriSub').classList.toggle('open');
    }
</script>
</body>
</html>