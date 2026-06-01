<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil – CodeStep</title>
    @vite(['resources/css/welcome.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
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
        body { font-family: 'Poppins', sans-serif; background: #EFF6FF; min-height: 100vh; margin: 0; }
        a { text-decoration: none; color: inherit; }
        .shell { display: flex; min-height: 100vh; }

        /* ── Sidebar ── */
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
        }
        .username { font-weight: 600; color: var(--blue); font-size: .95rem; }

        /* ── Page content ── */
        .page-content { flex: 1; padding: 2rem; max-width: 860px; }

        /* ── Profile header ── */
        .profile-header {
            display: flex; align-items: center; gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .profile-avatar-big {
            width: 90px; height: 90px; border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 2rem; font-weight: 700;
            flex-shrink: 0;
        }
        .profile-name { font-size: 1.75rem; font-weight: 800; }
        .profile-name span:first-child { color: var(--text); }
        .profile-name span:last-child { color: var(--blue); }

        /* ── Info cards ── */
        .info-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.25rem;
        }
        .info-card-title {
            font-size: 1rem; font-weight: 600;
            color: var(--text-muted); margin-bottom: 1.25rem;
        }
        .info-row { margin-bottom: 1rem; }
        .info-row:last-child { margin-bottom: 0; }
        .info-label { font-size: .875rem; font-weight: 700; color: var(--text); margin-bottom: .25rem; }
        .info-value { font-size: .875rem; color: var(--text-muted); }
        .info-value a { color: var(--blue); }
        .info-value .note { font-size: .8rem; color: var(--text-muted); }

        /* Course links */
        .course-link {
            display: inline-block; color: var(--blue);
            font-size: .875rem; font-weight: 500;
            margin-bottom: .4rem;
        }
        .course-link:hover { text-decoration: underline; }

        /* ── Footer ── */
        .dash-footer {
            background: #F8FAFC; border-top: 1px solid var(--border);
            padding: 2.5rem 2rem 0; margin: 2rem -2rem 0;
        }
        .footer-inner {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 3rem; align-items: start; padding-bottom: 2rem;
        }
        .footer-logo img { height: 60px; object-fit: contain; margin-bottom: .75rem; display: block; }
        .footer-desc { font-size: .875rem; color: var(--text-muted); line-height: 1.7; max-width: 360px; }
        .contact-section h4 { font-size: 1.1rem; font-weight: 700; color: var(--green); margin-bottom: 1rem; }
        .contact-item-wrap {
            display: flex; align-items: center; gap: .75rem;
            border-left: 3px solid var(--yellow);
            padding-left: .75rem; margin-bottom: .75rem;
        }
        .contact-icon-round {
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--blue-light);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .contact-icon-round img { width: 18px; height: 18px; object-fit: contain; }
        .contact-text { font-size: .875rem; color: var(--text); }
        .contact-text a { color: var(--blue); }
        .footer-copyright {
            text-align: center; padding: 1.25rem 0;
            font-size: .8rem; color: var(--text-muted);
            border-top: 1px solid var(--border);
        }

        /* ── Mobile overlay ── */
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.4); z-index: 150; }
        @media (max-width: 900px) { .footer-inner { grid-template-columns: 1fr; gap: 2rem; } }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .topbar .hamburger { display: flex; }
            .sidebar-overlay.open { display: block; }
            .page-content { padding: 1.25rem 1rem; }
            .dash-footer { margin: 2rem -1rem 0; padding: 2rem 1rem 0; }
        }
        @media (max-width: 520px) {
            .profile-name { font-size: 1.35rem; }
            .profile-avatar-big { width: 70px; height: 70px; font-size: 1.5rem; }
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
            <a href="{{ route('progress') }}" class="nav-item">
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

            {{-- Flash --}}
            @if(session('status') === 'profile-updated')
                <div style="background:#DCFCE7;color:#166534;border:1px solid #BBF7D0;border-radius:10px;padding:.75rem 1rem;font-size:.875rem;margin-bottom:1.25rem;">
                    ✅ Profil berhasil diperbarui!
                </div>
            @endif

            {{-- Profile Header --}}
            <div class="profile-header">
                <div class="profile-avatar-big">{{ $initials }}</div>
                <div class="profile-name">
                    @php
                        $nameParts2 = explode(' ', Auth::user()->name);
                    @endphp
                    @if(count($nameParts2) > 1)
                        <span>{{ $nameParts2[0] }} </span>
                        <span>{{ implode(' ', array_slice($nameParts2, 1)) }}</span>
                    @else
                        <span>{{ Auth::user()->name }}</span>
                        <span></span>
                    @endif
                </div>
            </div>

            {{-- User Details --}}
            <div class="info-card">
                <div class="info-card-title">User details</div>
                <div class="info-row">
                    <div class="info-label">Email address</div>
                    <div class="info-value">
                        <a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a>
                        <span class="note"> (Visible to other course participants)</span>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Username</div>
                    <div class="info-value">{{ Auth::user()->username }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Timezone</div>
                    <div class="info-value">Asia/Jakarta</div>
                </div>
            </div>

            {{-- Course Details --}}
            <div class="info-card">
                <div class="info-card-title">Course details</div>
                <div class="info-row">
                    <div class="info-label">Course profiles</div>
                    <div class="info-value">
                        <a href="{{ route('kategori.show', 'java') }}" class="course-link">Java</a><br>
                        <a href="{{ route('kategori.show', 'python') }}" class="course-link">Python</a><br>
                        <a href="{{ route('kategori.show', 'php') }}" class="course-link">PHP</a>
                    </div>
                </div>
            </div>

            {{-- Login Activity --}}
<div class="info-card">
    <div class="info-card-title">Login activity</div>
    <div class="info-row">
        <div class="info-label">First access to site</div>
        <div class="info-value">
            {{ Auth::user()->created_at->translatedFormat('l, j F Y, g:i A') }}
            ({{ Auth::user()->created_at->diffForHumans() }})
        </div>
    </div>
    <div class="info-row">
        <div class="info-label">Last access to site</div>
        <div class="info-value">
            @if(Auth::user()->last_visit)
                {{ Auth::user()->last_visit->translatedFormat('l, j F Y, g:i A') }}
                ({{ Auth::user()->last_visit->diffForHumans() }})
            @else
                Belum ada data
            @endif
        </div>
    </div>
</div>

            {{-- Footer --}}
            <footer class="dash-footer">
                <div class="footer-inner">
                    <div class="footer-brand">
                        <div class="footer-logo">
                            <img src="{{ asset('img/logo dan codestep.png') }}" alt="CodeStep Logo">
                        </div>
                        <p class="footer-desc">
                            Di CodeStep, kami membantu siswa belajar pemrograman dasar secara bertahap dan terarah.
                        </p>
                    </div>
                    <div class="contact-section">
                        <h4>Contact Us</h4>
                        <div class="contact-item-wrap">
                            <div class="contact-icon-round">
                                <img src="{{ asset('img/emailicon.png') }}" alt="Email">
                            </div>
                            <div class="contact-text">
                                <a href="mailto:codestep@gmail.com">codestep@gmail.com</a>
                            </div>
                        </div>
                        <div class="contact-item-wrap">
                            <div class="contact-icon-round">
                                <img src="{{ asset('img/telepon.png') }}" alt="Phone">
                            </div>
                            <div class="contact-text">
                                <a href="tel:081382311921">0813-8231-1921</a>
                            </div>
                        </div>
                        <div class="contact-item-wrap">
                            <div class="contact-icon-round">
                                <img src="{{ asset('img/instagramicon.png') }}" alt="Instagram">
                            </div>
                            <div class="contact-text">
                                <a href="https://instagram.com/codeStep.id" target="_blank">@codeStep.id</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-copyright">© 2026 CodeStep. All rights reserved.</div>
            </footer>

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