# DOCS 06 - DEVELOPMENT_ROADMAP.md

Version : 1.0
Status  : Approved
Project : Personal Portfolio CMS

---

# 1. Tujuan

Dokumen ini menjelaskan urutan pengembangan aplikasi agar proses development lebih terstruktur, efisien, dan meminimalkan revisi.

Pengembangan dilakukan secara bertahap berdasarkan dependency antar modul, bukan berdasarkan urutan menu pada CMS.

---

# 2. Development Principles

Selama proses development, tim wajib mengikuti prinsip berikut.

- Selesaikan satu fase sebelum masuk ke fase berikutnya.
- Setiap fase harus diuji terlebih dahulu.
- Jangan membuat fitur yang belum masuk roadmap.
- Hindari perubahan struktur project tanpa persetujuan.
- Semua fitur harus mengacu pada dokumen sebelumnya.

---

# 3. Phase 1 - Project Initialization

## Tujuan

Menyiapkan pondasi project.

## Tasks

- Membuat struktur folder project
- Konfigurasi PHP
- Konfigurasi Database
- Konfigurasi koneksi MySQL
- Membuat helper dasar
- Membuat file konfigurasi
- Konfigurasi .htaccess
- Menyiapkan folder uploads

## Deliverables

- Project dapat dijalankan.
- Database dapat terhubung.

---

# 4. Phase 2 - Authentication

## Tujuan

Membangun sistem login administrator.

## Tasks

- Login
- Logout
- Session
- Middleware Authentication
- Password Hash

## Deliverables

- Administrator dapat login.
- Halaman admin terlindungi.

---

# 5. Phase 3 - CMS Core

## Tujuan

Membangun komponen yang digunakan seluruh modul.

## Tasks

- Admin Layout
- Sidebar
- Navbar
- Breadcrumb
- Alert
- Pagination
- Upload Helper
- Validation Helper
- Utility Function

## Deliverables

- Struktur CMS siap digunakan seluruh modul.

---

# 6. Phase 4 - Website Settings

## Tujuan

Membangun konfigurasi global website.

## Module

Settings

## Tasks

- CRUD Settings
- Website Information
- Owner Information
- Social Media
- SEO
- Theme
- Maintenance Mode

## Deliverables

- Identitas website dapat diubah dari CMS.

---

# 7. Phase 5 - Homepage Content

## Modules

- Hero
- About

## Tasks

- CRUD Hero
- CRUD About
- Upload Image
- Integrasi Frontend

## Deliverables

- Hero dan About tampil dinamis.

---

# 8. Phase 6 - Resume Module

## Modules

- Education
- Experience
- Skills
- Certificates

## Tasks

- CRUD
- Sorting
- Upload Certificate
- Integrasi Frontend

## Deliverables

- Resume sepenuhnya dikelola melalui CMS.

---

# 9. Phase 7 - Projects Module

## Tasks

- CRUD Project
- Upload Thumbnail
- Upload Gallery
- Featured Project
- Status
- Portfolio Detail
- Integrasi Frontend

## Deliverables

- Portfolio berjalan sepenuhnya dari database.

---

# 10. Phase 8 - Blog Module

## Tasks

- CRUD Blog
- Draft
- Publish
- Blog List
- Blog Detail
- Homepage Latest Blog

## Deliverables

- Blog terintegrasi dengan frontend.

---

# 11. Phase 9 - Contact Module

## Tasks

- Contact Form
- Simpan ke Database
- Contact Messages CMS
- Read Message
- Delete Message

## Deliverables

- Pesan pengunjung dapat dikelola admin.

---

# 12. Phase 10 - Dashboard

## Tasks

- Statistics
- Total Projects
- Total Blog
- Total Certificates
- Total Messages
- Recent Activity

## Deliverables

- Dashboard menampilkan data real-time.

---

# 13. Phase 11 - Frontend Integration

## Tujuan

Menghubungkan seluruh template EasyFolio dengan database.

## Tasks

- Dynamic Navbar
- Dynamic Footer
- Dynamic Hero
- Dynamic About
- Dynamic Resume
- Dynamic Portfolio
- Dynamic Blog
- Dynamic Contact

## Deliverables

- Seluruh frontend menjadi dinamis.

---

# 14. Phase 12 - Optimization

## Tasks

- Responsive Testing
- Performance Optimization
- SEO Optimization
- Image Optimization
- Error Handling

## Deliverables

- Website siap digunakan.

---

# 15. Phase 13 - Security Review

## Checklist

- Password Hash
- SQL Injection Test
- XSS Test
- CSRF Test
- Session Test
- Upload Validation

## Deliverables

- Sistem memenuhi standar keamanan dasar.

---

# 16. Phase 14 - Final Testing

## Checklist

- Frontend Testing
- CMS Testing
- CRUD Testing
- Upload Testing
- Responsive Testing
- Browser Testing

## Deliverables

- Semua fitur berjalan sesuai requirement.

---

# 17. Phase 15 - Deployment

## Tasks

- Export Database
- Backup Upload
- Environment Configuration
- Production Testing

## Deliverables

- Website siap dipublikasikan.

---

# 18. Definition of Done

Sebuah fase dianggap selesai apabila:

- Semua task selesai.
- Tidak ada bug kritis.
- Sudah dilakukan pengujian.
- Lulus self review.
- Siap masuk ke fase berikutnya.

---

# 19. Development Rules

- Tidak boleh melompati fase.
- Tidak boleh mengubah database tanpa persetujuan.
- Tidak boleh menambah fitur di luar Feature List.
- Selalu lakukan testing sebelum merge.
- Dokumentasi harus diperbarui jika ada perubahan requirement.

---

# 20. Final Goal

Pada akhir roadmap ini akan dihasilkan:

- Personal Portfolio Website berbasis EasyFolio.
- CMS Admin berbasis PHP Native.
- Database MySQL yang terstruktur.
- Seluruh konten frontend dapat dikelola melalui CMS.
- Website siap dipresentasikan sebagai project tugas.