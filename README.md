# Personal Portfolio CMS

A complete Content Management System (CMS) + Personal Portfolio website built with **PHP Native 8.2+**, **MySQL 8**, and **Bootstrap 5**.

## ✨ Features

### Frontend

- Dynamic Homepage (Hero, About, Skills, Resume, Portfolio, Blog, Contact)
- Portfolio Detail page
- Blog List (with pagination) + Blog Detail
- Contact form (with honeypot + rate limiting + validation)
- Dark Mode support
- Skill progress bars
- SEO-ready (meta title, description, favicon)

### CMS Admin

- Authentication (Login / Logout)
- Dashboard with statistics & recent activity
- **Settings** (Website, Owner, Social Media, SEO, Theme, Maintenance)
- **Hero** management
- **About** management
- **Resume** (Education, Experience, Skills, Certificates)
- **Projects** (thumbnail + gallery + featured + status)
- **Blog** (draft/publish + tags)
- **Contact Messages** (view / read / delete)
- **Profile** (name, email, password, photo)

## 🛠 Tech Stack

- PHP 8.2+ (Native, PDO)
- MySQL 8.0
- Bootstrap 5.3
- Bootstrap Icons
- JavaScript ES6

## 📁 Project Structure

```
personal-portfolio-cms/
├── admin/          # CMS pages
├── assets/         # CSS, JS, images, vendor
├── includes/       # Shared files (config, database, auth, header, footer)
├── uploads/        # Uploaded images (secured)
├── database/       # SQL schema
├── docs/           # Project documentation
├── index.php       # Homepage
├── blog.php        # Blog list
├── blog-detail.php # Blog detail
├── portfolio-details.php # Portfolio detail
└── contact.php     # Contact form handler
```

## 🚀 Installation

### 1. Setup Database

Start **Apache** and **MySQL** in XAMPP/Laragon.

Import the schema into phpMyAdmin:

```
http://localhost/phpmyadmin
```

Import file: `database/schema.sql`

This creates the `portfolio_cms` database with 12 tables and default data.

### 2. Configure

Edit `includes/config.php` if your database credentials differ:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'portfolio_cms');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### 3. Run

Access the website:

```
http://localhost/Angkatan-3-2026/Personal Portfolio CMS/
```

Access the admin panel:

```
http://localhost/Angkatan-3-2026/Personal Portfolio CMS/admin/login.php
```

### Default Admin Login

```
Email:    admin@example.com
Password: admin123
```

## 🔒 Security

- Password hashing (`password_hash`)
- PDO Prepared Statements
- CSRF Protection
- XSS escaping (`htmlspecialchars`)
- Session authentication
- Upload validation (JPG/PNG/WEBP, max 5MB)
- Upload folder blocked from PHP execution
- Contact form honeypot + rate limiting

## 📚 Documentation

All project documentation is in the `docs/` folder (DOCS 01–10).

## 📄 License

Educational project. Frontend template: EasyFolio by BootstrapMade.
