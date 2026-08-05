# PROJECT STRUCTURE

Version : 1.0
Status  : Approved
Project : Personal Portfolio CMS

---

# 1. Tujuan

Dokumen ini menjelaskan struktur folder dan file project.

Seluruh proses pengembangan wajib mengikuti struktur ini.

Perubahan struktur hanya boleh dilakukan setelah mendapat persetujuan.

---

# 2. Prinsip Struktur

Struktur project dibuat berdasarkan prinsip berikut:

- Sederhana
- Mudah dipahami
- Mudah dipelihara
- Mudah dikembangkan
- Konsisten

Hindari membuat folder yang tidak memiliki fungsi jelas.

---

# 3. Root Folder

```text
personal-portfolio-cms/

│

├── admin/
├── assets/
├── includes/
├── uploads/
├── database/
├── docs/

│

├── index.php
├── project-detail.php
├── blog-detail.php
└── .htaccess
```

---

# 4. Folder admin/

Berisi seluruh halaman CMS.

```text
admin/

│

├── login.php
├── logout.php
├── dashboard.php

│

├── hero/
├── about/
├── resume/
├── projects/
├── blog/
├── messages/
├── media/
├── seo/
├── settings/
└── profile/
```

Folder ini hanya dapat diakses oleh Administrator.

---

# 5. Struktur Modul CMS

Seluruh modul menggunakan struktur yang sama.

Contoh:

```text
projects/

│

├── index.php

├── create.php

├── edit.php

├── delete.php

└── save.php
```

Apabila tidak diperlukan, file dapat dikurangi.

Namun urutan dan penamaan harus tetap konsisten.

---

# 6. Folder assets/

Menyimpan seluruh aset website.

```text
assets/

│

├── css/

├── js/

├── images/

├── icons/

└── fonts/
```

---

# 7. Folder includes/

Berisi file yang digunakan bersama.

```text
includes/

│

├── config.php

├── database.php

├── auth.php

├── functions.php

├── header.php

├── footer.php

├── navbar.php

└── sidebar.php
```

Seluruh halaman menggunakan include agar tidak terjadi duplikasi kode.

---

# 8. Folder uploads/

Menyimpan seluruh file hasil upload.

```text
uploads/

│

├── hero/

├── about/

├── projects/

├── blog/

├── certificates/

├── profile/

└── settings/
```

Semua upload wajib divalidasi sebelum disimpan.

---

# 9. Folder database/

Berisi file yang berhubungan dengan database.

```text
database/

│

├── schema/

├── migrations/

└── seeders/
```

Untuk versi pertama, folder migrations dan seeders bersifat opsional.

---

# 10. Folder docs/

Menyimpan seluruh dokumentasi project.

Dokumen menjadi acuan selama proses development.

---

# 11. Frontend Files

Halaman utama website.

```text
index.php

project-detail.php

blog-detail.php
```

Semua data berasal dari database.

---

# 12. Reusable Components

Komponen berikut tidak boleh ditulis berulang.

- Header
- Footer
- Navbar
- Sidebar

Gunakan include.

---

# 13. Naming Convention

Gunakan huruf kecil.

Pisahkan kata menggunakan tanda minus (-).

Contoh:

project-detail.php

blog-detail.php

contact-form.php

Hindari:

ProjectDetail.php

projectDetail.php

Project.php

---

# 14. Asset Naming

CSS

```text
style.css

dashboard.css

blog.css
```

JavaScript

```text
main.js

dashboard.js

blog.js
```

Image

Gunakan nama yang deskriptif.

Contoh:

hero-banner.jpg

project-1.webp

about-photo.png

---

# 15. Upload Naming

Nama file upload tidak menggunakan nama asli pengguna.

Gunakan format:

YYYYMMDD-HHMMSS-random.ext

Contoh:

20260804-103012-a8f2c1.webp

Hal ini bertujuan untuk menghindari nama file yang sama.

---

# 16. Future Expansion

Apabila project berkembang, modul baru ditempatkan di dalam folder admin.

Jangan membuat folder baru di root kecuali benar-benar diperlukan.

---

# 17. Final Notes

Struktur project ini dirancang agar:

- Mudah dipahami oleh mahasiswa.
- Mudah dikerjakan menggunakan PHP Native.
- Mudah dikembangkan pada masa mendatang.
- Tidak over-engineering.