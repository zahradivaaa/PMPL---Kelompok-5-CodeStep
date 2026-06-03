<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Quiz - CodeStep</title>
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

        body { font-family: 'Poppins', sans-serif; background: #F1F5F9; min-height: 100vh; margin: 0; }
        a { text-decoration: none; color: inherit; }
        .shell { display: flex; min-height: 100vh; }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w); background: var(--white);
            border-right: 1px solid var(--border); display: flex;
            flex-direction: column; position: fixed;
            top: 0; left: 0; bottom: 0; z-index: 9999;
            transition: transform .3s ease;
        }
        .sidebar-logo { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); }
        .sidebar-logo img { height: 44px; object-fit: contain; }
        .sidebar-nav { flex: 1; padding: 1.25rem .75rem; overflow-y: auto; }
        .nav-item {
            display: flex; align-items: center; gap: .75rem;
            padding: .7rem 1rem; border-radius: 10px; font-size: .9rem;
            font-weight: 500; color: var(--text-muted); transition: all .2s;
            margin-bottom: .2rem; cursor: pointer;
        }
        .nav-item:hover { background: var(--blue-light); color: var(--blue); }
        .nav-item.active { background: var(--blue); color: var(--white); font-weight: 600; }
        .nav-item svg { width: 20px; height: 20px; flex-shrink: 0; }
        .sidebar-footer { padding: 1rem .75rem 1.5rem; border-top: 1px solid var(--border); }
        .logout-btn {
            display: flex; align-items: center; gap: .75rem;
            padding: .7rem 1rem; border-radius: 10px; font-size: .9rem; font-weight: 600;
            color: #EF4444; background: none; border: none; width: 100%;
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
            letter-spacing: .5px; flex-shrink: 0; transition: transform .2s, box-shadow .2s;
        }
        .avatar-btn:hover .avatar-circle { transform: scale(1.08); box-shadow: 0 2px 10px rgba(59,130,246,.4); }
        .topbar .username { font-weight: 600; color: var(--blue); font-size: .95rem; }

        /* ── Page content ── */
        .page-content { flex: 1; padding: 2rem; }

        /* Breadcrumb */
        .breadcrumb {
            display: flex; align-items: center; gap: .4rem;
            font-size: .85rem; color: var(--text-muted); margin-bottom: 1.5rem;
        }
        .breadcrumb a { color: var(--blue); font-weight: 500; }
        .breadcrumb a:hover { text-decoration: underline; }

        /* ── Quiz Header Card ── */
        .quiz-header-card {
            background: var(--white); border: 1.5px solid var(--border);
            border-radius: 16px; padding: 1.5rem 2rem; margin-bottom: 1.5rem;
        }
        .quiz-title-row {
            display: flex; align-items: center; gap: .75rem; margin-bottom: 1.1rem;
        }
        .quiz-title-row h1 { font-size: 1.4rem; font-weight: 800; color: var(--blue-dark); margin: 0; }
        .badge {
            display: inline-block; padding: .25rem .75rem;
            border-radius: 99px; font-size: .75rem; font-weight: 600;
        }
        .badge.aktif { background: #DCFCE7; color: #16A34A; }
        .badge.draft { background: #FEF9C3; color: #B45309; }

        .quiz-meta-grid {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
        .meta-item { display: flex; flex-direction: column; gap: .2rem; }
        .meta-label { font-size: .75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: .4px; }
        .meta-value { font-size: .9rem; font-weight: 600; color: var(--text); }

        /* ── Tabs ── */
        .tab-bar {
            display: flex; gap: 0; border-bottom: 2px solid var(--border);
            margin-bottom: 1.5rem;
        }
        .tab-btn {
            padding: .75rem 1.25rem; font-size: .875rem; font-weight: 600;
            color: var(--text-muted); background: none; border: none;
            border-bottom: 2.5px solid transparent; margin-bottom: -2px;
            cursor: pointer; font-family: 'Poppins', sans-serif;
            transition: all .2s; text-decoration: none; display: inline-block;
        }
        .tab-btn:hover { color: var(--blue); }
        .tab-btn.active { color: var(--blue); border-bottom-color: var(--blue); }

        /* ── Table card ── */
        .table-card {
            background: var(--white); border: 1.5px solid var(--border);
            border-radius: 16px; overflow: hidden; margin-bottom: 2rem;
        }
        .table-header {
            padding: 1.25rem 1.5rem; display: flex; align-items: center;
            justify-content: space-between; border-bottom: 1px solid var(--border);
            gap: 1rem; flex-wrap: wrap;
        }
        .table-header h2 { font-size: 1rem; font-weight: 700; color: var(--blue-dark); }
        .btn-primary {
            display: inline-flex; align-items: center; gap: .4rem;
            background: var(--blue); color: var(--white); border: none;
            border-radius: 10px; padding: .55rem 1.1rem; font-size: .85rem;
            font-family: 'Poppins', sans-serif; font-weight: 600;
            cursor: pointer; transition: background .2s; white-space: nowrap; text-decoration: none;
        }
        .btn-primary:hover { background: var(--blue-dark); }
        .btn-primary svg { width: 16px; height: 16px; }

        table { width: 100%; border-collapse: collapse; }
        thead th {
            background: #F8FAFC; padding: .875rem 1.25rem; text-align: left;
            font-size: .8rem; font-weight: 600; color: var(--text-muted);
            border-bottom: 1px solid var(--border);
        }
        tbody tr { border-bottom: 1px solid var(--border); transition: background .15s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #F8FAFC; }
        tbody td { padding: 1rem 1.25rem; font-size: .875rem; color: var(--text); }

        .action-wrap { display: flex; align-items: center; gap: .5rem; }
        .btn-icon {
            width: 32px; height: 32px; border-radius: 8px;
            display: inline-flex; align-items: center; justify-content: center;
            border: 1.5px solid var(--border); background: var(--white);
            cursor: pointer; transition: all .2s;
        }
        .btn-icon svg { width: 15px; height: 15px; }
        .btn-icon.edit:hover { background: var(--blue-light); border-color: var(--blue); }
        .btn-icon.del:hover  { background: #FEE2E2; border-color: var(--red); }
        .btn-icon.edit svg { stroke: var(--blue); }
        .btn-icon.del  svg { stroke: var(--red); }

        .pagination {
            display: flex; justify-content: center; align-items: center;
            gap: .5rem; padding: 1.25rem;
        }
        .page-btn {
            width: 34px; height: 34px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: .85rem; font-weight: 600; border: 1.5px solid var(--border);
            background: none; cursor: pointer; font-family: 'Poppins', sans-serif;
            color: var(--text-muted); transition: all .2s; text-decoration: none;
        }
        .page-btn.active { background: var(--blue); color: white; border-color: var(--blue); }
        .page-btn:hover:not(.active) { border-color: var(--blue); color: var(--blue); }

        .empty-state { text-align: center; padding: 3rem 1rem; color: var(--text-muted); font-size: .9rem; }

        /* Alert */
        .alert { padding: .875rem 1.25rem; border-radius: 10px; font-size: .875rem; font-weight: 500; margin-bottom: 1.25rem; }
        .alert.success { background: #DCFCE7; color: #16A34A; border: 1px solid #BBF7D0; }
        .alert.error   { background: #FEE2E2; color: #DC2626; border: 1px solid #FECACA; }

        /* ── MODAL ── */
        .modal-backdrop {
            display: none; position: fixed; inset: 0;
            background: rgba(15, 23, 42, .55); z-index: 1000;
            align-items: center; justify-content: center;
            padding: 1rem;
        }
        .modal-backdrop.open { display: flex; }
        .modal {
            background: var(--white); border-radius: 16px;
            width: 100%; max-width: 540px;
            box-shadow: 0 20px 60px rgba(0,0,0,.2);
            animation: modalIn .22s ease;
            max-height: 90vh; overflow-y: auto;
        }
        @keyframes modalIn {
            from { opacity: 0; transform: translateY(-12px) scale(.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        .modal-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border);
        }
        .modal-header h3 { font-size: 1.05rem; font-weight: 700; color: var(--blue-dark); margin: 0; }
        .modal-close {
            width: 32px; height: 32px; border-radius: 8px;
            border: 1.5px solid var(--border); background: none;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all .2s;
        }
        .modal-close:hover { background: #F1F5F9; }
        .modal-close svg { width: 16px; height: 16px; stroke: var(--text-muted); }

        .modal-body { padding: 1.5rem; }
        .modal-footer {
            display: flex; justify-content: flex-end; gap: .75rem;
            padding: 1.25rem 1.5rem; border-top: 1px solid var(--border);
        }

        /* Form elements in modal */
        .form-group { display: flex; flex-direction: column; gap: .4rem; margin-bottom: 1.1rem; }
        .form-group:last-child { margin-bottom: 0; }
        .form-label { font-size: .82rem; font-weight: 600; color: var(--text-muted); letter-spacing: .3px; }
        .form-control {
            border: 1.5px solid var(--border); border-radius: 10px;
            padding: .6rem .9rem; font-size: .875rem;
            font-family: 'Poppins', sans-serif; color: var(--text);
            background: var(--white); outline: none;
            transition: border .2s, box-shadow .2s; width: 100%; box-sizing: border-box;
        }
        .form-control:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(59,130,246,.12); }
        .form-control.is-invalid { border-color: var(--red); }
        textarea.form-control { resize: vertical; min-height: 80px; }
        .invalid-feedback { font-size: .78rem; color: var(--red); margin-top: .2rem; }

        .opsi-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; }

        .btn-cancel {
            padding: .6rem 1.4rem; border-radius: 10px;
            border: 1.5px solid var(--border); background: var(--white);
            font-size: .875rem; font-family: 'Poppins', sans-serif;
            font-weight: 600; color: var(--text-muted); cursor: pointer;
            transition: all .2s; text-decoration: none; display: inline-flex; align-items: center;
        }
        .btn-cancel:hover { border-color: var(--text-muted); color: var(--text); }

        /* Sidebar overlay */
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.4); z-index: 150; }

        /* Footer */
        .dash-footer { background: #F8FAFC; border-top: 1px solid var(--border); padding: 2.5rem 2rem 0; margin: 0 -2rem; }
        .footer-inner { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: start; padding-bottom: 2rem; }
        .footer-logo img { height: 60px; object-fit: contain; margin-bottom: 1rem; display: block; }
        .footer-desc { font-size: .875rem; color: var(--text-muted); line-height: 1.7; max-width: 380px; }
        .contact-section h4 { font-size: 1.1rem; font-weight: 700; color: var(--green); margin-bottom: 1rem; }
        .contact-item { display: flex; align-items: center; gap: .75rem; font-size: .875rem; color: var(--text); margin-bottom: .75rem; }
        .contact-icon { width: 36px; height: 36px; border-radius: 50%; background: var(--blue-light); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .contact-icon img { width: 18px; height: 18px; object-fit: contain; }
        .contact-item a { color: var(--blue); }
        .footer-copyright { text-align: center; padding: 1.25rem 0; font-size: .8rem; color: var(--text-muted); border-top: 1px solid var(--border); }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .topbar .hamburger { display: flex; }
            .sidebar-overlay.open { display: block; }
            .page-content { padding: 1.25rem 1rem; }
            .quiz-meta-grid { grid-template-columns: 1fr 1fr; }
            .opsi-grid { grid-template-columns: 1fr; }
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

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                <a href="{{ route('guru.quiz.index') }}">← Kembali ke Daftar Quiz</a>
            </div>

            {{-- Flash messages --}}
            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert error">{{ session('error') }}</div>
            @endif

            {{-- Quiz Header --}}
            <div class="quiz-header-card">
                <div class="quiz-title-row">
                    <h1>{{ $quiz->judul }}</h1>
                </div>
                <div class="quiz-meta-grid">
                    <div class="meta-item">
                        <span class="meta-label">Materi</span>
                        <span class="meta-value">{{ $quiz->materi->judul ?? '-' }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Durasi</span>
                        <span class="meta-value">{{ $quiz->durasi }} Menit</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Tanggal Mulai</span>
                        <span class="meta-value">{{ \Carbon\Carbon::parse($quiz->tanggal_mulai)->format('d M Y H:i') }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Deadline</span>
                        <span class="meta-value">{{ \Carbon\Carbon::parse($quiz->deadline)->format('d M Y H:i') }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Jumlah Soal</span>
                        <span class="meta-value">{{ $quiz->soals->count() }} Soal</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Dibuat</span>
                        <span class="meta-value">{{ \Carbon\Carbon::parse($quiz->created_at)->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

            {{-- Tab Bar --}}
            <div class="tab-bar">
                <button class="tab-btn active" onclick="switchTab('daftar-soal', this)">Daftar Soal</button>
                <a href="{{ route('guru.quiz.hasil', $quiz->id) }}" class="tab-btn">Hasil Siswa</a>
            </div>

            {{-- Daftar Soal Tab --}}
            <div id="tab-daftar-soal">
                <div class="table-card">
                    <div class="table-header">
                        <h2>Daftar Soal</h2>
                        <button class="btn-primary" onclick="openModal()">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Tambah Soal
                        </button>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pertanyaan</th>
                                <th>Tipe</th>
                                <th>Poin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($quiz->soals as $i => $soal)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td style="max-width:420px">{{ $soal->pertanyaan }}</td>
                                <td>Pilihan Ganda</td>
                                <td>{{ $soal->poin ?? 10 }}</td>
                                <td>
                                    <div class="action-wrap">
                                        <button class="btn-icon edit" title="Edit" onclick="openEditModal({{ $soal->id }}, {{ json_encode($soal) }})">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                            </svg>
                                        </button>
                                        <form action="{{ route('guru.soal.destroy', $soal->id) }}" method="POST" onsubmit="return confirm('Hapus soal ini?')">
                                            @csrf @method('DELETE')
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
                                <td colspan="5">
                                    <div class="empty-state">
                                        Belum ada soal. Klik <strong>Tambah Soal</strong> untuk mulai membuat soal.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="pagination">
                        <button class="page-btn">‹</button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">›</button>
                    </div>
                </div>
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
                            <div class="contact-icon"><img src="{{ asset('img/emailicon.png') }}" alt="Email"></div>
                            <a href="mailto:codestep@gmail.com">codestep@gmail.com</a>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon"><img src="{{ asset('img/telepon.png') }}" alt="Phone"></div>
                            <a href="tel:08138231921">0813-8231-1921</a>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon"><img src="{{ asset('img/instagramicon.png') }}" alt="Instagram"></div>
                            <a href="https://instagram.com/codeStep.id" target="_blank">@codeStep.id</a>
                        </div>
                    </div>
                </div>
                <div class="footer-copyright">© 2026 CodeStep. All rights reserved.</div>
            </div>

        </div>
    </div>
</div>

{{-- ── Modal Tambah Soal ── --}}
<div class="modal-backdrop" id="modalBackdrop" onclick="closeModalOutside(event)">
    <div class="modal">
        <div class="modal-header">
            <h3 id="modalTitle">Tambah Soal Baru</h3>
            <button class="modal-close" onclick="closeModal()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <form id="soalForm" action="{{ route('guru.soal.store') }}" method="POST">
            @csrf
            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="soal_id" id="soalId">

            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Pertanyaan</label>
                    <textarea name="pertanyaan" id="pertanyaan" class="form-control" placeholder="Tulis pertanyaan di sini..." required></textarea>
                </div>

                <div class="opsi-grid">
                    <div class="form-group">
                        <label class="form-label">Opsi A</label>
                        <input type="text" name="opsi_a" id="opsi_a" class="form-control" placeholder="Tulis opsi A" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Opsi B</label>
                        <input type="text" name="opsi_b" id="opsi_b" class="form-control" placeholder="Tulis opsi B" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Opsi C</label>
                        <input type="text" name="opsi_c" id="opsi_c" class="form-control" placeholder="Tulis opsi C" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Opsi D</label>
                        <input type="text" name="opsi_d" id="opsi_d" class="form-control" placeholder="Tulis opsi D" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Jawaban Benar</label>
                    <select name="jawaban_benar" id="jawaban_benar" class="form-control" required>
                        <option value="">-- Pilih Jawaban --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Poin</label>
                    <input type="number" name="poin" id="poin" class="form-control" value="10" min="1" max="100">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    <span id="submitLabel">Simpan Soal</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openSidebar()  { document.getElementById('sidebar').classList.add('open'); document.getElementById('overlay').classList.add('open'); }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('overlay').classList.remove('open'); }

    function openModal() {
        document.getElementById('modalTitle').textContent  = 'Tambah Soal Baru';
        document.getElementById('submitLabel').textContent = 'Simpan Soal';
        document.getElementById('soalForm').reset();
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('soalId').value = '';
        document.getElementById('soalForm').action = "{{ route('guru.soal.store') }}";
        document.getElementById('modalBackdrop').classList.add('open');
    }

    function openEditModal(id, soal) {
        document.getElementById('modalTitle').textContent  = 'Edit Soal';
        document.getElementById('submitLabel').textContent = 'Update Soal';
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('soalId').value = id;
        document.getElementById('soalForm').action = '/guru/soal/' + id;

        document.getElementById('pertanyaan').value   = soal.pertanyaan    || '';
        document.getElementById('opsi_a').value       = soal.opsi_a        || '';
        document.getElementById('opsi_b').value       = soal.opsi_b        || '';
        document.getElementById('opsi_c').value       = soal.opsi_c        || '';
        document.getElementById('opsi_d').value       = soal.opsi_d        || '';
        document.getElementById('jawaban_benar').value = soal.jawaban_benar || '';
        document.getElementById('poin').value          = soal.poin          || 10;

        document.getElementById('modalBackdrop').classList.add('open');
    }

    function closeModal() { document.getElementById('modalBackdrop').classList.remove('open'); }

    function closeModalOutside(e) {
        if (e.target === document.getElementById('modalBackdrop')) closeModal();
    }

    function switchTab(name, btn) {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }

    // Auto-open modal if validation errors came back
    @if($errors->any())
        openModal();
    @endif
</script>
</body>
</html>