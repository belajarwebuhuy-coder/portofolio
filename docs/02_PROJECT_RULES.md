# PROJECT RULES

Version : 1.0
Status  : Approved
Project : Personal Portfolio CMS

---

# 1. Tujuan Dokumen

Dokumen ini berisi seluruh aturan pengembangan project.

Semua proses analisis, desain, pembuatan kode, revisi, dan pengembangan wajib mengikuti dokumen ini.

Jika terdapat konflik antara dokumen lain dan PROJECT_RULES.md, maka PROJECT_RULES.md menjadi acuan utama.

---

# 2. Prinsip Pengembangan

Project dibuat untuk:

- Tugas pembelajaran
- Mudah dipahami
- Mudah dipelihara
- Mudah dikembangkan

Prioritas utama:

1. Sederhana
2. Konsisten
3. Rapi
4. Aman

Jangan membuat solusi yang terlalu kompleks.

---

# 3. Technology Stack

Frontend

- HTML5
- Bootstrap 5
- CSS3
- JavaScript ES6

Backend

- PHP Native 8.2+

Database

- MySQL 8.0

Framework PHP tidak digunakan.

---

# 4. Development Scope

Versi pertama hanya memiliki:

- 1 Administrator
- Website Portfolio
- CMS
- Blog
- Media Manager
- Contact Form
- SEO Dasar

AI tidak boleh menambahkan fitur baru tanpa persetujuan.

---

# 5. Simplicity Rule

Selalu gunakan solusi paling sederhana.

Hindari over-engineering.

Jangan menggunakan pola arsitektur yang tidak memberikan manfaat nyata pada project ini.

---

# 6. Folder Structure Rule

Struktur folder wajib mengikuti dokumen PROJECT_STRUCTURE.md.

Tidak boleh mengubah struktur folder tanpa persetujuan.

---

# 7. Reusable Component Rule

Komponen berikut wajib dipisahkan menjadi file terpisah:

- header.php
- footer.php
- navbar.php
- sidebar.php

Gunakan include agar mudah dipelihara.

---

# 8. Database Rule

Semua data website berasal dari database.

Jangan membuat tabel baru apabila data masih dapat ditempatkan pada tabel yang sudah ada.

Gunakan relasi yang jelas dan sederhana.

---

# 9. CRUD Rule

Seluruh modul CMS memiliki pola yang sama:

- List Data
- Tambah
- Edit
- Hapus

Gunakan tampilan dan alur yang konsisten.

---

# 10. Upload Rule

Semua file disimpan pada folder uploads.

Folder dipisahkan berdasarkan modul.

Contoh:

uploads/

- hero/
- about/
- projects/
- blog/
- certificates/
- profile/
- settings/

---

# 11. UI Rule

Frontend menggunakan desain portfolio modern.

CMS menggunakan dashboard admin.

Keduanya memiliki tampilan yang berbeda namun tetap konsisten.

---

# 12. Responsive Rule

Website wajib berjalan dengan baik pada:

- Desktop
- Tablet
- Mobile

Bootstrap menjadi framework utama.

---

# 13. Performance Rule

Gunakan:

- Optimasi gambar
- Pagination jika diperlukan
- Query seperlunya

Hindari memuat data yang tidak digunakan.

---

# 14. Security Rule

Minimal keamanan yang wajib diterapkan:

- Password Hash
- Prepared Statement
- CSRF Protection
- Escape Output
- Validasi Upload
- Validasi Input
- Session Login

---

# 15. Contact Form Rule

Pesan pengunjung disimpan ke database.

Sistem anti-spam menggunakan:

- Honeypot Field
- Validasi Server
- Rate Limiting sederhana

Tidak menggunakan CAPTCHA.

---

# 16. Coding Rule

Gunakan penamaan yang konsisten.

Contoh:

project-list.php

project-create.php

project-edit.php

project-delete.php

Hindari penamaan yang bercampur.

---

# 17. Asset Rule

CSS

JavaScript

Image

Icon

dipisahkan berdasarkan jenisnya.

---

# 18. Documentation Rule

Setiap phase harus memiliki ringkasan.

Ringkasan minimal berisi:

- Tujuan phase
- Hasil
- File baru
- File diubah
- Catatan
- Phase berikutnya

---

# 19. AI Rule

AI wajib:

- Bertanya jika requirement belum jelas.
- Menjelaskan alasan setiap keputusan penting.
- Tidak membuat kode sebelum diminta.
- Tidak menambahkan fitur di luar scope.
- Mengikuti seluruh dokumentasi project.

---

# 20. Final Rule

Tujuan utama project adalah membangun Personal Portfolio CMS yang sederhana, profesional, mudah dipahami, dan siap dipresentasikan.

Jika terdapat dua solusi yang sama baiknya, pilih solusi yang lebih sederhana dan lebih mudah dipelihara.