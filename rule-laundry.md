# rule-laundry.md
# Sistem Informasi Laundry — Aturan & Spesifikasi Teknis Lengkap

> Dokumen ini adalah panduan teknis penuh untuk membangun Sistem Informasi Laundry berbasis web dengan Laravel 12. Dokumen mencakup struktur direktori, skema database, RBAC, alur bisnis setiap modul, validasi, PDF, notifikasi, dan konvensi penulisan kode.

---

## 1. IDENTITAS PROYEK

| Item | Detail |
|---|---|
| **Nama Sistem** | Cuciin — Sistem Informasi Manajemen Laundry |
| **Versi** | 1.0.0 |
| **Framework** | Laravel 12 |
| **UI** | Bootstrap 5 (CDN) |
| **Ikon** | Font Awesome 6 Free (CDN) |
| **Alert** | SweetAlert2 (CDN) |
| **Database** | MySQL / MariaDB |
| **PHP** | ≥ 8.2 |
| **Export PDF** | DomPDF (barryvdh/laravel-dompdf) |

---

## 2. CDN DEPENDENCIES

Semua library UI wajib menggunakan CDN. Tidak boleh menggunakan npm/vite untuk library berikut:

```html
<!-- Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<!-- Font Awesome 6 Free -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<!-- Bootstrap 5 JS Bundle (termasuk Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
```

---

## 3. STRUKTUR DIREKTORI PROYEK

```
cuciin/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   └── LoginController.php
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── KategoriController.php
│   │   │   │   ├── LayananController.php
│   │   │   │   ├── PaketController.php
│   │   │   │   ├── PelangganController.php
│   │   │   │   ├── TransaksiController.php
│   │   │   │   ├── PegawaiController.php
│   │   │   │   └── LaporanController.php
│   │   │   └── Public/
│   │   │       ├── HomeController.php
│   │   │       ├── LayananPublicController.php
│   │   │       └── PelangganPublicController.php
│   │   ├── Middleware/
│   │   │   ├── IsAdmin.php
│   │   │   └── RedirectIfAuthenticated.php
│   │   └── Requests/
│   │       ├── KategoriRequest.php
│   │       ├── LayananRequest.php
│   │       ├── PaketRequest.php
│   │       ├── PelangganRequest.php
│   │       ├── TransaksiRequest.php
│   │       └── PegawaiRequest.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── KategoriLayanan.php
│   │   ├── Layanan.php
│   │   ├── Paket.php
│   │   ├── Pelanggan.php
│   │   ├── Transaksi.php
│   │   ├── DetailTransaksi.php
│   │   ├── StatusTransaksi.php
│   │   └── Pegawai.php
│   └── Services/
│       ├── NomorOrderService.php
│       └── PdfService.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── UserSeeder.php
│       ├── KategoriLayananSeeder.php
│       └── LayananSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php          ← layout admin utama
│       │   ├── public.blade.php       ← layout halaman publik
│       │   └── pdf.blade.php          ← layout cetak PDF
│       ├── auth/
│       │   └── login.blade.php
│       ├── admin/
│       │   ├── dashboard/
│       │   │   └── index.blade.php
│       │   ├── kategori/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   └── edit.blade.php
│       │   ├── layanan/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   └── edit.blade.php
│       │   ├── paket/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   └── edit.blade.php
│       │   ├── pelanggan/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   ├── edit.blade.php
│       │   │   └── show.blade.php
│       │   ├── transaksi/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   ├── show.blade.php
│       │   │   └── riwayat.blade.php
│       │   ├── pegawai/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   └── edit.blade.php
│       │   └── laporan/
│       │       ├── index.blade.php
│       │       └── cetak.blade.php
│       ├── public/
│       │   ├── home.blade.php
│       │   ├── layanan.blade.php
│       │   └── pelanggan.blade.php
│       └── pdf/
│           ├── pelanggan.blade.php
│           ├── pelanggan_semua.blade.php
│           ├── transaksi.blade.php
│           └── laporan.blade.php
├── routes/
│   └── web.php
└── config/
    └── laundry.php
```

---

## 4. SKEMA DATABASE (9 Tabel)

### 4.1 Tabel `users`
```sql
CREATE TABLE users (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name            VARCHAR(100) NOT NULL,
    email           VARCHAR(100) NOT NULL UNIQUE,
    password        VARCHAR(255) NOT NULL,
    role            ENUM('admin','umum') NOT NULL DEFAULT 'umum',
    foto            VARCHAR(255) NULL,
    is_active       TINYINT(1) NOT NULL DEFAULT 1,
    remember_token  VARCHAR(100) NULL,
    created_at      TIMESTAMP NULL,
    updated_at      TIMESTAMP NULL
);
```
- `role = 'admin'` → akses panel admin penuh
- `role = 'umum'` → akses hanya halaman publik (read-only)

---

### 4.2 Tabel `kategori_layanan`
```sql
CREATE TABLE kategori_layanan (
    id             BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_kategori  VARCHAR(100) NOT NULL,
    deskripsi      TEXT NULL,
    is_active      TINYINT(1) NOT NULL DEFAULT 1,
    created_at     TIMESTAMP NULL,
    updated_at     TIMESTAMP NULL
);
```
Contoh data: Reguler, Express, Premium, Dry Clean, Setrika.

---

### 4.3 Tabel `layanan`
```sql
CREATE TABLE layanan (
    id                  BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kategori_layanan_id BIGINT UNSIGNED NOT NULL,
    kode_layanan        VARCHAR(20) NOT NULL UNIQUE,   -- e.g. LYN-001
    nama_layanan        VARCHAR(150) NOT NULL,
    satuan              ENUM('kg','pcs','item') NOT NULL DEFAULT 'kg',
    harga               DECIMAL(12,2) NOT NULL DEFAULT 0,
    estimasi_hari       TINYINT UNSIGNED NOT NULL DEFAULT 1,
    deskripsi           TEXT NULL,
    is_active           TINYINT(1) NOT NULL DEFAULT 1,
    created_at          TIMESTAMP NULL,
    updated_at          TIMESTAMP NULL,
    FOREIGN KEY (kategori_layanan_id) REFERENCES kategori_layanan(id) ON DELETE RESTRICT
);
```

---

### 4.4 Tabel `paket`
```sql
CREATE TABLE paket (
    id          BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kode_paket  VARCHAR(20) NOT NULL UNIQUE,  -- e.g. PKT-001
    nama_paket  VARCHAR(150) NOT NULL,
    harga       DECIMAL(12,2) NOT NULL DEFAULT 0,
    deskripsi   TEXT NULL,
    min_berat   DECIMAL(8,2) NULL,
    is_active   TINYINT(1) NOT NULL DEFAULT 1,
    created_at  TIMESTAMP NULL,
    updated_at  TIMESTAMP NULL
);
```

---

