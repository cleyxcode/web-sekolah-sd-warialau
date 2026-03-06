# CLAUDE.md — Instruksi Project Skripsi
# Sistem Informasi SD Negeri Warialau
# Oleh: Bredcly Fransiscus Tuhuleruw (12155201220021)
# UKIM Ambon — 2026

---

## 📌 IDENTITAS PROJECT

- **Judul Skripsi:** Implementasi REST API Berarsitektur Service Layer pada Sistem Informasi SD Negeri Warialau Berbasis Web dan Mobile
- **Stack:** Laravel 12 + Blade (Admin & Web Pengunjung) + Flutter (Mobile Android)
- **Arsitektur:** Service Layer + Repository Pattern + Redis Caching
- **Metode Penelitian:** RAD (Rapid Application Development)
- **Database:** sqlite
- **Cache:** Redis
- **Admin Panel:** Custom Blade (BUKAN Filament)
- **Mobile:** Flutter (Android only)
- **Deployment:** Docker (VPS) — dikerjakan di tahap akhir

---

## 🚨 ATURAN UTAMA — WAJIB DIIKUTI

1. **JANGAN pakai Filament** — Admin panel dibuat custom dengan Blade + Tailwind CSS
2. **FOKUS SEKARANG: Halaman Admin saja** — Web pengunjung & Flutter dikerjakan setelah admin selesai
3. **Arsitektur WAJIB:** Controller → Service Layer → Repository → Model
4. **Jangan buat fitur di luar proposal** (nilai, absensi, SPP, chat, dll)
5. **Nama variabel domain** pakai Bahasa Indonesia (siswa, guru, berita, dll)

---

## 🗓️ URUTAN PENGERJAAN

### ✅ SEKARANG DIKERJAKAN — FASE 2: WEB ADMIN (Custom Blade)

#### Setup Awal:
- [ ] Install Laravel Sanctum
- [ ] Buat semua migration sesuai ERD
- [ ] Buat semua Model + relasi
- [ ] Buat Seeder: 1 akun admin default
- [ ] Setup layout admin (sidebar, navbar, Tailwind CSS)

#### Halaman Admin:
- [ ] Login Admin (B0)
- [ ] Dashboard (statistik: total guru, siswa, berita, pendaftaran)
- [ ] Kelola Profil Sekolah (B1)
- [ ] Kelola Data Guru — CRUD (B2)
- [ ] Kelola Data Siswa — CRUD (B3)
- [ ] Kelola Berita & Pengumuman — CRUD (B4)
- [ ] Kelola Galeri Foto — CRUD (B5)
- [ ] Kelola Info Pendaftaran (B6)
- [ ] Kelola Data Formulir Pendaftaran Masuk (B7)
- [ ] Logout

---

### ⏳ DIKERJAKAN SETELAH ADMIN SELESAI

#### FASE 3 — Web Pengunjung (Blade)
- Beranda, Profil, Guru, Berita, Galeri, Info Pendaftaran, Formulir Online

#### FASE 4 — REST API untuk Flutter
- Endpoint publik C1-C5

#### FASE 5 — Redis Caching
- Cache data publik di Service Layer

#### FASE 6 — Docker
- Dockerfile + docker-compose.yml

---

## 🗄️ DATABASE — SESUAI ERD PROPOSAL (Gambar 3.9)

```
users
- id, name, email, password, role (admin), remember_token, timestamps

profil_sekolah
- id, nama_sekolah, visi, misi, sejarah, alamat, kontak, logo, updated_at

guru
- id, nama, nip, jabatan, mata_pelajaran, foto, deleted_at, timestamps

siswa
- id, nama, nis, kelas, tahun_ajaran, foto, deleted_at, timestamps

berita
- id, user_id (FK→users), judul, isi, gambar, kategori,
  tanggal_publish, status (draft/publish), deleted_at, timestamps

galeri
- id, user_id (FK→users), judul, foto, keterangan, deleted_at, timestamps

info_pendaftaran
- id, user_id (FK→users), tahun_ajaran, tanggal_buka, tanggal_tutup,
  kuota, syarat, status (aktif/nonaktif), timestamps

pendaftaran
- id, info_pendaftaran_id (FK), nama_anak, tanggal_lahir,
  jenis_kelamin, alamat, nama_ortu, no_hp, dokumen,
  status (pending/diterima/ditolak), timestamps

cache
- key, value, expiration
```

---

## 🏗️ ARSITEKTUR WAJIB (Service Layer Pattern)

```
Request dari Browser
    ↓
Controller (terima & validasi — pakai Form Request)
    ↓
Service Layer (logika bisnis)
    ↓
Repository (query database)
    ↓
Model → MySQL
    ↓
Kembali ke Controller → return view(...)
```

