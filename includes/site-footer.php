<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

$settings = getSettings();
$siteName = $settings['website_name'] ?? 'My Portfolio';
?>
<footer id="footer" class="footer">
    <div class="container">
        <div class="copyright text-center">
            <p>© <span>Copyright</span> <strong class="px-1 sitename"><?= e($siteName) ?></strong> <span>All Rights
                    Reserved</span></p>
        </div>
        <div class="social-links d-flex justify-content-center">
            <?php if (!empty($settings['x'])): ?><a href="<?= e($settings['x']) ?>"><i
                    class="bi bi-twitter-x"></i></a><?php endif; ?>
            <?php if (!empty($settings['facebook'])): ?><a href="<?= e($settings['facebook']) ?>"><i
                    class="bi bi-facebook"></i></a><?php endif; ?>
            <?php if (!empty($settings['instagram'])): ?><a href="<?= e($settings['instagram']) ?>"><i
                    class="bi bi-instagram"></i></a><?php endif; ?>
            <?php if (!empty($settings['linkedin'])): ?><a href="<?= e($settings['linkedin']) ?>"><i
                    class="bi bi-linkedin"></i></a><?php endif; ?>
            <?php if (!empty($settings['github'])): ?><a href="<?= e($settings['github']) ?>"><i
                    class="bi bi-github"></i></a><?php endif; ?>
        </div>
    </div>
</footer>