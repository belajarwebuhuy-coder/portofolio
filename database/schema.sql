-- ====================================================
-- Personal Portfolio CMS
-- Database Schema
-- MySQL 8.0 | utf8mb4 | InnoDB
-- Author : Wahyu Subuh
-- ====================================================

CREATE DATABASE IF NOT EXISTS portfolio_cms
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE portfolio_cms;

-- ----------------------------------------------------
-- TABLE : users
-- ----------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    photo VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- TABLE : settings
-- ----------------------------------------------------
CREATE TABLE IF NOT EXISTS settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    website_name VARCHAR(150) NULL,
    logo VARCHAR(255) NULL,
    favicon VARCHAR(255) NULL,
    owner_name VARCHAR(150) NULL,
    owner_profession VARCHAR(150) NULL,
    owner_photo VARCHAR(255) NULL,
    email VARCHAR(150) NULL,
    phone VARCHAR(50) NULL,
    address VARCHAR(255) NULL,
    github VARCHAR(255) NULL,
    linkedin VARCHAR(255) NULL,
    instagram VARCHAR(255) NULL,
    facebook VARCHAR(255) NULL,
    x VARCHAR(255) NULL,
    youtube VARCHAR(255) NULL,
    meta_title VARCHAR(200) NULL,
    meta_description VARCHAR(500) NULL,
    google_verification VARCHAR(255) NULL,
    default_dark_mode TINYINT(1) DEFAULT 0,
    maintenance_mode TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- TABLE : hero
-- ----------------------------------------------------
CREATE TABLE IF NOT EXISTS hero (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    greeting VARCHAR(150) NULL,
    title VARCHAR(200) NULL,
    profession VARCHAR(150) NULL,
    description TEXT NULL,
    hero_image VARCHAR(255) NULL,
    button1_text VARCHAR(100) NULL,
    button1_link VARCHAR(255) NULL,
    button2_text VARCHAR(100) NULL,
    button2_link VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- TABLE : about
-- ----------------------------------------------------
CREATE TABLE IF NOT EXISTS about (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    photo VARCHAR(255) NULL,
    title VARCHAR(200) NULL,
    description TEXT NULL,
    birth_date VARCHAR(50) NULL,
    location VARCHAR(150) NULL,
    email VARCHAR(150) NULL,
    phone VARCHAR(50) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- TABLE : education
-- ----------------------------------------------------
CREATE TABLE IF NOT EXISTS education (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    institution VARCHAR(255) NOT NULL,
    degree VARCHAR(200) NOT NULL,
    start_year VARCHAR(20) NULL,
    end_year VARCHAR(20) NULL,
    description TEXT NULL,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- TABLE : experience
-- ----------------------------------------------------
CREATE TABLE IF NOT EXISTS experience (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company VARCHAR(255) NOT NULL,
    position VARCHAR(200) NOT NULL,
    start_date VARCHAR(50) NULL,
    end_date VARCHAR(50) NULL,
    description TEXT NULL,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- TABLE : skills
-- ----------------------------------------------------
CREATE TABLE IF NOT EXISTS skills (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    percentage INT NOT NULL DEFAULT 0,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- TABLE : certificates
-- ----------------------------------------------------
CREATE TABLE IF NOT EXISTS certificates (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    issuer VARCHAR(255) NULL,
    issue_date VARCHAR(50) NULL,
    credential_id VARCHAR(255) NULL,
    credential_url VARCHAR(255) NULL,
    image VARCHAR(255) NULL,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- TABLE : projects
-- ----------------------------------------------------
CREATE TABLE IF NOT EXISTS projects (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    thumbnail VARCHAR(255) NULL,
    short_description TEXT NULL,
    description TEXT NULL,
    tech_stack TEXT NULL,
    github_url VARCHAR(255) NULL,
    demo_url VARCHAR(255) NULL,
    featured TINYINT(1) DEFAULT 0,
    status ENUM('draft','published') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_projects_status (status),
    INDEX idx_projects_featured (featured)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- TABLE : project_images
-- ----------------------------------------------------
CREATE TABLE IF NOT EXISTS project_images (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    project_id BIGINT UNSIGNED NOT NULL,
    image VARCHAR(255) NOT NULL,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_project_images_project
        FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- TABLE : blogs
-- ----------------------------------------------------
CREATE TABLE IF NOT EXISTS blogs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    thumbnail VARCHAR(255) NULL,
    summary TEXT NULL,
    content LONGTEXT NULL,
    tags VARCHAR(255) NULL,
    status ENUM('draft','published') DEFAULT 'draft',
    published_at TIMESTAMP NULL DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_blogs_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- TABLE : messages
-- ----------------------------------------------------
CREATE TABLE IF NOT EXISTS messages (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    subject VARCHAR(255) NULL,
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_messages_is_read (is_read)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ====================================================
-- Default Data (Seeder)
-- ====================================================

-- Default admin (password: admin123)
INSERT INTO users (name, email, password) VALUES
('Administrator', 'admin@example.com', '$2y$10$ua8i2Whz6cZJITjUfLra1.haMMkdNZNobFRN5oBXz0r0PTX011EUK');

-- Default settings
INSERT INTO settings (website_name, owner_name, owner_profession, email, phone, address, meta_title, meta_description)
VALUES ('Personal Portfolio', 'John Doe', 'Full-Stack Developer', 'hello@example.com', '+62 812 3456 7890', 'Jakarta, Indonesia', 'Personal Portfolio CMS', 'A modern personal portfolio built with PHP Native and MySQL');

-- Default hero
INSERT INTO hero (greeting, title, profession, description, button1_text, button1_link, button2_text, button2_link)
VALUES ('Hello, I am', 'John Doe', 'Full-Stack Developer', 'I build modern web applications with clean code and great user experience.', 'View My Work', '#portfolio', 'Contact Me', '#contact');

-- Default about
INSERT INTO about (title, description, birth_date, location, email, phone)
VALUES ('UI/UX Designer & Web Developer', 'I am a passionate developer who loves creating elegant and functional web solutions.', '1998-01-01', 'Jakarta, Indonesia', 'hello@example.com', '+62 812 3456 7890');
