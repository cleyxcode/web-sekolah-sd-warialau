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
- **Database:** SQLite
- **Cache:** Redis (wajib diimplementasikan di Fase ini)
- **Admin Panel:** Custom Blade (BUKAN Filament)
- **Mobile:** Flutter (Android only)
- **Deployment:** Docker (VPS) — dikerjakan di tahap akhir

---

## 🚨 ATURAN UTAMA — WAJIB DIIKUTI

1. **JANGAN pakai Filament**
2. **FOKUS SEKARANG: Fase 4 (REST API) + Fase 5 (Redis)** — dikerjakan bersamaan
3. **Arsitektur WAJIB:** Controller → Service Layer (+ Redis) → Repository → Model
4. **Semua endpoint API wajib pakai Redis Cache**
5. **Jangan buat fitur di luar proposal**
6. **Gunakan Service & Repository yang sudah ada** — jangan duplikat

---

## ✅ STATUS PENGERJAAN

| Fase | Keterangan | Status |
|------|-----------|--------|
| Fase 1 | Setup & Database | ✅ SELESAI |
| Fase 2 | Web Admin (custom Blade) | ✅ SELESAI |
| Fase 3 | Web Pengunjung + Auth Orang Tua | ✅ SELESAI |
| **Fase 4** | **REST API untuk Flutter** | 🔥 SEKARANG |
| **Fase 5** | **Redis Caching** | 🔥 SEKARANG (digabung Fase 4) |
| Fase 6 | Docker | ⏳ Nanti |

---

## 🔥 FASE 4 + 5 — REST API & REDIS CACHING (FOKUS SEKARANG)

### Endpoint yang HARUS dibuat:

| Method | Endpoint | Fungsi | Redis Key | TTL |
|--------|----------|--------|-----------|-----|
| GET | `/api/v1/profil-sekolah` | C1 - Data profil sekolah | `profil_sekolah` | 86400 (1 hari) |
| GET | `/api/v1/guru` | C2 - Daftar guru | `guru:all` | 3600 (1 jam) |
| GET | `/api/v1/berita` | C3 - List berita (published) | `berita:all` | 1800 (30 menit) |
| GET | `/api/v1/berita/{id}` | C3 - Detail berita | `berita:{id}` | 3600 (1 jam) |
| GET | `/api/v1/galeri` | C4 - Galeri foto | `galeri:all` | 3600 (1 jam) |
| GET | `/api/v1/info-pendaftaran/aktif` | C5 - Info pendaftaran aktif | `info_pendaftaran:aktif` | 1800 (30 menit) |

### Semua endpoint:
- ✅ **PUBLIC** — tidak perlu login/token
- ✅ **Wajib pakai Redis Cache** di Service Layer
- ✅ **Response format JSON standar** (lihat di bawah)
- ✅ **Invalidasi cache** otomatis saat admin update data

---

## ⚡ CARA IMPLEMENTASI REDIS (WAJIB SEPERTI INI)

### Alur dengan Redis:

```
Flutter kirim request GET /api/v1/guru
    ↓
ApiController → GuruService
    ↓
Service cek Redis: Cache::get('guru:all')
    ↓ Cache HIT           ↓ Cache MISS
    ↓                     GuruRepository::getAll()
    ↓                          ↓
    ↓                     Ambil dari SQLite
    ↓                          ↓
    ↓                     Cache::put('guru:all', $data, 3600)
    ↓←────────────────────────┘
return JSON response ke Flutter
```

### Contoh Kode Service dengan Redis:

```php
// app/Services/GuruService.php
use Illuminate\Support\Facades\Cache;

class GuruService
{
    public function __construct(private GuruRepository $repo) {}

    // Untuk API Flutter — dengan Redis
    public function getAllForApi()
    {
        return Cache::remember('guru:all', 3600, function () {
            return $this->repo->getAllActive();
        });
    }

    // Invalidasi cache saat admin update
    public function clearCache()
    {
        Cache::forget('guru:all');
    }
}
```

### Invalidasi cache di Admin Controller (WAJIB):

```php
// Setiap kali admin create/update/delete data,
// cache harus dihapus agar data Flutter selalu fresh

// Contoh di Admin\GuruController:
public function store(GuruRequest $request)
{
    $this->guruService->create($request->validated());
    $this->guruService->clearCache(); // ← WAJIB
    return redirect()->route('admin.guru.index')
        ->with('success', 'Data guru berhasil ditambahkan');
}

public function update(GuruRequest $request, $id)
{
    $this->guruService->update($id, $request->validated());
    $this->guruService->clearCache(); // ← WAJIB
    return redirect()->route('admin.guru.index')
        ->with('success', 'Data guru berhasil diupdate');
}

public function destroy($id)
{
    $this->guruService->delete($id);
    $this->guruService->clearCache(); // ← WAJIB
    return redirect()->route('admin.guru.index')
        ->with('success', 'Data guru berhasil dihapus');
}
```

---

## 📡 FORMAT RESPONSE API (WAJIB KONSISTEN)

### Sukses — list data:
```json
{
    "success": true,
    "message": "Data berhasil diambil",
    "data": [
        { "id": 1, "nama": "...", ... },
        { "id": 2, "nama": "...", ... }
    ]
}
```

### Sukses — single data:
```json
{
    "success": true,
    "message": "Data berhasil diambil",
    "data": {
        "id": 1,
        "nama": "..."
    }
}
```

