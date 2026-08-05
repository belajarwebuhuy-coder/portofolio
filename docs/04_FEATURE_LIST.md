# DOCS 04 - FEATURE_LIST.md

Version : 1.0
Status  : Approved
Project : Personal Portfolio CMS

---

# 1. Tujuan Dokumen

Dokumen ini menjelaskan seluruh fitur yang akan dibangun pada Personal Portfolio CMS.

Dokumen ini menjadi acuan utama sebelum membuat desain database dan memulai proses development.

Seluruh fitur pada dokumen ini telah disesuaikan dengan template frontend EasyFolio.

---

# 2. Hak Akses

Versi pertama hanya memiliki satu jenis pengguna.

Role:

- Administrator

Administrator memiliki akses penuh terhadap seluruh fitur CMS.

---

# 3. Frontend Features

Frontend menggunakan template EasyFolio yang telah diintegrasikan dengan CMS.

Semua data frontend berasal dari database.

---

## 3.1 Hero Section

### Purpose

Menampilkan identitas utama pemilik portfolio.

### Content

- Greeting
- Nama
- Profession
- Deskripsi
- Hero Image
- Button 1
- Button 2

### CMS

Hero Management

### Frontend

Homepage

---

## 3.2 About Section

### Purpose

Menampilkan informasi singkat mengenai pemilik portfolio.

### Content

- Foto
- Judul
- Deskripsi
- Informasi pribadi

### CMS

About Management

### Frontend

Homepage

---

## 3.3 Resume Section

Resume terdiri dari beberapa bagian yang dikelola secara terpisah.

### Education

CRUD

### Experience

CRUD

### Skills

CRUD

Skill memiliki progress (%).

### Certificates

CRUD

Setiap sertifikat memiliki:

- Thumbnail
- Judul
- Penerbit
- Credential ID
- Credential URL
- Tanggal

Frontend menampilkan seluruh data dalam satu section Resume.

---

## 3.4 Portfolio Section

Nama modul pada CMS:

Projects

Frontend tetap menggunakan nama:

Portfolio

### Features

- List Project
- Featured Project
- Filter Portfolio
- Detail Project

Setiap project memiliki:

- Thumbnail
- Gallery
- Tech Stack
- GitHub URL
- Live Demo URL
- Deskripsi
- Featured
- Status

---

## 3.5 Portfolio Detail

Halaman detail project.

Menampilkan:

- Informasi lengkap
- Gallery
- Tech Stack
- GitHub
- Live Demo

File:

portfolio-details.php

---

## 3.6 Blog Section

Homepage hanya menampilkan:

3 artikel terbaru.

Disediakan tombol:

View All Articles

---

## 3.7 Blog List

Halaman yang menampilkan seluruh artikel.

Fitur:

- Pagination
- Search (Opsional)

---

## 3.8 Blog Detail

Menampilkan:

- Thumbnail
- Judul
- Isi Artikel
- Tags
- Publish Date

---

## 3.9 Contact Section

Menampilkan:

- Contact Form
- Email
- Phone
- Address
- Google Maps
- Social Media

Pesan disimpan ke database.

Tidak menggunakan SMTP.

---

## 3.10 Footer

Menampilkan:

- Copyright
- Website Name
- Social Media

Seluruh data berasal dari Settings.

---

# 4. CMS Features

---

## 4.1 Authentication

Fitur:

- Login
- Logout
- Session

Hanya Administrator yang dapat mengakses Dashboard.

---

## 4.2 Dashboard

Menampilkan:

- Total Projects
- Total Blog
- Total Certificates
- Total Contact Messages

Recent:

- Project
- Blog
- Messages

---

## 4.3 Hero Management

Administrator dapat:

- Edit Hero
- Upload Hero Image
- Edit Button 1
- Edit Button 2

Tidak ada fitur tambah data.

---

## 4.4 About Management

Administrator dapat:

- Edit About
- Upload Foto
- Edit Informasi

Tidak ada fitur tambah data.

---

## 4.5 Education Management

CRUD lengkap.

---

## 4.6 Experience Management

CRUD lengkap.

---

## 4.7 Skills Management

CRUD lengkap.

Field:

- Skill Name
- Progress (%)

---

## 4.8 Certificates Management

CRUD lengkap.

Upload:

- Thumbnail

Data:

- Title
- Issuer
- Issue Date
- Credential ID
- Credential URL

---

## 4.9 Projects Management

Merupakan modul terbesar.

Fitur:

- CRUD
- Upload Thumbnail
- Upload Gallery
- Featured Project
- Publish Draft
- Search
- Preview

---

## 4.10 Blog Management

Fitur:

- CRUD
- Upload Thumbnail
- Draft
- Publish
- Tags

---

## 4.11 Contact Messages

Fitur:

- View
- Read
- Delete

Tidak ada Reply.

Tidak ada Email.

---

## 4.12 Settings

Mengatur seluruh konfigurasi website.

### Website

- Website Name
- Logo
- Favicon

### Owner

- Nama
- Profession
- Email
- Phone
- Address

### Social Media

- GitHub
- LinkedIn
- Instagram
- Facebook
- X
- YouTube

### SEO

- Meta Title
- Meta Description
- Google Verification

### Theme

- Default Dark Mode

### System

- Maintenance Mode

---

## 4.13 Profile

Administrator dapat:

- Ganti Nama
- Ganti Email
- Ganti Password
- Ganti Foto Profile

---

# 5. Global Features

Seluruh sistem mendukung fitur berikut.

---

## Responsive

Desktop

Tablet

Mobile

---

## Loading Screen

Menggunakan loading screen sebelum website tampil.

---

## Dark Mode

Frontend mendukung Dark Mode.

Pengaturan default berasal dari Settings.

---

## SEO

Website mendukung:

- Meta Title
- Meta Description
- Favicon
- Open Graph (Opsional)

---

## Upload Image

Semua upload:

- JPG
- PNG
- WEBP

File disimpan pada folder uploads sesuai modul.

Database hanya menyimpan nama file.

---

## Validation

Semua form memiliki validasi:

- Required Field
- File Validation
- Input Validation

---

## Security

Minimal keamanan:

- Password Hash
- Prepared Statement
- Session Authentication
- CSRF Protection
- XSS Protection

---

# 6. Future Features (Tidak Masuk Versi 1)

Fitur berikut tidak akan dibuat pada versi pertama.

- Multi Admin
- Role Permission
- Media Library
- Comments
- Categories
- Notifications
- Email SMTP
- API
- REST API
- Multi Language
- Activity Logs
- Scheduled Publish

---

# 7. Scope Freeze

Dokumen ini menjadi acuan utama seluruh pengembangan fitur.

Setiap penambahan fitur baru wajib melalui proses persetujuan dan dicatat pada CHANGELOG.

Tidak diperbolehkan menambahkan fitur di luar dokumen ini tanpa persetujuan.