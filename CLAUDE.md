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
- **Database:** MySQL
- **Cache:** Redis
- **Admin Panel:** Custom Blade (BUKAN Filament)
- **Mobile:** Flutter (Android only)
- **Deployment:** Docker (VPS) — dikerjakan di tahap akhir

---

## 🚨 ATURAN UTAMA — WAJIB DIIKUTI

1. **JANGAN pakai Filament**
2. **FOKUS SEKARANG: Web Pengunjung** dengan sistem auth orang tua
3. **Arsitektur WAJIB:** Controller → Service Layer → Repository → Model
4. **Jangan buat fitur di luar proposal**
5. **Gunakan Service & Repository yang sudah ada** — jangan duplikat

---

## ✅ STATUS PENGERJAAN

| Fase | Keterangan | Status |
|------|-----------|--------|
| Fase 1 | Setup & Database | ✅ SELESAI |
| Fase 2 | Web Admin (custom Blade) | ✅ SELESAI |
| **Fase 3** | **Web Pengunjung + Auth Orang Tua** | 🔥 SEKARANG |
| Fase 4 | REST API untuk Flutter | ⏳ Nanti |
| Fase 5 | Redis Caching | ⏳ Nanti |
| Fase 6 | Docker | ⏳ Nanti |

---

## 🔥 FASE 3 — WEB PENGUNJUNG (FOKUS SEKARANG)

### Alur Akses Pengunjung:

```
Pengunjung buka website
    ↓
Bisa lihat semua halaman (PUBLIC):
- Beranda, Profil Sekolah, Guru, Berita, Galeri, Info Pendaftaran
    ↓
Klik "Daftar Sekarang" / tombol isi formulir
    ↓
Belum login? → Redirect ke halaman LOGIN
    ↓
Belum punya akun? → Klik Register → Buat akun baru
    ↓
Setelah login → Bisa isi Formulir Pendaftaran Online
    ↓
Submit → Data tersimpan → Tampilkan halaman sukses
```

---

## 👥 TIGA AKTOR SISTEM

### 1. Pengunjung Umum (tanpa login) — PUBLIC:
- Lihat Beranda
- Lihat Profil Sekolah (A1)
- Lihat Data Guru (A2)
- Lihat Berita & Pengumuman (A3)
- Lihat Galeri Foto (A4)
- Lihat Info Pendaftaran / brosur digital (A5)
- ❌ TIDAK bisa isi formulir pendaftaran

### 2. Orang Tua (wajib login) — AUTH:
- Semua akses pengunjung umum +
- Isi Formulir Pendaftaran Online (A6)
- Lihat status pendaftaran anaknya (pending/diterima/ditolak)
- Edit formulir jika masih pending

### 3. Admin (login via /admin) — ADMIN:
- Semua fitur B1-B7 (sudah selesai)

---

## 🗄️ DATABASE — TAMBAHAN UNTUK AUTH ORANG TUA

Tabel `users` sudah ada, tambahkan kolom untuk orang tua:

```
users
- id
- name           ← nama orang tua
- email
- password
- role           ← 'admin' atau 'orangtua'
- no_hp          ← tambahan untuk orang tua
- remember_token
- timestamps
```

Tabel `pendaftaran` — pastikan ada relasi ke users:
```
pendaftaran
- id
- user_id (FK→users)        ← orang tua yang mendaftar
- info_pendaftaran_id (FK)
- nama_anak
- tanggal_lahir
- jenis_kelamin
- alamat
- nama_ortu
- no_hp
- dokumen                   ← upload file (opsional)
- status (pending/diterima/ditolak)
- timestamps
```

---

## 🏗️ ARSITEKTUR WAJIB

```
Request Browser
    ↓
Middleware (cek auth jika halaman protected)
    ↓
Controller Web/
    ↓
Service Layer
    ↓
Repository
    ↓
Model → MySQL
    ↓
return view('web.xxx')
```

### Folder Structure:

```
app/Http/Controllers/Web/
├── BerandaController.php
├── ProfilSekolahController.php
├── GuruController.php
├── BeritaController.php
├── GaleriController.php
├── InfoPendaftaranController.php
├── PendaftaranController.php     ← protected (auth)
└── Auth/
    ├── LoginController.php        ← login orang tua
    ├── RegisterController.php     ← register orang tua
    └── LogoutController.php

app/Http/Middleware/
└── OrangtuaMiddleware.php         ← cek role = orangtua

resources/views/web/
├── layouts/
│   └── app.blade.php              ← navbar + footer
├── auth/
│   ├── login.blade.php            ← login orang tua
│   └── register.blade.php        ← register orang tua
├── beranda/
│   └── index.blade.php
├── profil/
│   └── index.blade.php
├── guru/
│   └── index.blade.php
├── berita/
│   ├── index.blade.php
│   └── show.blade.php
├── galeri/
│   └── index.blade.php
├── info-pendaftaran/
│   └── index.blade.php            ← brosur digital (A5)
└── pendaftaran/
    ├── form.blade.php             ← isi formulir (A6) - butuh login
    ├── sukses.blade.php           ← konfirmasi berhasil daftar
    └── status.blade.php          ← cek status pendaftaran
```

---

## 🔗 ROUTE WEB PENGUNJUNG

