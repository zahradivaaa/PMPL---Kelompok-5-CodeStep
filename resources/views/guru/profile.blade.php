<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Guru - CodeStep</title>
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

        /* Sidebar — sama persis dengan dashboard */
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
            font-size: .9rem; font-weight: 500;
            color: var(--text-muted); transition: all .2s;
            margin-bottom: .2rem; cursor: pointer;
        }
        .nav-item:hover { background: var(--blue-light); color: var(--blue); }
        .nav-item.active { background: var(--blue); color: var(--white); font-weight: 600; }
        .nav-item svg { width: 20px; height: 20px; flex-shrink: 0; }
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

        /* Main */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

        /* Topbar */
        .topbar {
            height: var(--topbar-h); border-bottom: 1px solid var(--border);
            background: var(--white); display: flex; align-items: center;
            justify-content: flex-end; padding: 0 2rem;
            position: sticky; top: 0; z-index: 100; gap: 1rem;
        }
        .topbar .hamburger { display: none; background: none; border: none; cursor: pointer; margin-right: auto; }
        .topbar .hamburger svg { width: 24px; height: 24px; }
        .avatar-btn {
            display: flex; align-items: center; gap: .6rem;
            background: none; border: none; cursor: pointer;
            padding: 0; font-family: 'Poppins', sans-serif; text-decoration: none;
        }
        .avatar-circle {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: .85rem; font-weight: 700;
            letter-spacing: .5px; flex-shrink: 0;
            transition: transform .2s, box-shadow .2s;
        }
        .avatar-btn:hover .avatar-circle { transform: scale(1.08); box-shadow: 0 2px 10px rgba(59,130,246,.4); }
        .topbar .username { font-weight: 600; color: var(--blue); font-size: .95rem; }

        /* Page */
        .page-content { flex: 1; padding: 2rem; }

        /* Profile Header */
        .profile-header {
            display: flex; align-items: center; gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .avatar-large {
            width: 90px; height: 90px; border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 2rem; font-weight: 700;
            flex-shrink: 0; box-shadow: 0 4px 16px rgba(59,130,246,.35);
        }
        .profile-name {
            font-size: 1.75rem; font-weight: 800; color: var(--text);
        }
        .profile-role {
            font-size: .85rem; color: var(--text-muted);
            margin-top: .2rem;
        }

        /* Cards */
        .profile-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 16px;
            padding: 1.75rem;
            margin-bottom: 1.25rem;
        }
        .card-title {
            font-size: .85rem; font-weight: 600;
            color: var(--text-muted); margin-bottom: 1.25rem;
            text-transform: uppercase; letter-spacing: .05em;
        }
        .detail-row { margin-bottom: 1.25rem; }
        .detail-row:last-child { margin-bottom: 0; }
        .detail-label {
            font-size: .875rem; font-weight: 700;
            color: var(--text); margin-bottom: .2rem;
        }
        .detail-value {
            font-size: .875rem; color: var(--text-muted);
        }
        .detail-value a { color: var(--blue); }
        .detail-value .hint {
            font-size: .8rem; color: var(--text-muted); margin-left: .4rem;
        }

        /* Edit button */
        .btn-edit {
            display: inline-flex; align-items: center; gap: .5rem;
            background: var(--blue); color: white;
            border: none; border-radius: 10px;
            padding: .6rem 1.25rem; font-size: .875rem;
            font-family: 'Poppins', sans-serif; font-weight: 600;
            cursor: pointer; transition: all .2s; text-decoration: none;
        }
        .btn-edit:hover { background: var(--blue-dark); }
        .btn-edit svg { width: 16px; height: 16px; }

        /* Sidebar overlay mobile */
        .sidebar-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,.4); z-index: 150;
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .topbar .hamburger { display: flex; }
            .sidebar-overlay.open { display: block; }
            .page-content { padding: 1.25rem 1rem; }
            .stats-row { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 520px) {
            .stats-row { grid-template-columns: 1fr; }
            .profile-name { font-size: 1.35rem; }
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
            <a href="#" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                Siswa
            </a>
            <a href="#" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10 9 9 9 8 9"/>
                </svg>
                Materi
            </a>
            <a href="#" class="nav-item">
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

            {{-- Profile Header --}}
            <div class="profile-header">
                <div class="avatar-large">{{ $initials }}</div>
                <div>
                    <div class="profile-name">{{ $user->name }}</div>
                    <div class="profile-role">Guru · CodeStep</div>
                </div>
            </div>

            {{-- User details card --}}
            <div class="profile-card">
                <div class="card-title">User details</div>

                <div class="detail-row">
                    <div class="detail-label">Email address</div>
                    <div class="detail-value">
                        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                        <span class="hint">(Visible to other course participants)</span>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Username</div>
                    <div class="detail-value">{{ $user->username ?? $user->name }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Timezone</div>
                    <div class="detail-value">Asia/Jakarta</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Bergabung sejak</div>
                    <div class="detail-value">{{ $user->created_at->translatedFormat('d F Y') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openSidebar()  { document.getElementById('sidebar').classList.add('open'); document.getElementById('overlay').classList.add('open'); }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('overlay').classList.remove('open'); }
</script>
</body>
</html>