### 4.5 Tabel `pelanggan`
```sql
CREATE TABLE pelanggan (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kode_pelanggan  VARCHAR(20) NOT NULL UNIQUE,  -- e.g. PLG-2025-0001
    nama_pelanggan  VARCHAR(150) NOT NULL,
    jenis_kelamin   ENUM('L','P') NOT NULL,
    no_telepon      VARCHAR(20) NOT NULL,
    email           VARCHAR(100) NULL,
    alamat          TEXT NOT NULL,
    tanggal_daftar  DATE NOT NULL,
    poin            INT UNSIGNED NOT NULL DEFAULT 0,
    total_transaksi INT UNSIGNED NOT NULL DEFAULT 0,
    catatan         TEXT NULL,
    is_active       TINYINT(1) NOT NULL DEFAULT 1,
    created_at      TIMESTAMP NULL,
    updated_at      TIMESTAMP NULL
);
```

---

### 4.6 Tabel `pegawai`
```sql
CREATE TABLE pegawai (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kode_pegawai    VARCHAR(20) NOT NULL UNIQUE,  -- e.g. PGW-001
    nama_pegawai    VARCHAR(150) NOT NULL,
    jabatan         VARCHAR(100) NOT NULL,
    no_telepon      VARCHAR(20) NULL,
    alamat          TEXT NULL,
    tanggal_masuk   DATE NOT NULL,
    is_active       TINYINT(1) NOT NULL DEFAULT 1,
    created_at      TIMESTAMP NULL,
    updated_at      TIMESTAMP NULL
);
```

---

### 4.7 Tabel `transaksi`
```sql
CREATE TABLE transaksi (
    id               BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    no_order         VARCHAR(30) NOT NULL UNIQUE,   -- e.g. ORD-2025-00001
    pelanggan_id     BIGINT UNSIGNED NOT NULL,
    pegawai_id       BIGINT UNSIGNED NULL,
    tanggal_masuk    DATE NOT NULL,
    tanggal_estimasi DATE NOT NULL,
    tanggal_selesai  DATE NULL,
    tanggal_ambil    DATETIME NULL,
    subtotal         DECIMAL(12,2) NOT NULL DEFAULT 0,
    total            DECIMAL(12,2) NOT NULL DEFAULT 0,
    bayar            DECIMAL(12,2) NULL,
    kembalian        DECIMAL(12,2) NULL,
    metode_bayar     ENUM('tunai','transfer','qris','dompet_digital') NOT NULL DEFAULT 'tunai',
    status           ENUM('diterima','dicuci','dijemur','disetrika','siap','diambil','batal') NOT NULL DEFAULT 'diterima',
    catatan          TEXT NULL,
    created_at       TIMESTAMP NULL,
    updated_at       TIMESTAMP NULL,
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE RESTRICT,
    FOREIGN KEY (pegawai_id)   REFERENCES pegawai(id)   ON DELETE SET NULL
);
```

---

### 4.8 Tabel `detail_transaksi`
```sql
CREATE TABLE detail_transaksi (
    id           BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    transaksi_id BIGINT UNSIGNED NOT NULL,
    layanan_id   BIGINT UNSIGNED NOT NULL,
    nama_layanan VARCHAR(150) NOT NULL,   -- snapshot nama saat transaksi
    satuan       VARCHAR(20) NOT NULL,
    harga_satuan DECIMAL(12,2) NOT NULL,
    qty          DECIMAL(8,2) NOT NULL DEFAULT 1,
    subtotal     DECIMAL(12,2) NOT NULL DEFAULT 0,
    keterangan   VARCHAR(255) NULL,
    created_at   TIMESTAMP NULL,
    updated_at   TIMESTAMP NULL,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
    FOREIGN KEY (layanan_id)   REFERENCES layanan(id)   ON DELETE RESTRICT
);
```

---

### 4.9 Tabel `status_transaksi` (log riwayat status)
```sql
CREATE TABLE status_transaksi (
    id           BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    transaksi_id BIGINT UNSIGNED NOT NULL,
    status       VARCHAR(50) NOT NULL,
    keterangan   TEXT NULL,
    diubah_oleh  BIGINT UNSIGNED NULL,
    created_at   TIMESTAMP NULL,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
    FOREIGN KEY (diubah_oleh)  REFERENCES users(id)     ON DELETE SET NULL
);
```

---

## 5. ROLE-BASED ACCESS CONTROL (RBAC)

Sistem memiliki **dua role** pengguna:

| Role | Deskripsi | Akses |
|---|---|---|
| `admin` | Administrator sistem | Panel admin: CRUD semua data, laporan, ekspor PDF |
| `umum` | Pengunjung / pengguna umum | Hanya halaman publik: lihat layanan & data pelanggan |

### 5.1 Middleware

**`app/Http/Middleware/IsAdmin.php`**
```php
<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Anda bukan administrator.');
        }
        return $next($request);
    }
}
```

**Daftarkan di `bootstrap/app.php` (Laravel 12):**
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'isAdmin' => \App\Http\Middleware\IsAdmin::class,
    ]);
})
```

### 5.2 Proteksi Route

```php
// routes/web.php

// ─── Halaman Publik (tanpa login) ───────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/layanan',  [LayananPublicController::class, 'index'])->name('public.layanan');
Route::get('/pelanggan',[PelangganPublicController::class, 'index'])->name('public.pelanggan');

