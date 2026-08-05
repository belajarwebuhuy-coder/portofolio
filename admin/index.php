<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Login
 * Description : Administrator authentication
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';

redirectIfLoggedIn();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrfVerify($_POST['csrf_token'] ?? null)) {
        $error = 'CSRF token tidak valid.';
    } else {
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            $error = 'Email dan password wajib diisi.';
        } elseif (attemptLogin($email, $password)) {
            redirect('admin/dashboard.php');
        } else {
            $error = 'Email atau password salah.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?= e(APP_NAME) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #0d6efd 0%, #212529 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card {
        max-width: 420px;
        width: 100%;
        border-radius: 1rem;
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, .2);
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="card login-card mx-auto">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <i class="bi bi-person-badge" style="font-size:3rem;color:#0d6efd;"></i>
                    <h3 class="mt-2 mb-1"><?= e(APP_NAME) ?></h3>
                    <p class="text-muted mb-0">Sign in to your dashboard</p>
                </div>

                <?php if ($error): ?>
                <div class="alert alert-danger py-2"><?= e($error) ?></div>
                <?php endif; ?>

                <form method="post" action="">
                    <?= csrfField() ?>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="admin@example.com"
                                required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <a href="<?= url('') ?>" class="text-decoration-none small">
                        <i class="bi bi-arrow-left me-1"></i>Back to Website
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>