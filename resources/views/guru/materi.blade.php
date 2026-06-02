<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi – CodeStep</title>
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

        /* Sidebar */
        .sidebar {
        width: var(--sidebar-w);
        background: var(--white);
        border-right: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        z-index: 9999;
        transition: transform .3s ease;
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
        .main {
        margin-left: var(--sidebar-w);
        flex: 1;
        display: flex;
        flex-direction: column;
        position: relative;
        z-index: 1;
        }

        .form-card {
        z-index: 1;
        }

        /* Topbar */
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

        /* Page */
        .page-content { flex: 1; padding: 2rem; }

        /* Layout 2 kolom */
        .materi-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 1.5rem;
            align-items: start;
        }

        /* Table card */
        .table-card {
            background: var(--white); border: 1.5px solid var(--border);
            border-radius: 16px; overflow: hidden;
        }
        .table-header {
            padding: 1.25rem 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 1px solid var(--border);
        }
        .table-header h2 { font-size: 1rem; font-weight: 700; color: var(--blue); }
        .search-wrap { position: relative; }
        .search-input {
            border: 1.5px solid var(--border); border-radius: 10px;
            padding: .5rem 1rem .5rem 2.25rem; font-size: .85rem;
            font-family: 'Poppins', sans-serif; outline: none;
            transition: border .2s; width: 180px;
        }
        .search-input:focus { border-color: var(--blue); }
        .search-icon { position: absolute; left: .75rem; top: 50%; transform: translateY(-50%); color: var(--text-muted); }
        .search-icon svg { width: 16px; height: 16px; }

        .btn-tambah {
            display: flex; align-items: center; gap: .4rem;
            background: var(--blue); color: white;
            border: none; border-radius: 10px;
            padding: .5rem 1rem; font-size: .85rem;
            font-family: 'Poppins', sans-serif; font-weight: 600;
            cursor: pointer; transition: background .2s;
        }
        .btn-tambah:hover { background: var(--blue-dark); }

        table { width: 100%; border-collapse: collapse; }
        thead th {
            background: #F8FAFC; padding: .875rem 1.25rem;
            text-align: left; font-size: .8rem; font-weight: 600;
            color: var(--text-muted); border-bottom: 1px solid var(--border);
        }
        tbody tr { border-bottom: 1px solid var(--border); transition: background .15s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #F8FAFC; }
        tbody td { padding: .875rem 1.25rem; font-size: .875rem; color: var(--text); }

        .badge-kategori {
            display: inline-block; padding: .2rem .6rem;
            border-radius: 6px; font-size: .75rem; font-weight: 600;
        }
        .badge-java   { background: #DBEAFE; color: #1D4ED8; }
        .badge-python { background: #FEF9C3; color: #B45309; }
        .badge-php    { background: #DCFCE7; color: #166534; }

        .file-link { color: var(--blue); font-size: .8rem; display: flex; align-items: center; gap: .3rem; }
        .file-link svg { width: 14px; height: 14px; }

        .btn-edit {
            background: none; border: 1.5px solid var(--blue);
            color: var(--blue); border-radius: 7px;
            padding: .3rem .7rem; font-size: .78rem;
            font-family: 'Poppins', sans-serif; font-weight: 600;
            cursor: pointer; transition: all .2s; margin-right: .3rem;
        }
        .btn-edit:hover { background: var(--blue); color: white; }
        .btn-hapus {
            background: none; border: 1.5px solid #EF4444;
            color: #EF4444; border-radius: 7px;
            padding: .3rem .7rem; font-size: .78rem;
            font-family: 'Poppins', sans-serif; font-weight: 600;
            cursor: pointer; transition: all .2s;
        }
        .btn-hapus:hover { background: #EF4444; color: white; }

        /* Pagination */
        .pagination { display: flex; justify-content: center; align-items: center; gap: .5rem; padding: 1rem; }
        .page-info { font-size: .8rem; color: var(--text-muted); padding: .5rem 1rem; }

        /* Form card */
        .form-card {
            background: var(--white); border: 1.5px solid var(--border);
            border-radius: 16px; overflow: hidden;
            position: sticky; top: 80px;
        }
        .form-card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .form-card-header h2 { font-size: 1rem; font-weight: 700; color: var(--blue-dark); }
        .form-card-header p { font-size: .8rem; color: var(--text-muted); margin-top: .2rem; }
        .form-card-body { padding: 1.5rem; }

        .form-group { margin-bottom: 1rem; }
        .form-label { display: block; font-size: .85rem; font-weight: 600; color: var(--text); margin-bottom: .4rem; }
        .form-control {
            width: 100%; padding: .7rem 1rem;
            border: 1.5px solid var(--border); border-radius: 10px;
            font-family: 'Poppins', sans-serif; font-size: .875rem;
            color: var(--text); outline: none; transition: border .2s;
        }
        .form-control:focus { border-color: var(--blue); }
        select.form-control { cursor: pointer; }
        textarea.form-control { resize: vertical; min-height: 80px; }

        /* Upload zone */
        .upload-zone {
            border: 2px dashed var(--border); border-radius: 12px;
            padding: 1.5rem; text-align: center;
            cursor: pointer; transition: all .2s;
            background: #F8FAFC;
        }
        .upload-zone:hover { border-color: var(--blue); background: var(--blue-light); }
        .upload-zone input[type="file"] { display: none; }
        .upload-icon { font-size: 2rem; margin-bottom: .5rem; }
        .upload-text { font-size: .85rem; color: var(--text-muted); }
        .upload-text span { color: var(--blue); font-weight: 600; }
        .upload-format { font-size: .75rem; color: var(--text-muted); margin-top: .25rem; }
        .upload-selected { font-size: .8rem; color: var(--green); font-weight: 600; margin-top: .5rem; }

        .form-footer { display: flex; gap: .75rem; justify-content: flex-end; margin-top: 1.25rem; }
        .btn-batal {
            background: none; border: 1.5px solid var(--border);
            color: var(--text-muted); border-radius: 10px;
            padding: .65rem 1.25rem; font-size: .875rem;
            font-family: 'Poppins', sans-serif; font-weight: 600;
            cursor: pointer; transition: all .2s;
        }
        .btn-batal:hover { border-color: var(--text-muted); color: var(--text); }
        .btn-simpan {
            background: var(--blue); color: white; border: none;
            border-radius: 10px; padding: .65rem 1.5rem;
            font-size: .875rem; font-family: 'Poppins', sans-serif;
            font-weight: 600; cursor: pointer; transition: background .2s;
        }
        .btn-simpan:hover { background: var(--blue-dark); }

        .alert-success {
            background: #DCFCE7; color: #166534; border: 1px solid #BBF7D0;
            border-radius: 10px; padding: .75rem 1rem; font-size: .875rem;
            margin-bottom: 1.25rem;
        }
        .alert-error {
            background: #FEE2E2; color: #991B1B; border: 1px solid #FECACA;
            border-radius: 10px; padding: .75rem 1rem; font-size: .875rem;
            margin-bottom: 1.25rem;
        }

        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.4); z-index: 150; }

        @media (max-width: 1024px) { .materi-layout { grid-template-columns: 1fr; } .form-card { position: static; } }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .topbar .hamburger { display: flex; }
            .sidebar-overlay.open { display: block; }
            .page-content { padding: 1.25rem 1rem; }
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
            <a href="{{ route('guru.materi') }}" class="nav-item active">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                </svg>
                Materi
            </a>
            <a href="{{ route('guru.quiz.index') }}" class="nav-item">
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
                $initials = strtoupper(substr($nameParts[0], 0, 1));
                if (count($nameParts) > 1) $initials .= strtoupper(substr($nameParts[1], 0, 1));
            @endphp
            <a href="#" class="avatar-btn">
                <div class="avatar-circle">{{ $initials }}</div>
                <span class="username">{{ Auth::user()->name }}</span>
            </a>
        </header>

        <div class="page-content">

            @if(session('success'))
                <div class="alert-success">✅ {{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert-error">{{ $errors->first() }}</div>
            @endif

            <div class="materi-layout">

                {{-- Tabel Materi --}}
                <div class="table-card" style="overflow-x: auto;">
                    <div class="table-header">
                        <h2>Daftar Materi</h2>
                        <div style="display:flex;gap:.75rem;align-items:center;">
                            <div class="search-wrap">
                                <span class="search-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                    </svg>
                                </span>
                                <input type="text" class="search-input" placeholder="Cari materi..." id="searchInput" onkeyup="filterTable()">
                            </div>
                        </div>
                    </div>
                    <table id="materiTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Materi</th>
                                <th>Kategori</th>
                                <th>Urutan</th>
                                <th>File</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($materis as $i => $m)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td style="font-weight:600;">{{ $m->judul }}</td>
                                <td>
                                    <span class="badge-kategori badge-{{ strtolower($m->kategori->slug ?? '') }}">
                                        {{ $m->kategori->nama ?? '-' }}
                                    </span>
                                </td>
                                <td>{{ $m->urutan }}</td>
                                <td>
                                    @if($m->file_pdf)
                                        <a href="{{ Storage::url($m->file_pdf) }}" target="_blank" class="file-link">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                                <polyline points="14 2 14 8 20 8"/>
                                            </svg>
                                            {{ basename($m->file_pdf) }}
                                        </a>
                                    @else
                                        <span style="color:var(--text-muted);font-size:.8rem;">Belum ada</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn-edit" onclick="editMateri({{ $m->id }}, '{{ addslashes($m->judul) }}', '{{ addslashes($m->deskripsi) }}', {{ $m->urutan }}, {{ $m->kategori_id }})">Edit</button>
                                    <form method="POST" action="{{ route('guru.materi.destroy', $m->id) }}" style="display:inline;" onsubmit="return confirm('Hapus materi ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-hapus">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="text-align:center;color:var(--text-muted);padding:2rem;">
                                    Belum ada materi. Tambahkan materi baru!
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="page-info">
                        Menampilkan {{ $materis->count() }} materi
                    </div>
                </div>

                {{-- Form Tambah/Edit Materi --}}
                <div class="form-card" id="formCard">
                    <div class="form-card-header">
                        <div>
                            <h2 id="formTitle">Tambah Materi Baru</h2>
                            <p id="formSubtitle">Isi informasi materi pembelajaran untuk siswa.</p>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <form method="POST" id="materiForm" action="{{ route('guru.materi.store') }}" enctype="multipart/form-data">
                            @csrf
                            <span id="methodField"></span>

                            <div class="form-group">
                                <label class="form-label">Kategori</label>
                                <select name="kategori_id" class="form-control" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategoris as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Judul Materi</label>
                                <input type="text" name="judul" class="form-control" placeholder="Contoh: Pengenalan Java" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" placeholder="Deskripsi singkat tentang materi..."></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Upload File PDF</label>
                                <div class="upload-zone" onclick="document.getElementById('pdfInput').click()">
                                    <input type="file" id="pdfInput" name="file_pdf" accept=".pdf" onchange="showFileName(this)">
                                    <div class="upload-icon">📄</div>
                                    <div class="upload-text"><span>Klik untuk upload</span> atau drag & drop</div>
                                    <div class="upload-format">Format: PDF (Maks. 10MB)</div>
                                    <div class="upload-selected" id="fileName"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Urutan Materi</label>
                                <input type="number" name="urutan" class="form-control" placeholder="Contoh: 1" min="1" required>
                                <small style="color:var(--text-muted);font-size:.75rem;">Semakin kecil angka, semakin dulu ditampilkan</small>
                            </div>

                            <div class="form-footer">
                                <button type="button" class="btn-batal" onclick="resetForm()">Batal</button>
                                <button type="submit" class="btn-simpan">Simpan Materi</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function openSidebar()  { document.getElementById('sidebar').classList.add('open'); document.getElementById('overlay').classList.add('open'); }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('overlay').classList.remove('open'); }

    function filterTable() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        document.querySelectorAll('#materiTable tbody tr').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(input) ? '' : 'none';
        });
    }

    function showFileName(input) {
        const name = input.files[0] ? input.files[0].name : '';
        document.getElementById('fileName').textContent = name ? '✅ ' + name : '';
    }

    function editMateri(id, judul, deskripsi, urutan, kategoriId) {
        const form = document.getElementById('materiForm');
        form.action = `/guru/materi/${id}`;
        document.getElementById('methodField').innerHTML = '@method("PUT")';
        document.getElementById('formTitle').textContent = 'Edit Materi';
        document.getElementById('formSubtitle').textContent = 'Perbarui informasi materi.';
        form.querySelector('[name="judul"]').value = judul;
        form.querySelector('[name="deskripsi"]').value = deskripsi;
        form.querySelector('[name="urutan"]').value = urutan;
        form.querySelector('[name="kategori_id"]').value = kategoriId;
        form.querySelector('[name="file_pdf"]').removeAttribute('required');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function resetForm() {
        const form = document.getElementById('materiForm');
        form.action = '{{ route("guru.materi.store") }}';
        document.getElementById('methodField').innerHTML = '';
        document.getElementById('formTitle').textContent = 'Tambah Materi Baru';
        document.getElementById('formSubtitle').textContent = 'Isi informasi materi pembelajaran untuk siswa.';
        form.reset();
        document.getElementById('fileName').textContent = '';
        form.querySelector('[name="file_pdf"]').setAttribute('required', '');
    }
</script>
</body>
</html>