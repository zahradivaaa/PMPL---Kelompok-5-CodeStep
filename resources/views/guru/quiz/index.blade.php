<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - CodeStep</title>
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
        .page-subheading {
            font-size: .9rem; color: var(--text-muted); margin-bottom: 1.75rem;
        }

        /* ── Table card ── */
        .table-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        .table-header {
            padding: 1.25rem 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 1px solid var(--border);
            gap: 1rem;
            flex-wrap: wrap;
        }
        .table-header h2 {
            font-size: 1rem; font-weight: 700; color: var(--blue-dark);
        }
        .table-header-right {
            display: flex; align-items: center; gap: .75rem;
        }

        .search-input {
            border: 1.5px solid var(--border); border-radius: 10px;
            padding: .5rem 1rem; font-size: .85rem;
            font-family: 'Poppins', sans-serif;
            outline: none; transition: border .2s;
            width: 200px;
        }
        .search-input:focus { border-color: var(--blue); }

        .btn-primary {
            display: inline-flex; align-items: center; gap: .4rem;
            background: var(--blue); color: var(--white);
            border: none; border-radius: 10px;
            padding: .55rem 1.1rem; font-size: .85rem;
            font-family: 'Poppins', sans-serif; font-weight: 600;
            cursor: pointer; transition: background .2s; white-space: nowrap;
            text-decoration: none;
        }
        .btn-primary:hover { background: var(--blue-dark); }
        .btn-primary svg { width: 16px; height: 16px; }

        table { width: 100%; border-collapse: collapse; }
        thead th {
            background: #F8FAFC;
            padding: .875rem 1.25rem;
            text-align: left;
            font-size: .8rem; font-weight: 600;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
        }
        tbody tr { border-bottom: 1px solid var(--border); transition: background .15s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #F8FAFC; }
        tbody td { padding: 1rem 1.25rem; font-size: .875rem; color: var(--text); }

        .badge {
            display: inline-block; padding: .25rem .75rem;
            border-radius: 99px; font-size: .75rem; font-weight: 600;
        }
        .badge.aktif  { background: #DCFCE7; color: #16A34A; }
        .badge.draft  { background: #FEF9C3; color: #B45309; }

        /* Action buttons */
        .action-wrap { display: flex; align-items: center; gap: .5rem; }
        .btn-icon {
            width: 32px; height: 32px; border-radius: 8px;
            display: inline-flex; align-items: center; justify-content: center;
            border: 1.5px solid var(--border); background: var(--white);
            cursor: pointer; transition: all .2s;
        }
        .btn-icon svg { width: 15px; height: 15px; }
        .btn-icon.edit:hover  { background: var(--blue-light); border-color: var(--blue); color: var(--blue); }
        .btn-icon.del:hover   { background: #FEE2E2; border-color: var(--red); color: var(--red); }
        .btn-icon.edit svg { stroke: var(--blue); }
        .btn-icon.del  svg { stroke: var(--red); }

        /* Pagination */
        .pagination {
            display: flex; justify-content: center;
            align-items: center; gap: .5rem;
            padding: 1.25rem;
        }
        .page-btn {
            width: 34px; height: 34px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: .85rem; font-weight: 600;
            border: 1.5px solid var(--border);
            background: none; cursor: pointer;
            font-family: 'Poppins', sans-serif;
            color: var(--text-muted); transition: all .2s;
        }
        .page-btn.active { background: var(--blue); color: white; border-color: var(--blue); }
        .page-btn:hover:not(.active) { border-color: var(--blue); color: var(--blue); }

        /* Empty state */
        .empty-state {
            text-align: center; padding: 3rem 1rem;
            color: var(--text-muted); font-size: .9rem;
        }

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

        /* Alert */
        .alert {
            padding: .875rem 1.25rem; border-radius: 10px;
            font-size: .875rem; font-weight: 500; margin-bottom: 1.25rem;
        }
        .alert.success { background: #DCFCE7; color: #16A34A; border: 1px solid #BBF7D0; }
        .alert.error   { background: #FEE2E2; color: #DC2626; border: 1px solid #FECACA; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .topbar .hamburger { display: flex; }
            .sidebar-overlay.open { display: block; }
            .page-content { padding: 1.25rem 1rem; }
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

            <h1 class="page-heading">Hai, {{ Auth::user()->name }}!</h1>
            <p class="page-subheading">Kelola quiz dan pantau hasil siswa.</p>

            {{-- Flash messages --}}
            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert error">{{ session('error') }}</div>
            @endif

            {{-- Tabel Quiz --}}
            <div class="table-card">
                <div class="table-header">
                    <h2>Daftar Quiz</h2>
                    <div class="table-header-right">
                        <input
                            type="text"
                            class="search-input"
                            placeholder="Cari quiz..."
                            id="searchInput"
                            onkeyup="filterTable()"
                        >
                        <a href="{{ route('guru.quiz.create') }}" class="btn-primary">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Buat Quiz
                        </a>
                    </div>
                </div>

                <table id="quizTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Quiz</th>
                            <th>Materi</th>
                            <th>Jumlah Soal</th>
                            <th>Deadline</th>
                            <th>Hasil Siswa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quizzes as $i => $quiz)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td style="font-weight:600">{{ $quiz->judul }}</td>
                            <td>{{ $quiz->materi->judul ?? '-' }}</td>

                            <td>{{ \Carbon\Carbon::parse($quiz->deadline)->format('d F Y') }}</td>
<td>
    <a href="{{ route('guru.quiz.hasil', $quiz->id) }}"
       style="display:inline-flex;align-items:center;gap:.4rem;background:var(--blue-light);color:var(--blue);border:1.5px solid var(--blue);border-radius:8px;padding:.35rem .875rem;font-size:.8rem;font-weight:600;text-decoration:none;transition:all .2s;"
       onmouseover="this.style.background='var(--blue)';this.style.color='white'"
       onmouseout="this.style.background='var(--blue-light)';this.style.color='var(--blue)'">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
        </svg>
        Lihat Hasil
    </a>
</td>
<td>
    <div class="action-wrap">
        <a href="{{ route('guru.quiz.edit', $quiz->id) }}" class="btn-icon edit" title="Edit">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
        </a>
        <form action="{{ route('guru.quiz.destroy', $quiz->id) }}" method="POST" onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-icon del" title="Hapus">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                    <path d="M10 11v6"/><path d="M14 11v6"/>
                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                </svg>
            </button>
        </form>
    </div>
</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    Belum ada quiz. <a href="{{ route('guru.quiz.create') }}" style="color:var(--blue);font-weight:600">Buat quiz pertama</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                @if($quizzes instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="pagination">
                    @if($quizzes->onFirstPage())
                        <button class="page-btn" disabled>‹</button>
                    @else
                        <a href="{{ $quizzes->previousPageUrl() }}" class="page-btn">‹</a>
                    @endif

                    @for($p = 1; $p <= $quizzes->lastPage(); $p++)
                        <a href="{{ $quizzes->url($p) }}" class="page-btn {{ $quizzes->currentPage() == $p ? 'active' : '' }}">{{ $p }}</a>
                    @endfor

                    @if($quizzes->hasMorePages())
                        <a href="{{ $quizzes->nextPageUrl() }}" class="page-btn">›</a>
                    @else
                        <button class="page-btn" disabled>›</button>
                    @endif
                </div>
                @endif
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

    function filterTable() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const rows  = document.querySelectorAll('#quizTable tbody tr');
        rows.forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(input) ? '' : 'none';
        });
    }

    function confirmDelete() {
        return confirm('Yakin ingin menghapus quiz ini? Data tidak bisa dikembalikan.');
    }
</script>
</body>
</html>