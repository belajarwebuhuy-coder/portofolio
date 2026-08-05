# DOCS 08 - CODING_STANDARDS.md

Version : 1.0
Status  : Approved
Project : Personal Portfolio CMS

---

# 1. Tujuan

Dokumen ini menjadi standar penulisan kode pada seluruh project.

Seluruh kode yang dibuat harus:

- Mudah dibaca
- Konsisten
- Mudah dipelihara
- Aman
- Tidak berlebihan

Semua implementasi wajib mengikuti dokumen ini.

---

# 2. General Principles

Prinsip utama.

- Readability lebih penting daripada kode yang terlalu pintar.
- Jangan membuat fungsi yang tidak digunakan.
- Hindari duplikasi kode (DRY).
- Gunakan KISS (Keep It Simple, Stupid).
- Hindari over engineering.
- Setiap file memiliki satu tanggung jawab utama.

---

# 3. Project Structure

Semua file harus mengikuti struktur folder yang telah disetujui pada DOCS 03.

Tidak diperbolehkan membuat folder baru tanpa alasan yang jelas.

---

# 4. PHP Standards

Versi PHP

8.2+

Aturan:

- Gunakan `declare(strict_types=1);` pada file PHP baru (kecuali jika ada kebutuhan kompatibilitas tertentu).
- Gunakan `password_hash()` dan `password_verify()`.
- Gunakan `PDO` dengan prepared statement.
- Hindari penggunaan `mysqli`.
- Hindari penggunaan `extract()`.
- Hindari penggunaan variabel global.
- Gunakan early return jika membuat alur lebih jelas.

Contoh:

```php
if (!$user) {
    return;
}
```

---

# 5. HTML Standards

Gunakan HTML5.

Aturan:

- Gunakan tag yang semantik.
- Selalu isi atribut `alt` pada gambar.
- Gunakan heading secara berurutan (`h1`, `h2`, `h3`).
- Hindari inline style.
- Hindari inline JavaScript.

---

# 6. CSS Standards

Framework utama:

Bootstrap 5

Aturan:

- Prioritaskan Bootstrap Utility Classes.
- CSS custom hanya jika Bootstrap tidak mencukupi.
- Pisahkan CSS berdasarkan kebutuhan.
- Hindari `!important` kecuali benar-benar diperlukan.
- Gunakan satuan `rem` untuk ukuran font dan spacing jika memungkinkan.

---

# 7. JavaScript Standards

Versi

ES6

Aturan:

- Gunakan `const` sebagai default.
- Gunakan `let` jika nilainya berubah.
- Hindari `var`.
- Pisahkan fungsi berdasarkan modul.
- Gunakan `addEventListener()`.
- Hindari event inline seperti `onclick`.

---

# 8. Database Standards

- Semua query menggunakan Prepared Statement.
- Jangan gunakan `SELECT *`.
- Ambil hanya kolom yang diperlukan.
- Selalu gunakan `LIMIT` jika memang hanya membutuhkan satu data atau data terbatas.
- Gunakan transaksi (`transaction`) jika satu proses mengubah beberapa tabel sekaligus.

---

# 9. Naming Convention

## Folder

lowercase

Contoh:

admin

assets

uploads

includes

---

## File

Gunakan lowercase dan dash.

Contoh:

project-detail.php

blog-detail.php

---

## Class (Jika Digunakan)

PascalCase

Contoh:

Database

Auth

Upload

---

## Function

camelCase

Contoh:

getProject()

saveBlog()

deleteCertificate()

---

## Variable

camelCase

Contoh:

$projectData

$userName

$blogList

---

## Constant

UPPER_CASE

Contoh:

BASE_URL

UPLOAD_PATH

APP_NAME

---

## Database

Table

Plural

projects

blogs

messages

Column

snake_case

created_at

updated_at

credential_url

---

# 10. File Upload Standards

Upload hanya menerima:

- JPG
- PNG
- WEBP

Aturan:

- Validasi ukuran file.
- Validasi tipe MIME.
- Ganti nama file menjadi unik.
- Simpan file di folder sesuai modul.
- Database hanya menyimpan nama file atau path relatif.

---

# 11. Validation Standards

Seluruh input harus divalidasi.

Validasi meliputi:

- Required
- Maximum Length
- Email Format
- URL Format
- File Type
- File Size

Validasi dilakukan:

- Client Side
- Server Side

---

# 12. Security Standards

Wajib menggunakan:

- Password Hash
- Prepared Statement
- CSRF Protection
- XSS Protection
- Session Authentication

Jangan pernah:

- Menyimpan password plaintext.
- Menampilkan pesan error database ke pengguna.
- Menaruh credential database di file publik.

---

# 13. Error Handling

- Gunakan pesan yang mudah dipahami pengguna.
- Simpan detail error untuk debugging (jangan tampilkan ke user).
- Jangan menggunakan `die()` untuk menangani error aplikasi.

---

# 14. Comment Standards

Komentar hanya digunakan jika benar-benar membantu memahami logika yang tidak langsung terlihat.

