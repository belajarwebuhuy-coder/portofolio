<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Admin Header
 * Description : Admin layout header (open HTML + styles)
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/auth.php';

$pageTitle = $pageTitle ?? 'Dashboard';
$currentUser = currentUser();
$flash = getFlash();
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> - <?= e(APP_NAME) ?></title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f8f9fa;
    }

    .wrapper {
        display: flex;
        min-height: 100vh;
    }

    .sidebar {
        width: 250px;
        min-height: 100vh;
        background: #212529;
        color: #fff;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        transition: transform .3s ease;
    }

    .sidebar .brand {
        padding: 20px;
        font-weight: 600;
        font-size: 1.1rem;
        border-bottom: 1px solid rgba(255, 255, 255, .1);
    }

    .sidebar .nav-link {
        color: rgba(255, 255, 255, .8);
        padding: 12px 20px;
        border-radius: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sidebar .nav-link:hover {
        background: rgba(255, 255, 255, .08);
        color: #fff;
    }

    .sidebar .nav-link.active {
        background: #0d6efd;
        color: #fff;
    }

    .sidebar .nav-section {
        padding: 15px 20px 5px;
        font-size: .75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(255, 255, 255, .5);
    }

    .main-content {
        margin-left: 250px;
        flex: 1;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .topbar {
        background: #fff;
        padding: 12px 24px;
        border-bottom: 1px solid #dee2e6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 999;
    }

    .content {
        padding: 24px;
        flex: 1;
    }

    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .5);
        z-index: 999;
    }

    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .main-content {
            margin-left: 0;
        }

        .sidebar-overlay.show {
            display: block;
        }
    }

    .card {
        border-radius: .5rem;
        box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: .5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
    }

    .table thead th {
        background: #0d6efd;
        color: #fff;
        white-space: nowrap;
    }

    .table {
        vertical-align: middle;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state i {
        font-size: 3rem;
        color: #adb5bd;
    }

    .dark-mode-toggle {
        cursor: pointer;
    }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="brand d-flex align-items-center gap-2">
            <i class="bi bi-person-badge"></i>
            <span><?= e(APP_NAME) ?></span>
        </div>

        <nav class="nav flex-column mt-2">
            <a class="nav-link <?= ($activeMenu ?? '') === 'dashboard' ? 'active' : '' ?>"
                href="<?= url('admin/dashboard.php') ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <div class="nav-section">Content</div>
            <a class="nav-link <?= ($activeMenu ?? '') === 'hero' ? 'active' : '' ?>"
                href="<?= url('admin/hero/index.php') ?>">
                <i class="bi bi-house-heart"></i> Hero
            </a>
            <a class="nav-link <?= ($activeMenu ?? '') === 'about' ? 'active' : '' ?>"
                href="<?= url('admin/about/index.php') ?>">
                <i class="bi bi-person-badge"></i> About
            </a>

            <div class="nav-section">Resume</div>
            <a class="nav-link <?= ($activeMenu ?? '') === 'education' ? 'active' : '' ?>"
                href="<?= url('admin/education/index.php') ?>">
                <i class="bi bi-mortarboard"></i> Education
            </a>
            <a class="nav-link <?= ($activeMenu ?? '') === 'experience' ? 'active' : '' ?>"
                href="<?= url('admin/experience/index.php') ?>">
                <i class="bi bi-briefcase"></i> Experience
            </a>
            <a class="nav-link <?= ($activeMenu ?? '') === 'skills' ? 'active' : '' ?>"
                href="<?= url('admin/skills/index.php') ?>">
                <i class="bi bi-bar-chart"></i> Skills
            </a>
            <a class="nav-link <?= ($activeMenu ?? '') === 'certificates' ? 'active' : '' ?>"
                href="<?= url('admin/certificates/index.php') ?>">
                <i class="bi bi-award"></i> Certificates
            </a>

            <div class="nav-section">Modules</div>
            <a class="nav-link <?= ($activeMenu ?? '') === 'projects' ? 'active' : '' ?>"
                href="<?= url('admin/projects/index.php') ?>">
                <i class="bi bi-kanban"></i> Projects
            </a>
            <a class="nav-link <?= ($activeMenu ?? '') === 'blog' ? 'active' : '' ?>"
                href="<?= url('admin/blog/index.php') ?>">
                <i class="bi bi-journal-text"></i> Blog
            </a>
            <a class="nav-link <?= ($activeMenu ?? '') === 'messages' ? 'active' : '' ?>"
                href="<?= url('admin/messages/index.php') ?>">
                <i class="bi bi-envelope"></i> Messages
            </a>

            <div class="nav-section">Configuration</div>
            <a class="nav-link <?= ($activeMenu ?? '') === 'settings' ? 'active' : '' ?>"
                href="<?= url('admin/settings/index.php') ?>">
                <i class="bi bi-gear"></i> Settings
            </a>
            <a class="nav-link <?= ($activeMenu ?? '') === 'profile' ? 'active' : '' ?>"
                href="<?= url('admin/profile/index.php') ?>">
                <i class="bi bi-person-circle"></i> Profile
            </a>
            <a class="nav-link" href="<?= url('admin/logout.php') ?>">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </nav>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="topbar">
            <button class="btn btn-outline-secondary d-lg-none" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <h5 class="mb-0"><?= e($pageTitle) ?></h5>
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-outline-secondary btn-sm dark-mode-toggle" id="darkModeToggle"
                    title="Toggle Dark Mode">
                    <i class="bi bi-moon-stars"></i>
                </button>
                <a href="<?= url('') ?>" class="btn btn-outline-primary btn-sm" target="_blank">
                    <i class="bi bi-eye"></i> View Site
                </a>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown">
                        <span class="me-2"><?= e($currentUser['name'] ?? 'Admin') ?></span>
                        <img src="<?= $currentUser['photo'] ? url('uploads/profile/' . $currentUser['photo']) : 'https://ui-avatars.com/api/?name=' . urlencode($currentUser['name'] ?? 'A') . '&background=0d6efd&color=fff' ?>"
                            alt="Profile" class="rounded-circle" style="width:36px;height:36px;object-fit:cover;">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?= url('admin/profile/index.php') ?>"><i
                                    class="bi bi-person-circle me-2"></i>Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="<?= url('admin/logout.php') ?>"><i
                                    class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <?php if ($flash): ?>
        <div class="px-4 pt-3">
            <div class="alert alert-<?= e($flash['type']) ?> alert-dismissible fade show" role="alert">
                <?= e($flash['message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        <?php endif; ?>

        <div class="content">