### Struktur Folder:

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/            ← FOKUS SEKARANG
│   │   │   ├── AuthController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── ProfilSekolahController.php
│   │   │   ├── GuruController.php
│   │   │   ├── SiswaController.php
│   │   │   ├── BeritaController.php
│   │   │   ├── GaleriController.php
│   │   │   ├── InfoPendaftaranController.php
│   │   │   └── PendaftaranController.php
│   │   ├── Web/              ← NANTI
│   │   └── Api/              ← NANTI
│   ├── Requests/
│   │   └── Admin/
│   │       ├── GuruRequest.php
│   │       ├── SiswaRequest.php
│   │       ├── BeritaRequest.php
│   │       ├── GaleriRequest.php
│   │       ├── InfoPendaftaranRequest.php
│   │       └── PendaftaranRequest.php
│   └── Middleware/
│       └── AdminMiddleware.php
├── Services/
│   ├── GuruService.php
│   ├── SiswaService.php
│   ├── BeritaService.php
│   ├── GaleriService.php
│   ├── InfoPendaftaranService.php
│   ├── PendaftaranService.php
│   └── ProfilSekolahService.php
├── Repositories/
│   ├── GuruRepository.php
│   ├── SiswaRepository.php
│   ├── BeritaRepository.php
│   ├── GaleriRepository.php
│   ├── InfoPendaftaranRepository.php
│   ├── PendaftaranRepository.php
│   └── ProfilSekolahRepository.php
└── Models/
    ├── User.php
    ├── ProfilSekolah.php
    ├── Guru.php
    ├── Siswa.php
    ├── Berita.php
    ├── Galeri.php
    ├── InfoPendaftaran.php
    └── Pendaftaran.php

resources/views/
├── admin/                    ← FOKUS SEKARANG
│   ├── layouts/
│   │   └── app.blade.php     ← Layout utama admin (sidebar + navbar)
│   ├── auth/
│   │   └── login.blade.php
│   ├── dashboard/
│   │   └── index.blade.php
│   ├── profil-sekolah/
│   │   └── edit.blade.php
│   ├── guru/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   ├── siswa/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   ├── berita/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   ├── galeri/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   ├── info-pendaftaran/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   └── pendaftaran/
│       ├── index.blade.php
│       └── show.blade.php
└── web/                      ← NANTI
```

---

## 🔗 ROUTE ADMIN

```php
// routes/web.php

// Auth Admin
Route::prefix('admin')->name('admin.')->group(function () {

    // Guest only
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    // Auth only
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profil-sekolah', [ProfilSekolahController::class, 'edit'])->name('profil-sekolah.edit');
        Route::put('/profil-sekolah', [ProfilSekolahController::class, 'update'])->name('profil-sekolah.update');

        Route::resource('guru', GuruController::class);
        Route::resource('siswa', SiswaController::class);
        Route::resource('berita', BeritaController::class);
        Route::resource('galeri', GaleriController::class);
        Route::resource('info-pendaftaran', InfoPendaftaranController::class);

        Route::get('pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
        Route::get('pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');
        Route::put('pendaftaran/{id}/status', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.updateStatus');
    });
});
```

---

## 🎨 DESAIN ADMIN PANEL

Sesuai mockup Gambar 3.10 proposal:
- **Warna:** Biru Navy sidebar + putih konten
- **CSS:** Tailwind CSS
- **Sidebar menu:**
  - Dashboard
  - Profil Sekolah
  - Data Guru
  - Data Siswa
  - Berita & Pengumuman
  - Galeri Foto
  - Info Pendaftaran
  - Data Pendaftaran
  - Logout
- **Dashboard** menampilkan: Total Guru, Total Siswa, Pendaftaran Masuk, Berita Tayang

---

## 🔧 CONTOH KODE YANG BENAR

```php
// ✅ Controller — hanya terima request & kembalikan view
class GuruController extends Controller
{
    public function __construct(private GuruService $guruService) {}

    public function index()
    {
        $guru = $this->guruService->getAll();
        return view('admin.guru.index', compact('guru'));
    }

    public function store(GuruRequest $request)
    {
        $this->guruService->create($request->validated());
        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil ditambahkan');
    }
}

// ✅ Service — logika bisnis
class GuruService
{
    public function __construct(private GuruRepository $guruRepository) {}

    public function getAll()
    {
        return $this->guruRepository->getAll();
    }

    public function create(array $data)
    {
        return $this->guruRepository->create($data);
    }
}

// ✅ Repository — query database
class GuruRepository
{
    public function getAll()
    {
        return Guru::latest()->paginate(10);
    }

    public function create(array $data)
    {
        return Guru::create($data);
    }
}
```

---

## ❌ YANG DILARANG

- ❌ Pakai Filament
- ❌ Query langsung di Controller (`Guru::all()` di controller = SALAH)
- ❌ Logika bisnis di Controller
- ❌ Buat fitur di luar proposal (nilai, absensi, SPP, chat, dll)
- ❌ Mulai kerjakan Web Pengunjung atau API Flutter sebelum Admin selesai

---

## 📦 PACKAGE

```bash
composer require laravel/sanctum
composer require predis/predis
npm install -D tailwindcss
```

---

## 📌 CATATAN

- Project: `~/project-laravel/we-sd-warialau`
- Redis aktif di port 6379
- Reset DB: `php artisan migrate:fresh --seed`
- Seeder wajib buat 1 akun admin: admin@warialau.sch.id / password