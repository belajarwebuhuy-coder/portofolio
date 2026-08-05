<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Admin Footer
 * Description : Admin layout footer (close HTML + scripts)
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);
?>
</div><!-- /.content -->

<footer class="text-center py-3 border-top" style="background:#fff;">
    <small class="text-muted">&copy; <?= date('Y') ?> <?= e(APP_NAME) ?>. All rights reserved.</small>
</footer>
</div><!-- /.main-content -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Sidebar toggle for mobile
const sidebarToggle = document.getElementById('sidebarToggle');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebarOverlay');

if (sidebarToggle) {
    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
    });
}
if (overlay) {
    overlay.addEventListener('click', () => {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    });
}

// Dark mode toggle
const darkToggle = document.getElementById('darkModeToggle');
const root = document.documentElement;

function applyTheme(theme) {
    root.setAttribute('data-bs-theme', theme);
    localStorage.setItem('cms_theme', theme);
    const icon = darkToggle?.querySelector('i');
    if (icon) {
        icon.className = theme === 'dark' ? 'bi bi-sun' : 'bi bi-moon-stars';
    }
}

if (darkToggle) {
    darkToggle.addEventListener('click', () => {
        const current = root.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
        applyTheme(current);
    });
}

applyTheme(localStorage.getItem('cms_theme') || 'light');
</script>
</body>

</html>