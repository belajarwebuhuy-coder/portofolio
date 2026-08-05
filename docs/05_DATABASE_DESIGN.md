# DOCS 05 - DATABASE_DESIGN.md

Version : 1.0
Status  : Approved
Project : Personal Portfolio CMS

---

# 1. Tujuan

Dokumen ini menjelaskan desain database yang digunakan oleh Personal Portfolio CMS.

Seluruh struktur database dibuat berdasarkan kebutuhan fitur pada DOCS 04.

Prinsip utama:

- Sederhana
- Mudah dipelihara
- Mudah dikembangkan
- Tidak Over Engineering

---

# 2. Database Information

Database Engine

MySQL 8.0

Character Set

utf8mb4

Collation

utf8mb4_unicode_ci

Storage Engine

InnoDB

---

# 3. Design Principles

Project ini menggunakan prinsip berikut.

- Satu modul = satu tabel
- Hindari tabel yang tidak diperlukan
- Hindari relasi berlebihan
- Gunakan Foreign Key hanya jika memang diperlukan
- Database harus mudah dipahami

---

# 4. Entity Relationship

users

↓

Login CMS

------------------------------------------------

settings

↓

Global Website Configuration

------------------------------------------------

hero

↓

Homepage Hero

------------------------------------------------

about

↓

Homepage About

------------------------------------------------

education

↓

Resume

------------------------------------------------

experience

↓

Resume

------------------------------------------------

skills

↓

Resume

------------------------------------------------

certificates

↓

Resume

------------------------------------------------

projects

↓

Portfolio

↓

project_images

------------------------------------------------

blogs

↓

Homepage + Blog

------------------------------------------------

messages

↓

Contact Messages

---

# 5. Database Tables

Total Table

12

1. users
2. settings
3. hero
4. about
5. education
6. experience
7. skills
8. certificates
9. projects
10. project_images
11. blogs
12. messages

---

# 6. Table Design

====================================================

TABLE : users

====================================================

Purpose

Administrator Login

Columns

id
BIGINT
PK
AUTO_INCREMENT

name
VARCHAR(100)

email
VARCHAR(150)
UNIQUE

password
VARCHAR(255)

photo
VARCHAR(255)

created_at
TIMESTAMP

updated_at
TIMESTAMP

------------------------------------------------

Notes

Hanya satu administrator pada versi pertama.

====================================================

TABLE : settings

====================================================

Purpose

Global Website Configuration

Columns

id

website_name

logo

favicon

owner_name

owner_profession

owner_photo

email

phone

address

github

linkedin

instagram

facebook

x

youtube

meta_title

meta_description

google_verification

default_dark_mode

maintenance_mode

created_at

updated_at

------------------------------------------------

Notes

Hanya satu record.

====================================================

TABLE : hero

====================================================

Purpose

Homepage Hero

Columns

id

greeting

title

profession

description

hero_image

button1_text

button1_link

button2_text

button2_link

created_at

updated_at

------------------------------------------------

Notes

Satu record.

====================================================

TABLE : about

====================================================

Purpose

Homepage About

Columns

id

photo

title

description

birth_date

location

email

phone

created_at

updated_at

------------------------------------------------

Notes

Satu record.

====================================================

TABLE : education

====================================================

Purpose

Resume

Columns

id

institution

degree

start_year

end_year

description

sort_order

created_at

updated_at

====================================================

TABLE : experience

====================================================

Purpose

Resume

Columns

id

company

position

start_date

end_date

description

sort_order

created_at

updated_at

====================================================

TABLE : skills

====================================================

Purpose

Resume

Columns

id

name

percentage

sort_order

created_at

updated_at

====================================================

TABLE : certificates

====================================================

Purpose

Resume

Columns

id

title

issuer

issue_date

credential_id

credential_url

image

sort_order

created_at

updated_at

====================================================

TABLE : projects

====================================================

Purpose

Portfolio

Columns

id

title

slug

thumbnail

short_description

description

tech_stack

github_url

demo_url

featured

status

created_at

updated_at

------------------------------------------------

Status

Draft

Published

====================================================

TABLE : project_images

====================================================

Purpose

Gallery Project

Columns

id

project_id

image

sort_order

created_at

updated_at

------------------------------------------------

Foreign Key

project_id

↓

projects.id

====================================================

TABLE : blogs

====================================================

Purpose

Blog

Columns

id

title

slug

thumbnail

summary

content

tags

status

published_at

created_at

updated_at

------------------------------------------------

Status

Draft

Published

====================================================

TABLE : messages

====================================================

Purpose

Contact Messages

Columns

id

name

email

subject

message

is_read

created_at

------------------------------------------------

is_read

0 = Unread

1 = Read

---

# 7. Relationship

projects (1)

↓

project_images (N)

Selain relasi tersebut, seluruh tabel berdiri sendiri.

---

# 8. Upload Strategy

Semua file upload disimpan pada folder.

uploads/

hero/

about/

projects/

certificates/

blog/

profile/

settings/

Database hanya menyimpan:

Nama File

Contoh

hero.webp

Frontend akan membaca.

uploads/hero/hero.webp

---

# 9. Naming Convention

Table

Plural

Contoh

projects

blogs

messages

Column

snake_case

Contoh

created_at

updated_at

credential_url

---

# 10. Index Strategy

UNIQUE

users.email

projects.slug

blogs.slug

INDEX

projects.status

projects.featured

blogs.status

messages.is_read

---

# 11. Security

Password

password_hash()

Prepared Statement

Wajib

CSRF Protection

Wajib

Session Authentication

Wajib

XSS Protection

Menggunakan htmlspecialchars()

---

# 12. Backup Strategy

Database dibackup secara manual.

Upload folder ikut dibackup.

Karena database hanya menyimpan nama file.

---

# 13. Future Database

Tidak termasuk versi pertama.

- categories
- comments
- media
- roles
- permissions
- notifications
- activity_logs
- api_tokens

---

# 14. Final Decision

Database menggunakan:

12 Table

1 Foreign Key

MySQL 8

PHP Native

Struktur dibuat sederhana agar mudah dipelihara, mudah dipahami, dan cukup fleksibel untuk pengembangan di masa depan tanpa menjadi over engineering.