// ─── Auth ────────────────────────────────────────────────────────────
Route::get('/login',  [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout',[LoginController::class, 'logout'])->name('logout');

// ─── Panel Admin (wajib login + role admin) ──────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Kategori Layanan
    Route::resource('kategori', KategoriController::class);

    // Layanan
    Route::resource('layanan', LayananController::class);

    // Paket
    Route::resource('paket', PaketController::class);

    // Pelanggan
    Route::resource('pelanggan', PelangganController::class);
    Route::get('pelanggan/{pelanggan}/cetak', [PelangganController::class, 'cetak'])->name('pelanggan.cetak');
    Route::get('pelanggan/cetak-semua',       [PelangganController::class, 'cetakSemua'])->name('pelanggan.cetak-semua');

    // Transaksi
    Route::resource('transaksi', TransaksiController::class)->except(['edit','update','destroy']);
    Route::patch('transaksi/{transaksi}/status', [TransaksiController::class, 'updateStatus'])->name('transaksi.status');
    Route::patch('transaksi/{transaksi}/bayar',  [TransaksiController::class, 'bayar'])->name('transaksi.bayar');
    Route::patch('transaksi/{transaksi}/batal',  [TransaksiController::class, 'batal'])->name('transaksi.batal');
    Route::get('transaksi/{transaksi}/nota',     [TransaksiController::class, 'nota'])->name('transaksi.nota');

    // Pegawai
    Route::resource('pegawai', PegawaiController::class);

    // Laporan
    Route::get('laporan',            [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/cetak',      [LaporanController::class, 'cetak'])->name('laporan.cetak');
    Route::get('laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export-pdf');
});
```

---

## 6. MODUL SISTEM (DETAIL LENGKAP)

---

### MODUL 1 — AUTENTIKASI

**Lokasi:** `app/Http/Controllers/Auth/LoginController.php`

**Aturan Bisnis:**
- Hanya satu halaman login di `/login`.
- Jika login berhasil dan `role = 'admin'` → redirect ke `/admin/dashboard`.
- Jika login berhasil dan `role = 'umum'` → redirect ke `/` (beranda publik).
- Tiga kali gagal login dalam 5 menit → akun dikunci 15 menit (gunakan `ThrottleLogins`).
- Tombol "Logout" selalu ada di header panel admin (POST `/logout`).
- Tidak ada fitur registrasi mandiri; akun `umum` dibuat oleh admin.

**Validasi Login:**
```php
'email'    => ['required','email'],
'password' => ['required','min:6'],
```

---

### MODUL 2 — DASHBOARD ADMIN

**Lokasi:** `app/Http/Controllers/Admin/DashboardController.php`
**View:** `resources/views/admin/dashboard/index.blade.php`

**Konten KPI Cards (baris atas):**
| Card | Data | Ikon FA |
|---|---|---|
| Total Layanan Aktif | `Layanan::where('is_active',1)->count()` | `fa-tshirt` |
| Total Pelanggan | `Pelanggan::where('is_active',1)->count()` | `fa-users` |
| Transaksi Hari Ini | filter `tanggal_masuk = today` | `fa-receipt` |
| Pendapatan Bulan Ini | sum `total` dimana status ≠ batal | `fa-wallet` |

**Konten Tambahan:**
- Tabel **5 transaksi terbaru** (no_order, pelanggan, total, status, badge warna).
- Tabel **5 pelanggan terbaru** (kode, nama, tanggal daftar).
- Bar chart sederhana (gunakan tabel HTML bergaya progress bar Bootstrap) **Transaksi 7 hari terakhir**.
- Daftar **layanan terpopuler bulan ini** (JOIN detail_transaksi GROUP BY layanan_id ORDER BY count DESC LIMIT 5).

---

### MODUL 3 — MANAJEMEN KATEGORI LAYANAN

**Lokasi:** `app/Http/Controllers/Admin/KategoriController.php`

**Operasi CRUD:**
| Aksi | Method | Route | Keterangan |
|---|---|---|---|
| Index | GET | `/admin/kategori` | Tabel semua kategori + badge jumlah layanan |
| Create | GET | `/admin/kategori/create` | Form tambah |
| Store | POST | `/admin/kategori` | Simpan kategori baru |
| Edit | GET | `/admin/kategori/{id}/edit` | Form ubah |
| Update | PATCH | `/admin/kategori/{id}` | Simpan perubahan |
| Destroy | DELETE | `/admin/kategori/{id}` | Hapus (cek relasi layanan) |

**Validasi (`KategoriRequest`):**
```php
'nama_kategori' => ['required','string','max:100','unique:kategori_layanan,nama_kategori,'.$id],
'deskripsi'     => ['nullable','string','max:500'],
'is_active'     => ['required','boolean'],
```

**Aturan Bisnis:**
- Kategori tidak bisa dihapus jika masih ada layanan aktif yang menggunakannya. Tampilkan pesan kesalahan via SweetAlert2.
- Toggle aktif/nonaktif tersedia di halaman index (form PATCH).

---

### MODUL 4 — MANAJEMEN LAYANAN

**Lokasi:** `app/Http/Controllers/Admin/LayananController.php`

**Operasi CRUD:**
| Aksi | Method | Route |
|---|---|---|
| Index | GET | `/admin/layanan` |
| Create | GET | `/admin/layanan/create` |
| Store | POST | `/admin/layanan` |
| Show | GET | `/admin/layanan/{id}` |
| Edit | GET | `/admin/layanan/{id}/edit` |
| Update | PATCH | `/admin/layanan/{id}` |
| Destroy | DELETE | `/admin/layanan/{id}` |

**Validasi (`LayananRequest`):**
```php
'kategori_layanan_id' => ['required','exists:kategori_layanan,id'],
'nama_layanan'        => ['required','string','max:150'],
'satuan'              => ['required','in:kg,pcs,item'],
'harga'               => ['required','numeric','min:0'],
'estimasi_hari'       => ['required','integer','min:1','max:30'],
'deskripsi'           => ['nullable','string','max:1000'],
'is_active'           => ['required','boolean'],
```

**Aturan Bisnis:**
- `kode_layanan` digenerate otomatis: `LYN-{3 digit sequence}` (padded), tidak bisa diubah manual.
- Harga wajib ≥ 0. Format tampilan menggunakan `number_format()` dengan Rp prefix.
- Layanan tidak bisa dihapus jika ada pada `detail_transaksi`. Soft-disable saja (`is_active = 0`).
- Filter & search di halaman index: by kategori, by satuan, by status aktif.

**Tabel Index — Kolom:**
Kode | Nama Layanan | Kategori | Satuan | Harga | Est. Hari | Status | Aksi

---

### MODUL 5 — MANAJEMEN PAKET

**Lokasi:** `app/Http/Controllers/Admin/PaketController.php`

Paket adalah bundel harga tetap (misal: "Paket 5 kg – Rp 25.000"). Tidak terikat ke layanan spesifik.

**Operasi CRUD:**
| Aksi | Method | Route |
|---|---|---|
| Index | GET | `/admin/paket` |
| Create | GET | `/admin/paket/create` |
| Store | POST | `/admin/paket` |
| Edit | GET | `/admin/paket/{id}/edit` |
| Update | PATCH | `/admin/paket/{id}` |
| Destroy | DELETE | `/admin/paket/{id}` |

**Validasi (`PaketRequest`):**
```php
'nama_paket' => ['required','string','max:150'],
'harga'      => ['required','numeric','min:0'],
'deskripsi'  => ['nullable','string','max:1000'],
'min_berat'  => ['nullable','numeric','min:0'],
'is_active'  => ['required','boolean'],
```

**Aturan Bisnis:**
- `kode_paket` digenerate otomatis: `PKT-{3 digit sequence}`.
- Paket ditampilkan di halaman publik beranda sebagai referensi harga.

**Tabel Index — Kolom:**
Kode | Nama Paket | Harga | Min. Berat | Status | Aksi

---

### MODUL 6 — MANAJEMEN PELANGGAN ⭐ (Fitur Utama)

**Lokasi:** `app/Http/Controllers/Admin/PelangganController.php`

**Operasi CRUD:**
| Aksi | Method | Route |
|---|---|---|
| Index | GET | `/admin/pelanggan` |
| Create | GET | `/admin/pelanggan/create` |
| Store | POST | `/admin/pelanggan` |
| Show | GET | `/admin/pelanggan/{id}` |
| Edit | GET | `/admin/pelanggan/{id}/edit` |
| Update | PATCH | `/admin/pelanggan/{id}` |
| Destroy | DELETE | `/admin/pelanggan/{id}` |
| Cetak 1 | GET | `/admin/pelanggan/{id}/cetak` |
| Cetak Semua | GET | `/admin/pelanggan/cetak-semua` |

**Validasi (`PelangganRequest`):**
```php
'nama_pelanggan' => ['required','string','max:150'],
'jenis_kelamin'  => ['required','in:L,P'],
'no_telepon'     => ['required','string','max:20','unique:pelanggan,no_telepon,'.$id],
'email'          => ['nullable','email','max:100','unique:pelanggan,email,'.$id],
'alamat'         => ['required','string','max:500'],
'tanggal_daftar' => ['required','date','before_or_equal:today'],
'catatan'        => ['nullable','string','max:1000'],
```

**Aturan Bisnis:**
- `kode_pelanggan` digenerate otomatis saat `store`: format `PLG-{YYYY}-{4 digit sequence}`, contoh: `PLG-2025-0001`. Gunakan `NomorOrderService`.
- `poin` bertambah 1 poin per Rp 10.000 transaksi (diperbarui otomatis di `TransaksiController` saat status berubah ke `diambil`).
- `total_transaksi` bertambah setiap transaksi selesai (status `diambil`).
- Halaman **show** menampilkan: data profil + tabel riwayat transaksi pelanggan tersebut.
- Search: by nama, kode, no_telepon. Filter: by jenis_kelamin, by status aktif.
- Pagination: 15 per halaman.

**Fitur Cetak PDF Pelanggan (DomPDF):**
```php
// Cetak data satu pelanggan
public function cetak(Pelanggan $pelanggan)
{
    $pdf = \PDF::loadView('pdf.pelanggan', compact('pelanggan'))
               ->setPaper('a4', 'portrait');
    return $pdf->stream("pelanggan-{$pelanggan->kode_pelanggan}.pdf");
}

// Cetak semua pelanggan (dengan filter opsional dari request)
public function cetakSemua(Request $request)
{
    $pelanggan = Pelanggan::filter($request->all())->get();
    $pdf       = \PDF::loadView('pdf.pelanggan_semua', compact('pelanggan'))
                     ->setPaper('a4', 'portrait');
    return $pdf->stream('data-pelanggan.pdf');
}
```

**Tabel Index — Kolom:**
No | Kode | Nama | Jenis Kelamin | No. Telepon | Tgl Daftar | Total Transaksi | Status | Aksi

---

### MODUL 7 — MANAJEMEN TRANSAKSI

**Lokasi:** `app/Http/Controllers/Admin/TransaksiController.php`

**Alur Status Transaksi:**

```
[DITERIMA] → [DICUCI] → [DIJEMUR] → [DISETRIKA] → [SIAP] → [DIAMBIL]

[BATAL] ← dapat dari status manapun sebelum DIAMBIL
```

**Operasi:**
| Aksi | Method | Route |
|---|---|---|
| Index | GET | `/admin/transaksi` |
| Create | GET | `/admin/transaksi/create` |
| Store | POST | `/admin/transaksi` |
| Show | GET | `/admin/transaksi/{id}` |
| Update Status | PATCH | `/admin/transaksi/{id}/status` |
| Bayar | PATCH | `/admin/transaksi/{id}/bayar` |
| Batal | PATCH | `/admin/transaksi/{id}/batal` |
| Nota PDF | GET | `/admin/transaksi/{id}/nota` |

**Validasi Tambah Transaksi (`TransaksiRequest`):**
```php
'pelanggan_id'       => ['required','exists:pelanggan,id'],
'pegawai_id'         => ['nullable','exists:pegawai,id'],
'tanggal_masuk'      => ['required','date'],
'catatan'            => ['nullable','string','max:1000'],
'items'              => ['required','array','min:1'],
'items.*.layanan_id' => ['required','exists:layanan,id'],
'items.*.qty'        => ['required','numeric','min:0.1'],
'metode_bayar'       => ['required','in:tunai,transfer,qris,dompet_digital'],
```

**Aturan Bisnis:**
- `no_order` digenerate otomatis: `ORD-{YYYY}-{5 digit sequence}`, contoh: `ORD-2025-00001`.
- `tanggal_estimasi` dihitung otomatis: `tanggal_masuk + max(estimasi_hari semua item yang dipilih)`.
- `subtotal` = SUM(`qty × harga_satuan`) dari semua detail_transaksi.
- `total` = `subtotal` (tidak ada diskon karena promo dihapus).
- Setiap perubahan status → log masuk ke tabel `status_transaksi` dengan `diubah_oleh = auth()->id()`.
- Transaksi yang sudah berstatus `diambil` tidak bisa diubah atau dibatalkan.
- Saat status berubah menjadi `diambil` → update `pelanggan.total_transaksi += 1` dan `pelanggan.poin += floor(total / 10000)`.
- Transaksi berstatus `batal` → tidak dihitung dalam laporan pendapatan.

**Tabel Index — Kolom:**
No Order | Pelanggan | Tgl Masuk | Tgl Estimasi | Total | Metode Bayar | Status | Aksi

---

### MODUL 8 — MANAJEMEN PEGAWAI

**Lokasi:** `app/Http/Controllers/Admin/PegawaiController.php`

**Operasi CRUD:**
| Aksi | Method | Route |
|---|---|---|
| Index | GET | `/admin/pegawai` |
| Create | GET | `/admin/pegawai/create` |
| Store | POST | `/admin/pegawai` |
| Edit | GET | `/admin/pegawai/{id}/edit` |
| Update | PATCH | `/admin/pegawai/{id}` |
| Destroy | DELETE | `/admin/pegawai/{id}` |

**Validasi (`PegawaiRequest`):**
```php
'nama_pegawai'  => ['required','string','max:150'],
'jabatan'       => ['required','string','max:100'],
'no_telepon'    => ['nullable','string','max:20'],
'alamat'        => ['nullable','string','max:500'],
'tanggal_masuk' => ['required','date','before_or_equal:today'],
'is_active'     => ['required','boolean'],
```

**Aturan Bisnis:**
- `kode_pegawai` digenerate otomatis: `PGW-{3 digit sequence}`.
- Pegawai tidak bisa dihapus jika pernah tercatat di `transaksi.pegawai_id`. Soft-disable saja.

**Tabel Index — Kolom:**
Kode | Nama Pegawai | Jabatan | No. Telepon | Tgl Masuk | Status | Aksi

---

### MODUL 9 — LAPORAN & EKSPOR PDF

**Lokasi:** `app/Http/Controllers/Admin/LaporanController.php`

**Fitur Laporan:**
| Laporan | Filter | Ekspor |
|---|---|---|
| Laporan Transaksi | Periode (dari–sampai), status, metode bayar | PDF, Cetak browser |
| Laporan Pendapatan | Periode (dari–sampai) | PDF |
| Laporan Pelanggan | Tanggal daftar, jenis kelamin | PDF |
| Laporan Layanan Terpopuler | Periode | PDF |

**Alur Ekspor PDF:**
```php
public function exportPdf(Request $request)
{
    $data = $this->getFilteredData($request);
    $pdf  = \PDF::loadView('pdf.laporan', compact('data', 'request'))
                ->setPaper('a4', 'landscape');
    return $pdf->stream('laporan-' . now()->format('Ymd') . '.pdf');
}
```

---

### MODUL 10 — HALAMAN PUBLIK (UMUM)

**Lokasi:** `app/Http/Controllers/Public/`

Halaman ini dapat diakses **tanpa login** oleh siapapun.

#### 10.1 Beranda (`/`)
- Hero section: nama toko, tagline, tombol "Lihat Layanan" → `/layanan`.
- Section informasi singkat tentang layanan laundry.
- Section daftar paket harga (card grid dari tabel `paket`).
- Section daftar layanan unggulan (3–6 item aktif, cards Bootstrap).

#### 10.2 Halaman Layanan (`/layanan`)
- Tampilkan semua layanan aktif dalam bentuk **card grid**.
- Filter by kategori (tombol pill / badge, tanpa reload halaman dengan JavaScript).
- Setiap card menampilkan: nama layanan, kategori, harga/satuan, estimasi hari.
- **Tidak ada form tambah/ubah/hapus** di halaman ini.

#### 10.3 Halaman Pelanggan (`/pelanggan`)
- Tampilkan daftar pelanggan aktif dalam tabel Bootstrap.
- Kolom: Kode Pelanggan | Nama | Jenis Kelamin | No. Telepon | Tgl Daftar.
- Search by nama atau kode pelanggan (GET parameter `?cari=...`).
- Pagination 10 per halaman.
- **Tidak ada aksi edit/hapus** di halaman ini.

---

### MODUL 11 — NOTIFIKASI FLASH & SWEETALERT2

Semua respons aksi user menggunakan SweetAlert2. Tidak boleh menggunakan alert bawaan browser.

#### 11.1 Flash Message via Session

Controller selalu menyimpan pesan ke session:
```php
// Berhasil
return redirect()->route('admin.layanan.index')
    ->with('success', 'Data layanan berhasil disimpan.');

// Gagal / Error
return redirect()->back()
    ->with('error', 'Data tidak dapat dihapus karena masih digunakan.')
    ->withInput();

// Peringatan
return redirect()->back()
    ->with('warning', 'Status tidak dapat diubah pada transaksi yang sudah selesai.');
```

#### 11.2 Tampilkan di Layout Blade

Di `app.blade.php`, sebelum `</body>`, tambahkan script berikut:

```html
@if(session('success'))
<script>
Swal.fire({ icon:'success', title:'Berhasil!', text:'{{ session('success') }}',
    timer:2500, showConfirmButton:false, timerProgressBar:true });
</script>
@endif

@if(session('error'))
<script>
Swal.fire({ icon:'error', title:'Gagal!', text:'{{ session('error') }}',
    confirmButtonColor:'#d33' });
</script>
@endif

@if(session('warning'))
<script>
Swal.fire({ icon:'warning', title:'Perhatian!', text:'{{ session('warning') }}',
    confirmButtonColor:'#f0ad4e' });
</script>
@endif
```

#### 11.3 Fungsi Global SweetAlert2

Letakkan di `app.blade.php` sebelum `</body>`:

```javascript
// Konfirmasi Hapus Data
function confirmDelete(formId, nama = 'data ini') {
    Swal.fire({
        title: 'Hapus Data?',
        html: `Anda akan menghapus <strong>${nama}</strong>. Tindakan ini tidak dapat dibatalkan.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash-alt me-1"></i>Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then(r => { if(r.isConfirmed) document.getElementById(formId).submit(); });
}

// Konfirmasi Aksi Khusus (batal transaksi, ubah status, dll)
function confirmAction(formId, title, text, confirmText = 'Ya, Lanjutkan', icon = 'question') {
    Swal.fire({
        title, text, icon,
        showCancelButton: true,
        confirmButtonColor: '#0d6efd',
        cancelButtonColor: '#6c757d',
        confirmButtonText: confirmText,
        cancelButtonText: 'Batal'
    }).then(r => { if(r.isConfirmed) document.getElementById(formId).submit(); });
}

// Toast ringan (non-blocking)
function showToast(icon, title) {
    Swal.mixin({ toast:true, position:'top-end', showConfirmButton:false,
        timer:3000, timerProgressBar:true }).fire({ icon, title });
}
```

**Penggunaan di blade:**
```html
<!-- Tombol Hapus -->
<form id="form-delete-{{ $item->id }}" action="{{ route('admin.layanan.destroy', $item) }}"
      method="POST" class="d-inline">
    @csrf @method('DELETE')
</form>
<button type="button" class="btn btn-danger btn-sm"
        onclick="confirmDelete('form-delete-{{ $item->id }}', '{{ $item->nama_layanan }}')">
    <i class="fas fa-trash-alt"></i>
</button>

<!-- Tombol Batal Transaksi -->
<form id="form-batal-{{ $transaksi->id }}" action="{{ route('admin.transaksi.batal', $transaksi) }}"
      method="POST" class="d-inline">
    @csrf @method('PATCH')
</form>
<button type="button" class="btn btn-warning btn-sm"
        onclick="confirmAction('form-batal-{{ $transaksi->id }}',
            'Batalkan Transaksi?',
            'Transaksi {{ $transaksi->no_order }} akan dibatalkan.',
            '<i class=\'fas fa-times me-1\'></i>Ya, Batalkan',
            'warning')">
    <i class="fas fa-ban"></i> Batal
</button>
```

---

## 7. LAYOUT BLADE UTAMA

### 7.1 `layouts/app.blade.php` (Panel Admin)

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Cuciin Admin</title>

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --sidebar-bg:     #1a2332;
            --sidebar-width:  260px;
            --accent-primary: #0d6efd;
            --topbar-height:  60px;
            --text-sidebar:   #adb5bd;
            --text-sidebar-active: #ffffff;
        }

        body { background:#f4f6f9; font-family:'Segoe UI',sans-serif; }

        /* Sidebar */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar-bg);
            position: fixed; top:0; left:0;
            z-index: 1000;
            transition: width .3s;
            overflow-y: auto;
        }
        #sidebar .brand {
            height: var(--topbar-height);
            display:flex; align-items:center;
            padding:0 1.2rem;
            background: rgba(255,255,255,.05);
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        #sidebar .brand span { color:#fff; font-weight:700; font-size:1.1rem; letter-spacing:.5px; }
        #sidebar .nav-link {
            color: var(--text-sidebar);
            padding:.55rem 1.2rem;
            border-radius:6px;
            margin:2px .6rem;
            transition:all .2s;
            font-size:.875rem;
        }
        #sidebar .nav-link:hover,
        #sidebar .nav-link.active {
            background: var(--accent-primary);
            color: var(--text-sidebar-active);
        }
        #sidebar .nav-link i { width:20px; text-align:center; margin-right:.5rem; }
        #sidebar .nav-section {
            font-size:.7rem; font-weight:700; text-transform:uppercase;
            letter-spacing:1px; color:#6c757d; padding:1rem 1.8rem .3rem;
        }

        /* Topbar */
        #topbar {
            height: var(--topbar-height);
            background:#fff;
            border-bottom:1px solid #dee2e6;
            position:fixed; top:0;
            left: var(--sidebar-width); right:0;
            z-index:999;
            display:flex; align-items:center; padding:0 1.5rem;
            justify-content:space-between;
            box-shadow:0 1px 3px rgba(0,0,0,.06);
        }

        /* Main Content */
        #main-content {
            margin-left: var(--sidebar-width);
            padding-top: calc(var(--topbar-height) + 1.5rem);
            padding-left:1.5rem; padding-right:1.5rem; padding-bottom:2rem;
            min-height:100vh;
        }

        /* Cards */
        .card { border:none; border-radius:10px; box-shadow:0 1px 6px rgba(0,0,0,.07); }
        .card-header { background:#fff; border-bottom:1px solid #f0f0f0; font-weight:600; }

        /* KPI Card */
        .kpi-card { border-radius:12px; border:none; }
        .kpi-card .kpi-icon {
            width:52px; height:52px; border-radius:10px;
            display:flex; align-items:center; justify-content:center; font-size:1.4rem;
        }

        /* Status Badges */
        .badge-diterima  { background:#6c757d; }
        .badge-dicuci    { background:#0dcaf0; color:#000; }
        .badge-dijemur   { background:#ffc107; color:#000; }
        .badge-disetrika { background:#fd7e14; }
        .badge-siap      { background:#198754; }
        .badge-diambil   { background:#0d6efd; }
        .badge-batal     { background:#dc3545; }

        /* Table */
        .table th { font-weight:600; font-size:.82rem; text-transform:uppercase;
                    letter-spacing:.5px; color:#6c757d; white-space:nowrap; }
        .table td { vertical-align:middle; font-size:.88rem; }

        /* Responsive */
        @media (max-width:768px) {
            #sidebar { width:0; overflow:hidden; }
            #sidebar.show { width:var(--sidebar-width); }
            #topbar { left:0; }
            #main-content { margin-left:0; }
        }
    </style>

    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<nav id="sidebar">
    <div class="brand">
        <i class="fas fa-soap text-primary me-2 fs-5"></i>
        <span>Cuciin</span>
    </div>
    <div class="pt-2 pb-3">
        <p class="nav-section">Utama</p>
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        <p class="nav-section">Master Data</p>
        <a href="{{ route('admin.kategori.index') }}"
           class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
            <i class="fas fa-tags"></i> Kategori Layanan
        </a>
        <a href="{{ route('admin.layanan.index') }}"
           class="nav-link {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
            <i class="fas fa-tshirt"></i> Layanan
        </a>
        <a href="{{ route('admin.paket.index') }}"
           class="nav-link {{ request()->routeIs('admin.paket.*') ? 'active' : '' }}">
            <i class="fas fa-box-open"></i> Paket
        </a>
        <a href="{{ route('admin.pelanggan.index') }}"
           class="nav-link {{ request()->routeIs('admin.pelanggan.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Pelanggan
        </a>

        <p class="nav-section">Operasional</p>
        <a href="{{ route('admin.transaksi.index') }}"
           class="nav-link {{ request()->routeIs('admin.transaksi.*') ? 'active' : '' }}">
            <i class="fas fa-receipt"></i> Transaksi
        </a>
        <a href="{{ route('admin.pegawai.index') }}"
           class="nav-link {{ request()->routeIs('admin.pegawai.*') ? 'active' : '' }}">
            <i class="fas fa-user-tie"></i> Pegawai
        </a>

        <p class="nav-section">Sistem</p>
        <a href="{{ route('admin.laporan.index') }}"
           class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
            <i class="fas fa-chart-bar"></i> Laporan
        </a>
    </div>
</nav>

<!-- Topbar -->
<header id="topbar">
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-sm btn-light d-md-none" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <nav aria-label="breadcrumb" class="d-none d-md-block">
            <ol class="breadcrumb mb-0 small">
                @yield('breadcrumb')
            </ol>
        </nav>
    </div>
    <div class="d-flex align-items-center gap-2">
        <div class="dropdown">
            <button class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle me-1"></i>
                {{ auth()->user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><span class="dropdown-item-text small text-muted">{{ auth()->user()->email }}</span></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

<!-- Main Content -->
<main id="main-content">
    @yield('content')
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Sidebar toggle (mobile)
    document.getElementById('sidebarToggle')?.addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('show');
    });

    // SweetAlert Flash Messages
    @if(session('success'))
    Swal.fire({ icon:'success', title:'Berhasil!', text:'{{ session('success') }}',
        timer:2500, showConfirmButton:false, timerProgressBar:true });
    @endif
    @if(session('error'))
    Swal.fire({ icon:'error', title:'Gagal!', text:'{{ session('error') }}',
        confirmButtonColor:'#d33' });
    @endif
    @if(session('warning'))
    Swal.fire({ icon:'warning', title:'Perhatian!', text:'{{ session('warning') }}' });
    @endif

    // Global Helper Functions
    function confirmDelete(formId, nama = 'data ini') {
        Swal.fire({
            title: 'Hapus Data?',
            html: `Anda akan menghapus <strong>${nama}</strong>. Tindakan ini tidak dapat dibatalkan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash-alt me-1"></i>Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then(r => { if(r.isConfirmed) document.getElementById(formId).submit(); });
    }

    function confirmAction(formId, title, text, confirmText = 'Ya, Lanjutkan', icon = 'question') {
        Swal.fire({
            title, text, icon,
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#6c757d',
            confirmButtonText: confirmText,
            cancelButtonText: 'Batal'
        }).then(r => { if(r.isConfirmed) document.getElementById(formId).submit(); });
    }

    function showToast(icon, title) {
        Swal.mixin({ toast:true, position:'top-end', showConfirmButton:false,
            timer:3000, timerProgressBar:true }).fire({ icon, title });
    }
</script>

@stack('scripts')
</body>
</html>
```

### 7.2 `layouts/public.blade.php`

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda') — Cuciin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root { --accent: #0d6efd; }
        .navbar-brand { font-weight:800; color:var(--accent) !important; }
        .hero { background:linear-gradient(135deg,#0d6efd 0%,#0a58ca 100%); padding:5rem 0; color:#fff; }
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-soap me-2"></i>Cuciin
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navPublic">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navPublic">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}"
                       href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.layanan') ? 'active fw-semibold' : '' }}"
                       href="{{ route('public.layanan') }}">Layanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.pelanggan') ? 'active fw-semibold' : '' }}"
                       href="{{ route('public.pelanggan') }}">Pelanggan</a>
                </li>
                @guest
                <li class="nav-item ms-lg-2">
                    <a class="btn btn-primary btn-sm" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt me-1"></i>Login Admin
                    </a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<main>@yield('content')</main>

<footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <p class="mb-1 fw-semibold"><i class="fas fa-soap me-2"></i>Cuciin</p>
        <p class="small text-secondary mb-0">Layanan laundry terpercaya</p>
        <p class="small text-secondary mt-1">&copy; {{ date('Y') }} Cuciin. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')
</body>
</html>
```

### 7.3 `layouts/pdf.blade.php`

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $judul ?? 'Laporan' }}</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'DejaVu Sans',sans-serif; font-size:11px; color:#222; }

        .pdf-header { border-bottom:2px solid #0d6efd; padding-bottom:10px; margin-bottom:16px; }
        .pdf-header .toko-nama { font-size:16px; font-weight:bold; color:#0d6efd; }
        .pdf-header .toko-info { font-size:9px; color:#666; }
        .pdf-title { font-size:13px; font-weight:bold; text-align:center;
                     background:#0d6efd; color:#fff; padding:6px; margin-bottom:12px; }

        table { width:100%; border-collapse:collapse; margin-bottom:12px; }
        thead th { background:#0d6efd; color:#fff; padding:6px 8px; font-size:10px; text-align:left; }
        tbody td { padding:5px 8px; border-bottom:1px solid #e9ecef; }
        tbody tr:nth-child(even) { background:#f8f9fa; }

        .pdf-footer { margin-top:20px; font-size:9px; color:#888;
                      border-top:1px solid #dee2e6; padding-top:8px;
                      display:flex; justify-content:space-between; }
    </style>
</head>
<body>
    <div class="pdf-header">
        <div class="toko-nama">Cuciin</div>
        <div class="toko-info">Dicetak: {{ now()->format('d/m/Y H:i') }}
            &nbsp;|&nbsp; Oleh: {{ auth()->user()->name ?? '-' }}</div>
    </div>

    @yield('pdf-content')

    <div class="pdf-footer">
        <span>Terima kasih telah mempercayai layanan kami.</span>
        <span>Hal. <span class="pagenum"></span></span>
    </div>
</body>
</html>
```

---

## 8. PENOMORAN OTOMATIS (NomorOrderService)

```php
// app/Services/NomorOrderService.php
<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class NomorOrderService
{
    /**
     * Generate kode: PREFIX-YYYY-NNNNN
     * Contoh: ORD-2025-00001
     */
    public static function generate(string $prefix, string $table, string $column, int $pad = 5): string
    {
        $tahun = now()->year;
        $like  = "{$prefix}-{$tahun}-%";
        $last  = DB::table($table)
                   ->where($column, 'like', $like)
                   ->orderByDesc($column)
                   ->value($column);

        $seq = $last
            ? ((int) substr($last, strrpos($last, '-') + 1)) + 1
            : 1;

        return "{$prefix}-{$tahun}-" . str_pad($seq, $pad, '0', STR_PAD_LEFT);
    }
}
```

**Penggunaan di Controller:**
```php
use App\Services\NomorOrderService;

// Transaksi → ORD-2025-00001
$noOrder = NomorOrderService::generate('ORD', 'transaksi', 'no_order', 5);

// Pelanggan → PLG-2025-0001
$kodePelanggan = NomorOrderService::generate('PLG', 'pelanggan', 'kode_pelanggan', 4);

// Layanan → LYN-001
$kodeLayanan = NomorOrderService::generate('LYN', 'layanan', 'kode_layanan', 3);

// Pegawai → PGW-001
$kodePegawai = NomorOrderService::generate('PGW', 'pegawai', 'kode_pegawai', 3);

// Paket → PKT-001
$kodePaket = NomorOrderService::generate('PKT', 'paket', 'kode_paket', 3);
```

---

## 9. TEMPLATE PDF PELANGGAN

### `pdf/pelanggan_semua.blade.php`

```html
@extends('layouts.pdf')
@section('pdf-content')
<div class="pdf-title">DATA PELANGGAN LAUNDRY</div>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Pelanggan</th>
            <th>Jenis Kelamin</th>
            <th>No. Telepon</th>
            <th>Alamat</th>
            <th>Tgl. Daftar</th>
            <th>Total Transaksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pelanggan as $i => $p)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $p->kode_pelanggan }}</td>
            <td>{{ $p->nama_pelanggan }}</td>
            <td>{{ $p->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            <td>{{ $p->no_telepon }}</td>
            <td>{{ Str::limit($p->alamat, 40) }}</td>
            <td>{{ \Carbon\Carbon::parse($p->tanggal_daftar)->format('d/m/Y') }}</td>
            <td style="text-align:center">{{ $p->total_transaksi }}</td>
        </tr>
        @empty
        <tr><td colspan="8" style="text-align:center;color:#888;">Tidak ada data</td></tr>
        @endforelse
    </tbody>
</table>
<p style="font-size:10px;color:#888;text-align:right;">
    Total: {{ $pelanggan->count() }} pelanggan
</p>
@endsection
```

---

## 10. FORM REQUEST VALIDATION (Pesan Bahasa Indonesia)

Semua `FormRequest` wajib override `messages()`:

```php
// Contoh: app/Http/Requests/LayananRequest.php
public function messages(): array
{
    return [
        'nama_layanan.required'        => 'Nama layanan wajib diisi.',
        'nama_layanan.max'             => 'Nama layanan maksimal 150 karakter.',
        'kategori_layanan_id.required' => 'Kategori layanan wajib dipilih.',
        'kategori_layanan_id.exists'   => 'Kategori layanan tidak ditemukan.',
        'satuan.required'              => 'Satuan wajib dipilih.',
        'satuan.in'                    => 'Satuan tidak valid.',
        'harga.required'               => 'Harga wajib diisi.',
        'harga.numeric'                => 'Harga harus berupa angka.',
        'harga.min'                    => 'Harga tidak boleh negatif.',
        'estimasi_hari.required'       => 'Estimasi hari wajib diisi.',
        'estimasi_hari.min'            => 'Estimasi minimal 1 hari.',
        'estimasi_hari.max'            => 'Estimasi maksimal 30 hari.',
    ];
}
```

Tampilkan di blade:
```html
@error('nama_layanan')
    <div class="invalid-feedback d-block">{{ $message }}</div>
@enderror
```

Tambahkan class `is-invalid` ke input jika ada error:
```html
<input type="text" name="nama_layanan"
       class="form-control @error('nama_layanan') is-invalid @enderror"
       value="{{ old('nama_layanan', $layanan->nama_layanan ?? '') }}">
```

---

## 11. MODEL ELOQUENT — RELASI & SCOPE

### `Pelanggan.php`
```php
class Pelanggan extends Model
{
    protected $fillable = [
        'kode_pelanggan','nama_pelanggan','jenis_kelamin','no_telepon',
        'email','alamat','tanggal_daftar','poin','total_transaksi','catatan','is_active'
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function scopeAktif($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['cari'])) {
            $query->where(function($q) use ($filters) {
                $q->where('nama_pelanggan', 'like', "%{$filters['cari']}%")
                  ->orWhere('kode_pelanggan', 'like', "%{$filters['cari']}%")
                  ->orWhere('no_telepon',     'like', "%{$filters['cari']}%");
            });
        }
        if (!empty($filters['jenis_kelamin'])) {
            $query->where('jenis_kelamin', $filters['jenis_kelamin']);
        }
        if (isset($filters['is_active']) && $filters['is_active'] !== '') {
            $query->where('is_active', $filters['is_active']);
        }
        return $query;
    }
}
```

### `Layanan.php`
```php
class Layanan extends Model
{
    protected $fillable = [
        'kategori_layanan_id','kode_layanan','nama_layanan',
        'satuan','harga','estimasi_hari','deskripsi','is_active'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriLayanan::class, 'kategori_layanan_id');
    }

    public function scopeAktif($query)
    {
        return $query->where('is_active', 1);
    }
}
```

### `Transaksi.php`
```php
class Transaksi extends Model
{
    public function pelanggan()     { return $this->belongsTo(Pelanggan::class); }
    public function pegawai()       { return $this->belongsTo(Pegawai::class); }
    public function detail()        { return $this->hasMany(DetailTransaksi::class); }
    public function riwayatStatus() { return $this->hasMany(StatusTransaksi::class); }

    public function getWarnaBadgeAttribute(): string
    {
        return match($this->status) {
            'diterima'  => 'secondary',
            'dicuci'    => 'info',
            'dijemur'   => 'warning',
            'disetrika' => 'warning',
            'siap'      => 'success',
            'diambil'   => 'primary',
            'batal'     => 'danger',
            default     => 'secondary',
        };
    }
}
```

---

## 12. SEEDER

### `DatabaseSeeder.php`
```php
public function run(): void
{
    $this->call([
        UserSeeder::class,
        KategoriLayananSeeder::class,
        LayananSeeder::class,
    ]);
}
```

### `UserSeeder.php`
```php
User::create([
    'name'     => 'Administrator',
    'email'    => 'admin@cuciin.com',
    'password' => Hash::make('password'),
    'role'     => 'admin',
]);
User::create([
    'name'     => 'Pengunjung',
    'email'    => 'umum@cuciin.com',
    'password' => Hash::make('password'),
    'role'     => 'umum',
]);
```

### `KategoriLayananSeeder.php`
```php
$kategori = ['Reguler', 'Express', 'Premium', 'Dry Clean', 'Setrika Saja'];
foreach ($kategori as $nama) {
    KategoriLayanan::create(['nama_kategori' => $nama, 'is_active' => 1]);
}
```

---

## 13. ATURAN KONVENSI KODE

| Aspek | Aturan |
|---|---|
| **Nama Controller** | PascalCase + suffix `Controller` |
| **Nama Model** | PascalCase, singular (`Pelanggan`) |
| **Nama Tabel** | snake_case, plural (`kategori_layanan`) |
| **Nama Route** | `admin.modul.aksi` (dot notation) |
| **Nama View** | snake_case, dalam subfolder modul |
| **Nama FormRequest** | `NamaModelRequest.php` |
| **Bahasa Pesan** | Bahasa Indonesia untuk semua pesan user-facing |
| **Format Tanggal** | `d/m/Y` di tampilan, `Y-m-d` di database |
| **Format Mata Uang** | `Rp {{ number_format($nilai, 0, ',', '.') }}` |
| **Soft Delete** | Gunakan kolom `is_active` (bukan `deleted_at`) |
| **Pagination** | 15 per halaman default, gunakan `->links()` Bootstrap |
| **CSRF** | Semua form POST/PUT/PATCH/DELETE wajib `@csrf` |
| **Method Spoofing** | Gunakan `@method('DELETE')` atau `@method('PATCH')` |
| **Alert** | 100% SweetAlert2, zero native `alert()` |

---

## 14. KEAMANAN

1. **CSRF Protection** — aktif secara default di Laravel 12. Semua form wajib `@csrf`.
2. **Input Sanitization** — gunakan FormRequest dengan aturan `strip_tags` jika perlu.
3. **Mass Assignment** — semua model wajib mendefinisikan `$fillable`.
4. **SQL Injection** — gunakan Eloquent ORM, hindari raw query tanpa binding.
5. **Password Hashing** — selalu `Hash::make()`, tidak pernah plain text.
6. **Rate Limiting Login** — aktifkan `ThrottleRequests` di route login.
7. **Authorization** — proteksi semua route admin dengan middleware `auth` + `isAdmin`.

---

## 15. INSTALASI & SETUP AWAL

```bash
# 1. Buat project Laravel 12
composer create-project laravel/laravel cuciin

# 2. Install DomPDF
composer require barryvdh/laravel-dompdf

# 3. Publish config DomPDF
php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"

# 4. Konfigurasi .env
DB_DATABASE=cuciin
DB_USERNAME=root
DB_PASSWORD=

# 5. Jalankan migrasi & seeder
php artisan migrate --seed

# 6. Buat symlink storage
php artisan storage:link

# 7. Jalankan server
php artisan serve
```

**Akun default setelah seeder:**
| Email | Password | Role |
|---|---|---|
| `admin@cuciin.com` | `password` | Admin |
| `umum@cuciin.com` | `password` | Umum |

---

## 16. RINGKASAN FITUR

| # | Fitur | Role | Keterangan |
|---|---|---|---|
| 1 | Login / Logout | Admin, Umum | SweetAlert2 untuk pesan |
| 2 | Dashboard KPI | Admin | Statistik real-time |
| 3 | CRUD Kategori Layanan | Admin | Validasi relasi sebelum hapus |
| 4 | CRUD Layanan | Admin | Filter, kode otomatis |
| 5 | CRUD Paket | Admin | Harga bundel, kode otomatis |
| 6 | CRUD Pelanggan | Admin | Poin loyalitas, kode otomatis |
| 7 | CRUD Transaksi | Admin | Multi-item, alur status 7 tahap |
| 8 | CRUD Pegawai | Admin | Data SDM, kode otomatis |
| 9 | Laporan | Admin | Filter periode, ekspor PDF |
| 10 | Cetak PDF Pelanggan | Admin | Per-pelanggan & semua pelanggan |
| 11 | Cetak Nota Transaksi | Admin | DomPDF A4 |
| 12 | Lihat Layanan | Umum | Grid card, filter kategori |
| 13 | Lihat Pelanggan | Umum | Tabel, search, pagination |
| 14 | Beranda Publik | Umum | Hero + paket harga + layanan unggulan |

---

*Dokumen ini adalah panduan teknis lengkap untuk membangun Cuciin dengan Laravel 12. Setiap modul, tabel, validasi, dan konvensi telah didefinisikan agar pengembangan dapat dilakukan secara konsisten dan terstruktur.*