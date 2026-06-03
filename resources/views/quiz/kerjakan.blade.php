<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz – {{ $materi->judul }}</title>
    @vite(['resources/css/welcome.css', 'resources/js/app.js'])
    <style>
        :root {
            --blue: #3B82F6; --blue-dark: #1D4ED8; --blue-light: #EFF6FF;
            --green: #22C55E; --text: #1E293B; --text-muted: #64748B;
            --border: #E2E8F0; --white: #FFFFFF; --sidebar-w: 260px; --topbar-h: 60px;
        }
        body { font-family: 'Poppins', sans-serif; background: #EFF6FF; min-height: 100vh; margin: 0; }
        a { text-decoration: none; color: inherit; }
        .shell { display: flex; min-height: 100vh; }

        .sidebar {
            width: var(--sidebar-w); background: var(--white);
            border-right: 1px solid var(--border);
            display: flex; flex-direction: column;
            position: fixed; top: 0; left: 0; bottom: 0; z-index: 200;
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
        .nav-item svg { width: 20px; height: 20px; flex-shrink: 0; }
        .sidebar-footer { padding: 1rem .75rem 1.5rem; border-top: 1px solid var(--border); }
        .logout-btn {
            display: flex; align-items: center; gap: .75rem; padding: .7rem 1rem;
            border-radius: 10px; font-size: .9rem; font-weight: 600; color: #EF4444;
            background: none; border: none; width: 100%; cursor: pointer;
            font-family: 'Poppins', sans-serif;
        }
        .logout-btn:hover { background: #FEE2E2; }
        .logout-btn svg { width: 20px; height: 20px; }

        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }
        .topbar {
            height: var(--topbar-h); border-bottom: 1px solid var(--border);
            background: var(--white); display: flex; align-items: center;
            justify-content: flex-end; padding: 0 2rem;
            position: sticky; top: 0; z-index: 100; gap: 1rem;
        }
        .avatar-btn { display: flex; align-items: center; gap: .6rem; background: none; border: none; cursor: pointer; font-family: 'Poppins', sans-serif; text-decoration: none; }
        .avatar-circle {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: .85rem; font-weight: 700;
        }
        .username { font-weight: 600; color: var(--blue); font-size: .95rem; }

        .page-content { flex: 1; padding: 2rem; max-width: 800px; }

        .breadcrumb { font-size: .85rem; color: var(--text-muted); margin-bottom: 1.5rem; }
        .breadcrumb a { color: var(--text-muted); }
        .breadcrumb a:hover { color: var(--blue); }

        .quiz-header {
            background: var(--white); border-radius: 16px;
            padding: 1.5rem; margin-bottom: 1.5rem;
            border: 1.5px solid var(--border);
        }
        .quiz-header h1 { font-size: 1.25rem; font-weight: 800; color: var(--blue-dark); margin-bottom: .25rem; }
        .quiz-header p { font-size: .875rem; color: var(--text-muted); }

        .soal-card {
            background: var(--white); border-radius: 16px;
            padding: 1.5rem; margin-bottom: 1rem;
            border: 1.5px solid var(--border);
        }
        .soal-nomor { font-size: .8rem; font-weight: 600; color: var(--blue); margin-bottom: .5rem; }
        .soal-text { font-size: .95rem; font-weight: 600; color: var(--text); margin-bottom: 1rem; }

        .opsi-list { display: flex; flex-direction: column; gap: .5rem; }
        .opsi-label {
            display: flex; align-items: center; gap: .75rem;
            padding: .75rem 1rem; border-radius: 10px;
            border: 1.5px solid var(--border);
            cursor: pointer; transition: all .2s;
            font-size: .9rem;
        }
        .opsi-label:hover { border-color: var(--blue); background: var(--blue-light); }
        .opsi-label input[type="radio"] { display: none; }
        .opsi-label.selected { border-color: var(--blue); background: var(--blue-light); font-weight: 600; }
        .opsi-circle {
            width: 24px; height: 24px; border-radius: 50%;
            border: 2px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; font-size: .75rem; font-weight: 700;
            transition: all .2s;
        }
        .opsi-label.selected .opsi-circle { border-color: var(--blue); background: var(--blue); color: white; }

        .quiz-footer {
            background: var(--white); border-radius: 16px;
            padding: 1.5rem; margin-top: 1rem;
            border: 1.5px solid var(--border);
            display: flex; justify-content: space-between; align-items: center;
        }
        .quiz-info { font-size: .875rem; color: var(--text-muted); }
        .btn-submit {
            background: var(--blue); color: white; border: none;
            border-radius: 12px; padding: .875rem 2rem;
            font-size: 1rem; font-family: 'Poppins', sans-serif;
            font-weight: 600; cursor: pointer; transition: background .2s;
        }
        .btn-submit:hover { background: var(--blue-dark); }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
        }
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.4); z-index: 150; }
    </style>