```php
// routes/web.php

// ── PUBLIC (tanpa login) ──────────────────────────
Route::name('web.')->group(function () {
    Route::get('/', [Web\BerandaController::class, 'index'])->name('beranda');
    Route::get('/profil', [Web\ProfilSekolahController::class, 'index'])->name('profil');
    Route::get('/guru', [Web\GuruController::class, 'index'])->name('guru');
    Route::get('/berita', [Web\BeritaController::class, 'index'])->name('berita');
    Route::get('/berita/{id}', [Web\BeritaController::class, 'show'])->name('berita.show');
    Route::get('/galeri', [Web\GaleriController::class, 'index'])->name('galeri');
    Route::get('/info-pendaftaran', [Web\InfoPendaftaranController::class, 'index'])->name('info-pendaftaran');
});

// ── AUTH ORANG TUA (guest only) ──────────────────
Route::name('web.auth.')->prefix('akun')->middleware('guest')->group(function () {
    Route::get('/login', [Web\Auth\LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [Web\Auth\LoginController::class, 'login']);
    Route::get('/register', [Web\Auth\RegisterController::class, 'showRegister'])->name('register');
    Route::post('/register', [Web\Auth\RegisterController::class, 'register']);
});

// ── PROTECTED (wajib login sebagai orangtua) ─────
Route::name('web.')->middleware(['auth', 'orangtua'])->group(function () {
    Route::post('/akun/logout', [Web\Auth\LogoutController::class, 'logout'])->name('auth.logout');
    Route::get('/pendaftaran', [Web\PendaftaranController::class, 'form'])->name('pendaftaran.form');
    Route::post('/pendaftaran', [Web\PendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/pendaftaran/status', [Web\PendaftaranController::class, 'status'])->name('pendaftaran.status');
});
```

---

## 🎨 DESAIN WEB PENGUNJUNG

Sesuai mockup Gambar 3.11 proposal:
- **Warna:** Kuning `#FFC107` + Biru Navy `#1E3A5F`
- **CSS:** Tailwind CSS
- **Responsive:** Mobile-friendly

### Navbar:
```
[Logo SD Warialau]  Beranda | Profil | Guru | Berita | Galeri | Pendaftaran
                                                    [Login] atau [Nama Orang Tua ▼]
```

### Tombol Daftar di halaman Info Pendaftaran:
```
[Daftar Sekarang]
→ Jika belum login: redirect ke /akun/login
→ Jika sudah login sebagai orangtua: redirect ke /pendaftaran
```

### Halaman Login Orang Tua:
- Form: Email + Password
- Link: "Belum punya akun? Daftar di sini"
- Tombol: "Masuk"
- Setelah login → redirect ke /pendaftaran

### Halaman Register Orang Tua:
- Form: Nama Lengkap, Email, No. HP, Password, Konfirmasi Password
- Role otomatis = 'orangtua'
- Setelah register → auto login → redirect ke /pendaftaran

---

## 🔒 MIDDLEWARE ORANG TUA

```php
// app/Http/Middleware/OrangtuaMiddleware.php
public function handle(Request $request, Closure $next)
{
    if (auth()->check() && auth()->user()->role === 'orangtua') {
        return $next($request);
    }

    // Jika admin coba akses halaman orang tua
    if (auth()->check() && auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('web.auth.login');
}
```

---

## 📋 DETAIL HALAMAN

### Beranda (/)
- Hero: nama sekolah + tagline + foto
- Statistik: jumlah guru, siswa, tahun berdiri
- 3 berita terbaru
- 6 foto galeri terbaru
- Banner info pendaftaran (jika ada yang aktif)

### Info Pendaftaran (/info-pendaftaran) — A5
- Tampilan seperti brosur digital
- Tahun ajaran, tanggal buka-tutup, kuota tersisa
- Syarat-syarat pendaftaran
- Tombol **"Daftar Sekarang"** → cek login

### Formulir Pendaftaran (/pendaftaran) — A6 (WAJIB LOGIN)
- Nama anak, tanggal lahir, jenis kelamin, alamat
- Nama orang tua, no HP (auto-fill dari akun)
- Upload dokumen (opsional)
- Tombol Submit
- Redirect ke halaman sukses setelah berhasil

### Status Pendaftaran (/pendaftaran/status) — (WAJIB LOGIN)
- Tampilkan status pendaftaran orang tua yang login
- Status: Pending (kuning) / Diterima (hijau) / Ditolak (merah)
- Detail data yang sudah didaftarkan

---

## ❌ YANG DILARANG

- ❌ Orang tua bisa akses halaman admin
- ❌ Admin bisa akses halaman formulir orang tua
- ❌ Pengunjung tanpa login bisa isi formulir pendaftaran
- ❌ Fitur di luar proposal (nilai, absensi, SPP, chat)
- ❌ Query langsung di Controller
- ❌ Logic bisnis di Controller

---

## 📦 PACKAGE

```bash
# Sudah ada dari Fase 1:
composer require laravel/sanctum
composer require predis/predis
```

---

## 📌 CATATAN

- Project: `~/project-laravel/we-sd-warialau`
- Redis aktif di port 6379
- Reset DB: `php artisan migrate:fresh --seed`
- Seeder: 1 admin + 1 akun orang tua contoh
- Admin login di: `/admin/login`
- Orang tua login di: `/akun/login`