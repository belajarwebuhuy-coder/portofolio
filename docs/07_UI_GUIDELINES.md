# DOCS 07 - UI_GUIDELINES.md

Version : 1.0
Status  : Approved
Project : Personal Portfolio CMS

---

# 1. Tujuan

Dokumen ini menjadi standar tampilan (UI) untuk seluruh halaman CMS.

Tujuan utama:

- Konsisten
- Modern
- Mudah digunakan
- Responsive
- Bersih
- Profesional

Frontend mengikuti template EasyFolio.

Dokumen ini hanya berlaku untuk halaman CMS.

---

# 2. Design Principles

CMS harus memiliki tampilan yang sederhana namun profesional.

Prinsip UI:

- Clean
- Minimalist
- Consistent
- Responsive
- Accessible

Hindari dekorasi berlebihan.

---

# 3. Framework

Framework UI

Bootstrap 5

Icons

Bootstrap Icons

Font

Poppins

---

# 4. Color Palette

Primary

#0d6efd

Success

#198754

Danger

#dc3545

Warning

#ffc107

Info

#0dcaf0

Dark

#212529

Light Background

#f8f9fa

Border

#dee2e6

Text

#212529

Muted Text

#6c757d

---

# 5. Layout

CMS menggunakan layout tetap.

+--------------------------------------+
| Navbar                               |
+-----------+--------------------------+
| Sidebar   | Main Content             |
|           |                          |
|           |                          |
|           |                          |
+-----------+--------------------------+

Sidebar berada di kiri.

Navbar berada di atas.

Main Content berada di kanan.

Footer berada di bawah Main Content.

---

# 6. Sidebar

Sidebar selalu menampilkan:

- Dashboard
- Hero
- About
- Resume
  - Education
  - Experience
  - Skills
  - Certificates
- Projects
- Blog
- Contact Messages
- Settings
- Profile
- Logout

Sidebar dapat di-collapse pada layar kecil.

Menu aktif harus memiliki highlight.

---

# 7. Navbar

Navbar menampilkan:

- Judul Halaman
- Foto Admin
- Dropdown Profile

Navbar selalu berada di bagian atas.

---

# 8. Card

Seluruh informasi menggunakan Bootstrap Card.

Aturan:

- Border Radius konsisten
- Shadow ringan
- Padding 20px
- Margin bawah konsisten

---

# 9. Table

Semua data menggunakan Bootstrap Table.

Header:

- Background Primary
- Text Putih

Fitur:

- Responsive
- Hover
- Striped
- Pagination

Kolom Action berada di paling kanan.

---

# 10. Form

Semua form mengikuti standar Bootstrap.

Input memiliki:

- Label
- Placeholder
- Validation Message

Field wajib diberi tanda *

Contoh:

Name *

---

# 11. Button

Primary

Save

Success

Publish

Warning

Edit

Danger

Delete

Secondary

Cancel

Button memiliki icon.

Contoh:

Save

✔ Save

Delete

🗑 Delete

---

# 12. Modal

Modal digunakan untuk:

- Delete Confirmation
- Image Preview
- Small Information

Form besar tidak menggunakan modal.

---

# 13. Alert

Bootstrap Alert.

Jenis:

Success

Danger

Warning

Info

Alert dapat ditutup.

---

# 14. Badge

Badge digunakan untuk:

Draft

Published

Featured

Unread

Read

---

# 15. Image Upload

Setelah upload.

Admin langsung melihat preview.

Jika gambar gagal.

Tampilkan placeholder.

---

# 16. Dashboard Widget

Widget menggunakan Card.

Isi:

- Total Projects
- Total Blog
- Total Certificates
- Total Contact Messages

Widget memiliki icon.

---

# 17. Empty State

Jika data kosong.

Tampilkan:

Icon

Judul

Deskripsi

Button Add New

Jangan menampilkan tabel kosong.

---

# 18. Loading

Setiap proses:

- Save
- Delete
- Upload

Menampilkan Loading Spinner.

---

# 19. Confirmation

Semua aksi Delete harus meminta konfirmasi.

Contoh:

"Apakah Anda yakin ingin menghapus data ini?"

---

# 20. Validation

Jika terjadi error.

Field berubah merah.

Pesan error muncul di bawah field.

---

# 21. Responsive

Desktop

Sidebar tetap tampil.

Tablet

Sidebar dapat collapse.

Mobile

Sidebar berubah Offcanvas Bootstrap.

---

# 22. Accessibility

Gunakan:

- Label pada setiap input
- Alt pada gambar
- Kontras warna yang baik
- Focus State pada tombol

---

# 23. Animation

Animasi secukupnya.

Gunakan:

- Fade
- Collapse
- Spinner

Hindari animasi berlebihan.

---

# 24. Icon Guidelines

Gunakan Bootstrap Icons.

Contoh:

Dashboard

bi-speedometer2

Projects

bi-kanban

Blog

bi-journal-text

Messages

bi-envelope

Settings

bi-gear

Profile

bi-person-circle

Logout

bi-box-arrow-right

---

# 25. File Manager

Upload dilakukan dari masing-masing modul.

Tidak ada halaman Media Manager.

---

# 26. Notification

Setelah aksi berhasil.

Gunakan Toast Bootstrap.

Contoh:

Project berhasil ditambahkan.

Blog berhasil diperbarui.

Pesan berhasil dihapus.

---

# 27. Dark Mode

CMS mendukung Dark Mode.

Pengguna dapat mengganti tema tanpa mengubah layout.

Preferensi tema disimpan agar tetap digunakan pada login berikutnya.

---

# 28. Konsistensi UI

Semua halaman CMS wajib memiliki:

- Struktur layout yang sama
- Posisi tombol yang konsisten
- Jarak antar elemen yang konsisten
- Warna yang konsisten
- Ikon yang konsisten

Tidak diperbolehkan membuat halaman dengan desain berbeda tanpa alasan yang jelas.

---

# 29. Final Goal

CMS harus memberikan pengalaman yang:

- Mudah dipelajari
- Cepat digunakan
- Nyaman digunakan
- Konsisten di seluruh halaman

UI harus mendukung produktivitas administrator, bukan sekadar terlihat menarik.