</head>
<body>
<div class="shell">

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
            <a href="{{ route('progress') }}" class="nav-item">Progress</a>
            <a href="{{ route('kategori.show', $materi->kategori->slug) }}" class="nav-item active">
                {{ $materi->kategori->nama }}
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

            <div class="breadcrumb">
                <a href="{{ route('dashboard') }}">Dashboard</a> /
                <a href="{{ route('kategori.show', $materi->kategori->slug) }}">{{ $materi->kategori->nama }}</a> /
                <span>Quiz – {{ $materi->judul }}</span>
            </div>

            <div class="quiz-header">
    <h1>Quiz: {{ $materi->judul }}</h1>
    <p>Jawab semua soal berikut dengan benar. Hasil akan langsung ditampilkan setelah submit.</p>
    <div style="display:flex;align-items:center;gap:.75rem;margin-top:1rem;">
        <div style="background:var(--blue-light);border:1.5px solid var(--blue);border-radius:10px;padding:.5rem 1.25rem;display:flex;align-items:center;gap:.5rem;">
            <svg viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" style="width:18px;height:18px;">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
            </svg>
            <span style="font-size:.9rem;font-weight:700;color:var(--blue);" id="timer">{{ $quiz->durasi }}:00</span>
        </div>
        <span style="font-size:.8rem;color:var(--text-muted);">Sisa waktu pengerjaan</span>
    </div>
</div>

            @if(session('error'))
                <div style="background:#FEE2E2;color:#991B1B;border:1px solid #FECACA;border-radius:10px;padding:.75rem 1rem;margin-bottom:1rem;">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('quiz.submit', $materi->id) }}" id="quizForm">
                @csrf

                @foreach($soals as $i => $soal)
<div class="soal-card">
    <div class="soal-nomor">Soal {{ $i + 1 }} dari {{ $soals->count() }}</div>
    <div class="soal-text">{{ $soal->pertanyaan }}</div>
    <div class="opsi-list">
        @foreach(['a' => $soal->opsi_a, 'b' => $soal->opsi_b, 'c' => $soal->opsi_c, 'd' => $soal->opsi_d] as $key => $opsi)
        <label class="opsi-label" onclick="selectOpsi(this)">
            <input type="radio" name="jawaban_{{ $soal->id }}" value="{{ $key }}" required>
            <div class="opsi-circle">{{ strtoupper($key) }}</div>
            {{ $opsi }}
        </label>
        @endforeach
    </div>
</div>
@endforeach

                <div class="quiz-footer">
                    <div class="quiz-info">{{ $soals->count() }} soal • Pastikan semua soal dijawab</div>
                    <button type="submit" class="btn-submit">Submit Quiz →</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    // ── Timer ──
(function() {
    const durasi = {{ $quiz->durasi }}; // menit
    let totalDetik = durasi * 60;

    const timerEl = document.getElementById('timer');

    const interval = setInterval(function() {
        totalDetik--;

        const menit  = Math.floor(totalDetik / 60);
        const detik  = totalDetik % 60;
        timerEl.textContent = menit + ':' + (detik < 10 ? '0' : '') + detik;

        // Warna merah kalau kurang dari 1 menit
        if (totalDetik <= 60) {
            timerEl.style.color = '#EF4444';
            timerEl.closest('div').style.borderColor = '#EF4444';
            timerEl.closest('div').style.background = '#FEE2E2';
        }

        // Auto submit kalau waktu habis
        if (totalDetik <= 0) {
            clearInterval(interval);
            document.getElementById('quizForm').submit();
        }
    }, 1000);
})();

    function selectOpsi(label) {
        const group = label.closest('.opsi-list');
        group.querySelectorAll('.opsi-label').forEach(l => l.classList.remove('selected'));
        label.classList.add('selected');
        label.querySelector('input[type="radio"]').checked = true;
    }
    function openSidebar()  { document.getElementById('sidebar').classList.add('open'); document.getElementById('overlay').classList.add('open'); }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('overlay').classList.remove('open'); }
</script>
</body>
</html>