Jangan menulis komentar yang hanya mengulang isi kode.

Contoh yang tidak perlu:

```php
// Mengambil data user
$user = getUser();
```

Lebih baik gunakan nama fungsi dan variabel yang jelas.

---

# 15. Code Formatting

- Indentasi 4 spasi.
- Gunakan UTF-8.
- Akhiri file dengan newline.
- Maksimal satu statement per baris.
- Gunakan kurung kurawal (`{}`) meskipun blok hanya satu baris.

---

# 16. Git Standards

Branch utama:

main

Commit message menggunakan format:

- feat: tambah fitur baru
- fix: perbaikan bug
- refactor: perbaikan struktur kode
- docs: perubahan dokumentasi
- style: perubahan format kode
- chore: pekerjaan pendukung

Contoh:

feat: add project management module

---

# 17. Testing Standards

Setiap modul harus diuji:

- Create
- Read
- Update
- Delete
- Upload
- Validation
- Responsive
- Security dasar

Tidak boleh lanjut ke modul berikutnya sebelum modul saat ini berfungsi dengan baik.

---

# 18. Performance Standards

- Hindari query berulang (N+1).
- Optimalkan ukuran gambar.
- Muat aset yang benar-benar digunakan.
- Gunakan lazy loading untuk gambar jika diperlukan.

---

# 19. Documentation Standards

Jika ada perubahan:

- Feature
- Database
- Struktur Folder

Dokumentasi harus diperbarui.

Tidak diperbolehkan mengubah implementasi tanpa memperbarui dokumentasi terkait.

---

# 20. Final Rules

Seluruh kode yang dibuat harus memenuhi kriteria berikut:

- Clean Code
- Mudah dipahami
- Aman
- Konsisten
- Tidak berlebihan
- Mengikuti seluruh dokumen project (DOCS 01–08)

Dokumen ini menjadi acuan utama selama proses development.

---

# 21. AI Development Rules

Project ini dikembangkan dengan bantuan AI (Claude, Lovable, ChatGPT).

Seluruh AI wajib mengikuti aturan berikut.

## General Rules

- Jangan membuat fitur di luar DOCS 04 (Feature List).
- Jangan mengubah struktur project tanpa persetujuan.
- Jangan mengubah struktur database tanpa persetujuan.
- Jangan mengubah nama tabel maupun field yang sudah disepakati.
- Jangan menghapus fitur yang telah selesai dibuat.
- Jangan membuat kode yang tidak digunakan.
- Jika requirement belum jelas, hentikan proses dan minta konfirmasi.

## Development Rules

Sebelum membuat kode:

- Analisis requirement.
- Jelaskan rencana implementasi.
- Tunggu persetujuan jika perubahan besar diperlukan.

Setelah membuat kode:

- Lakukan self-review.
- Cari bug.
- Optimalkan performa.
- Optimalkan keamanan.
- Pastikan responsive tetap berjalan.

---

# 22. Code Review Checklist

Sebelum satu modul dianggap selesai, lakukan pemeriksaan berikut.

## Functional

- CRUD berjalan.
- Validasi berjalan.
- Upload berjalan.
- Search berjalan (jika ada).
- Pagination berjalan (jika ada).

## Security

- SQL Injection aman.
- XSS aman.
- CSRF aman.
- Session aman.

## UI

- Responsive.
- Dark Mode tetap berjalan.
- Layout tidak rusak.
- Bootstrap tetap konsisten.

## Code

- Tidak ada duplicate code.
- Tidak ada unused variable.
- Tidak ada unused file.
- Tidak ada syntax error.
- Naming convention sudah sesuai.

---

# 23. File Header Standard

Seluruh file PHP utama menggunakan header berikut.

```php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module :
 * Description :
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */
```

---

# 24. TODO Rules

Jika implementasi belum selesai.

Gunakan format berikut.

```php
// TODO:
// Tambahkan validasi upload image.
```

Jangan menggunakan komentar seperti:

```php
// nanti
```

atau

```php
// belum
```

---

# 25. Folder Rules

Setiap modul memiliki struktur yang konsisten.

Contoh.

projects/

- index.php
- create.php
- edit.php
- delete.php
- process.php

blogs/

- index.php
- create.php
- edit.php
- delete.php
- process.php

Hindari penamaan file yang tidak konsisten.

Contoh yang tidak diperbolehkan.

project.php

save_project.php

hapusProject.php

editData.php

Gunakan nama file yang sederhana, konsisten, dan mudah dipahami.

---

# 26. Final Statement

Seluruh implementasi wajib mengacu pada:

- DOCS 01 - Project Overview
- DOCS 02 - Project Rules
- DOCS 03 - Project Structure
- DOCS 04 - Feature List
- DOCS 05 - Database Design
- DOCS 06 - Development Roadmap
- DOCS 07 - UI Guidelines
- DOCS 08 - Coding Standards

Jika terjadi konflik antar dokumen, urutan prioritas mengikuti daftar di atas.