### Error — data tidak ditemukan:
```json
{
    "success": false,
    "message": "Data tidak ditemukan",
    "data": null
}
```

---

## 🏗️ ARSITEKTUR WAJIB

```
Flutter
    ↓ HTTP GET
Api\Controller (app/Http/Controllers/Api/)
    ↓
Service Layer (cek Redis Cache dulu)
    ↓ cache miss
Repository (query SQLite)
    ↓
Model
    ↓
Service (simpan ke Redis)
    ↓
Controller → return response()->json(...)
```

### Folder Structure:

```
app/Http/Controllers/
└── Api/                              ← BUAT DI SINI
    ├── ProfilSekolahController.php
    ├── GuruController.php
    ├── BeritaController.php
    ├── GaleriController.php
    └── InfoPendaftaranController.php

app/Services/                         ← UPDATE yang sudah ada, tambah Redis
├── GuruService.php                   ← tambah getAllForApi() + clearCache()
├── BeritaService.php                 ← tambah getAllForApi() + clearCache()
├── GaleriService.php                 ← tambah getAllForApi() + clearCache()
├── InfoPendaftaranService.php        ← tambah getAktifForApi() + clearCache()
└── ProfilSekolahService.php          ← tambah getForApi() + clearCache()

app/Http/Resources/                   ← BUAT API Resource (transform data)
├── GuruResource.php
├── BeritaResource.php
├── GaleriResource.php
├── InfoPendaftaranResource.php
└── ProfilSekolahResource.php
```

---

## 🔗 ROUTE API

```php
// routes/api.php

Route::prefix('v1')->name('api.v1.')->group(function () {

    // C1 - Profil Sekolah
    Route::get('/profil-sekolah', [Api\ProfilSekolahController::class, 'index']);

    // C2 - Guru
    Route::get('/guru', [Api\GuruController::class, 'index']);

    // C3 - Berita
    Route::get('/berita', [Api\BeritaController::class, 'index']);
    Route::get('/berita/{id}', [Api\BeritaController::class, 'show']);

    // C4 - Galeri
    Route::get('/galeri', [Api\GaleriController::class, 'index']);

    // C5 - Info Pendaftaran
    Route::get('/info-pendaftaran/aktif', [Api\InfoPendaftaranController::class, 'aktif']);

});
```

---

## 🔧 KONFIGURASI REDIS

```env
# .env
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

```php
// config/cache.php — pastikan default = redis
'default' => env('CACHE_DRIVER', 'redis'),
```

---

## 📋 DETAIL SETIAP ENDPOINT

### GET /api/v1/profil-sekolah
```json
{
    "success": true,
    "message": "Data berhasil diambil",
    "data": {
        "nama_sekolah": "SD Negeri Warialau",
        "visi": "...",
        "misi": "...",
        "sejarah": "...",
        "alamat": "...",
        "kontak": "...",
        "logo": "http://..."
    }
}
```

### GET /api/v1/guru
```json
{
    "success": true,
    "message": "Data berhasil diambil",
    "data": [
        {
            "id": 1,
            "nama": "...",
            "nip": "...",
            "jabatan": "...",
            "mata_pelajaran": "...",
            "foto": "http://..."
        }
    ]
}
```

### GET /api/v1/berita
```json
{
    "success": true,
    "message": "Data berhasil diambil",
    "data": [
        {
            "id": 1,
            "judul": "...",
            "ringkasan": "...",
            "gambar": "http://...",
            "kategori": "...",
            "tanggal_publish": "2026-01-01"
        }
    ]
}
```

### GET /api/v1/info-pendaftaran/aktif
```json
{
    "success": true,
    "message": "Data berhasil diambil",
    "data": {
        "id": 1,
        "tahun_ajaran": "2026/2027",
        "tanggal_buka": "2026-01-01",
        "tanggal_tutup": "2026-02-01",
        "kuota": 60,
        "syarat": "...",
        "status": "aktif"
    }
}
```

---

## ❌ YANG DILARANG

- ❌ Endpoint API tanpa Redis Cache
- ❌ Query langsung di Controller
- ❌ Logic bisnis di Controller
- ❌ Endpoint yang butuh login (semua API public)
- ❌ Fitur di luar proposal
- ❌ Duplikat Service/Repository

---

## 📦 PACKAGE

```bash
# Pastikan sudah terinstall:
composer require predis/predis

# Cek Redis aktif:
redis-cli ping
# Output: PONG ✅
```

---

## 🧪 CARA TEST API

Setelah selesai, test dengan curl:

```bash
# Test profil sekolah
curl http://localhost/api/v1/profil-sekolah

# Test guru
curl http://localhost/api/v1/guru

# Test berita
curl http://localhost/api/v1/berita

# Test galeri
curl http://localhost/api/v1/galeri

# Test info pendaftaran aktif
curl http://localhost/api/v1/info-pendaftaran/aktif
```

Atau test via MCP server app di Claude Code:
```
test semua endpoint API dan pastikan Redis cache berjalan
```

---

## 📌 CATATAN

- Project: `~/project-laravel/we-sd-warialau`
- Redis aktif di port 6379 (sudah diverifikasi PONG)
- Database: SQLite
- Reset DB: `php artisan migrate:fresh --seed`
- Setelah API selesai → lanjut Fase 6 Docker