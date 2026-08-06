<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Frontend Home
 * Description : Dynamic homepage from database
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/functions.php';

$currentPage = 'home';
$settings = getSettings();
$pdo = db();

// Fetch homepage data
$hero = $pdo->query('SELECT * FROM hero WHERE id = 1 LIMIT 1')->fetch();
$about = $pdo->query('SELECT * FROM about WHERE id = 1 LIMIT 1')->fetch();

// Resume data
$educations = $pdo->query('SELECT * FROM education ORDER BY sort_order ASC, id DESC')->fetchAll();
$experiences = $pdo->query('SELECT * FROM experience ORDER BY sort_order ASC, id DESC')->fetchAll();
$skills = $pdo->query('SELECT * FROM skills ORDER BY sort_order ASC, id DESC')->fetchAll();
$certificates = $pdo->query('SELECT * FROM certificates ORDER BY sort_order ASC, id DESC')->fetchAll();

// Portfolio (published)
$projects = $pdo->query("SELECT * FROM projects WHERE status = 'published' ORDER BY featured DESC, id DESC")->fetchAll();

// Blog (latest 3 published)
$blogs = $pdo->query("SELECT * FROM blogs WHERE status = 'published' ORDER BY id DESC LIMIT 3")->fetchAll();

$siteTitle = $settings['meta_title'] ?? $settings['website_name'] ?? 'My Portfolio';
$siteDesc = $settings['meta_description'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($siteTitle) ?></title>
    <meta name="description" content="<?= e($siteDesc) ?>">
    <?php if (!empty($settings['google_verification'])): ?>
    <meta name="google-site-verification" content="<?= e($settings['google_verification']) ?>">
    <?php endif; ?>

    <!-- Favicons -->
    <?php if (!empty($settings['favicon'])): ?>
    <link href="<?= url('uploads/settings/' . $settings['favicon']) ?>" rel="icon">
    <?php else: ?>
    <link href="assets/img/favicon.png" rel="icon">
    <?php endif; ?>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Noto+Sans:wght@100;200;300;400;500;600;700;800;900&family=Questrial:wght@400&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center content">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <h2><?= e($hero['greeting'] ?? '') ?> <?= e($hero['title'] ?? '') ?></h2>
                        <p class="lead"><?= nl2br(e($hero['description'] ?? '')) ?></p>
                        <div class="cta-buttons" data-aos="fade-up" data-aos-delay="300">
                            <?php if (!empty($hero['button1_text'])): ?>
                            <a href="<?= e($hero['button1_link'] ?: '#portfolio') ?>"
                                class="btn btn-primary"><?= e($hero['button1_text']) ?></a>
                            <?php endif; ?>
                            <?php if (!empty($hero['button2_text'])): ?>
                            <a href="<?= e($hero['button2_link'] ?: '#contact') ?>"
                                class="btn btn-outline"><?= e($hero['button2_text']) ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-image">
                            <img src="<?= !empty($hero['hero_image']) ? url('uploads/hero/' . $hero['hero_image']) : (($settings['owner_photo'] ?? '') ? url('uploads/profile/' . $settings['owner_photo']) : 'assets/img/profile/profile-1.webp') ?>"
                                alt="Portfolio Hero Image" class="img-fluid" data-aos="zoom-out" data-aos-delay="300">
                            <div class="shape-1"></div>
                            <div class="shape-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section light-background">
            <div class="container section-title" data-aos="fade-up">
                <h2>About</h2>
                <div class="title-shape">
                    <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
                            stroke-width="2"></path>
                    </svg>
                </div>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center">
                    <div class="col-lg-6 position-relative" data-aos="fade-right" data-aos-delay="200">
                        <div class="about-image">
                            <img src="<?= !empty($about['photo']) ? url('uploads/about/' . $about['photo']) : 'assets/img/profile/profile-square-2.webp' ?>"
                                alt="Profile Image" class="img-fluid rounded-4">
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                        <div class="about-content">
                            <span class="subtitle">About Me</span>
                            <h2><?= e($about['title'] ?? '') ?></h2>
                            <p class="lead mb-4"><?= nl2br(e($about['description'] ?? '')) ?></p>
                            <div class="personal-info">
                                <div class="row g-4">
                                    <?php if (!empty($settings['owner_name'])): ?>
                                    <div class="col-6">
                                        <div class="info-item">
                                            <span class="label">Name</span>
                                            <span class="value"><?= e($settings['owner_name']) ?></span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($about['phone']) || !empty($settings['phone'])): ?>
                                    <div class="col-6">
                                        <div class="info-item">
                                            <span class="label">Phone</span>
                                            <span class="value"><?= e($about['phone'] ?? $settings['phone']) ?></span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($about['birth_date'])): ?>
                                    <div class="col-6">
                                        <div class="info-item">
                                            <span class="label">Birth Date</span>
                                            <span class="value"><?= e($about['birth_date']) ?></span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($about['email']) || !empty($settings['email'])): ?>
                                    <div class="col-6">
                                        <div class="info-item">
                                            <span class="label">Email</span>
                                            <span class="value"><?= e($about['email'] ?? $settings['email']) ?></span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($about['location'])): ?>
                                    <div class="col-6">
                                        <div class="info-item">
                                            <span class="label">Location</span>
                                            <span class="value"><?= e($about['location']) ?></span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['owner_profession'])): ?>
                                    <div class="col-6">
                                        <div class="info-item">
                                            <span class="label">Occupation</span>
                                            <span class="value"><?= e($settings['owner_profession']) ?></span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /About Section -->

        <!-- Skills Section -->
        <?php if ($skills): ?>
        <section id="skills" class="skills section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Skills</h2>
                <div class="title-shape">
                    <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
                            stroke-width="2"></path>
                    </svg>
                </div>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row g-4 skills-animation">
                    <?php foreach ($skills as $skill): ?>
                    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                        <div class="skill-box">
                            <h3><?= e($skill['name']) ?></h3>
                            <span class="text-end d-block"><?= (int) $skill['percentage'] ?>%</span>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar"
                                    aria-valuenow="<?= (int) $skill['percentage'] ?>" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-center mt-4">
                    <a href="<?= url('skills.php') ?>" class="btn btn-primary view-all-btn">View All Skills <i
                            class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- Resume Section -->
        <section id="resume" class="resume section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Resume</h2>
                <div class="title-shape">
                    <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
                            stroke-width="2"></path>
                    </svg>
                </div>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-12">
                        <div class="resume-wrapper">
                            <?php if ($experiences): ?>
                            <div class="resume-block" data-aos="fade-up">
                                <h2>Work Experience</h2>
                                <div class="timeline">
                                    <?php foreach ($experiences as $exp): ?>
                                    <div class="timeline-item" data-aos="fade-up">
                                        <div class="timeline-left">
                                            <h4 class="company"><?= e($exp['company']) ?></h4>
                                            <span class="period"><?= e($exp['start_date']) ?> -
                                                <?= e($exp['end_date'] ?: 'Present') ?></span>
                                        </div>
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-right">
                                            <h3 class="position"><?= e($exp['position']) ?></h3>
                                            <p class="description"><?= nl2br(e($exp['description'])) ?></p>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if ($educations): ?>
                            <div class="resume-block" data-aos="fade-up">
                                <h2>My Education</h2>
                                <div class="timeline">
                                    <?php foreach ($educations as $edu): ?>
                                    <div class="timeline-item" data-aos="fade-up">
                                        <div class="timeline-left">
                                            <h4 class="company"><?= e($edu['institution']) ?></h4>
                                            <span class="period"><?= e($edu['start_year']) ?> -
                                                <?= e($edu['end_year'] ?: 'Present') ?></span>
                                        </div>
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-right">
                                            <h3 class="position"><?= e($edu['degree']) ?></h3>
                                            <p class="description"><?= nl2br(e($edu['description'])) ?></p>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if ($certificates): ?>
                            <div class="resume-block" data-aos="fade-up">
                                <h2>Certificates</h2>
                                <div class="row g-4">
                                    <?php foreach ($certificates as $cert): ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card h-100">
                                            <?php if ($cert['image']): ?>
                                            <img src="<?= url('uploads/certificates/' . $cert['image']) ?>"
                                                class="card-img-top" alt="<?= e($cert['title']) ?>"
                                                style="height:160px;object-fit:cover;">
                                            <?php endif; ?>
                                            <div class="card-body">
                                                <h5 class="card-title"><?= e($cert['title']) ?></h5>
                                                <p class="text-muted small mb-1"><?= e($cert['issuer']) ?></p>
                                                <p class="text-muted small"><?= e($cert['issue_date']) ?></p>
                                                <?php if (!empty($cert['credential_url'])): ?>
                                                <a href="<?= e($cert['credential_url']) ?>" target="_blank"
                                                    class="btn btn-sm btn-outline-primary">View Credential</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Resume Section -->

        <!-- Portfolio Section -->
        <section id="portfolio" class="portfolio section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Portfolio</h2>
                <div class="title-shape">
                    <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
                            stroke-width="2"></path>
                    </svg>
                </div>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
                    <div class="row g-4 isotope-container" data-aos="fade-up" data-aos-delay="300">
                        <?php foreach ($projects as $project): ?>
                        <div class="col-lg-6 col-md-6 portfolio-item isotope-item">
                            <div class="portfolio-card">
                                <div class="portfolio-image">
                                    <img src="<?= !empty($project['thumbnail']) ? url('uploads/projects/' . $project['thumbnail']) : 'assets/img/portfolio/portfolio-1.webp' ?>"
                                        class="img-fluid" alt="<?= e($project['title']) ?>" loading="lazy">
                                    <div class="portfolio-overlay">
                                        <div class="portfolio-actions">
                                            <?php if (!empty($project['thumbnail'])): ?>
                                            <a href="<?= url('uploads/projects/' . $project['thumbnail']) ?>"
                                                class="glightbox preview-link"><i class="bi bi-eye"></i></a>
                                            <?php endif; ?>
                                            <a href="<?= url('portfolio-details.php?slug=' . $project['slug']) ?>"
                                                class="details-link"><i class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-content">
                                    <span
                                        class="category"><?= e(implode(', ', array_slice(explode(',', $project['tech_stack'] ?? ''), 0, 2))) ?></span>
                                    <h3><?= e($project['title']) ?></h3>
                                    <p><?= e(truncate($project['short_description'] ?? '', 80)) ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section><!-- /Portfolio Section -->

        <!-- Blog Section -->
        <?php if ($blogs): ?>
        <section id="blog" class="blog section light-background">
            <div class="container section-title" data-aos="fade-up">
                <h2>Latest Blog</h2>
                <div class="title-shape">
                    <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor"
                            stroke-width="2"></path>
                    </svg>
                </div>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row g-4">
                    <?php foreach ($blogs as $blog): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                            <?php if ($blog['thumbnail']): ?>
                            <img src="<?= url('uploads/blog/' . $blog['thumbnail']) ?>" class="card-img-top"
                                alt="<?= e($blog['title']) ?>" style="height:200px;object-fit:cover;">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><a href="<?= url('blog-detail.php?slug=' . $blog['slug']) ?>"
                                        class="text-decoration-none"><?= e($blog['title']) ?></a></h5>
                                <p class="card-text text-muted"><?= e(truncate($blog['summary'] ?? '', 100)) ?></p>
                                <small class="text-muted"><?= e(formatDate($blog['published_at'])) ?></small>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-center mt-4">
                    <a href="<?= url('blog.php') ?>" class="btn btn-primary">View All Articles</a>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- Contact Section -->
        <section id="contact" class="contact section light-background">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row g-5">
                    <div class="col-lg-6">
                        <div class="content" data-aos="fade-up" data-aos-delay="200">
                            <div class="section-category mb-3">Contact</div>
                            <h2 class="display-5 mb-4">Let's Get In Touch</h2>
                            <div class="contact-info mt-5">
                                <?php if (!empty($settings['email'])): ?>
                                <div class="info-item d-flex mb-3">
                                    <i class="bi bi-envelope-at me-3"></i>
                                    <span><?= e($settings['email']) ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($settings['phone'])): ?>
                                <div class="info-item d-flex mb-3">
                                    <i class="bi bi-telephone me-3"></i>
                                    <span><?= e($settings['phone']) ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($settings['address'])): ?>
                                <div class="info-item d-flex mb-4">
                                    <i class="bi bi-geo-alt me-3"></i>
                                    <span><?= e($settings['address']) ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="contact-form card" data-aos="fade-up" data-aos-delay="300">
                            <div class="card-body p-4 p-lg-5">
                                <form id="contactForm" method="post" class="php-email-form">
                                    <div class="row gy-4">
                                        <div class="col-12">
                                            <input type="text" name="name" class="form-control" placeholder="Your Name"
                                                required>
                                        </div>
                                        <div class="col-12">
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Your Email" required>
                                        </div>
                                        <div class="col-12">
                                            <input type="text" class="form-control" name="subject"
                                                placeholder="Subject">
                                        </div>
                                        <div class="col-12">
                                            <textarea class="form-control" name="message" rows="6"
                                                placeholder="Your Message" required></textarea>
                                        </div>
                                        <!-- Honeypot field -->
                                        <div class="col-12" style="display:none;">
                                            <input type="text" name="website" tabindex="-1" autocomplete="off">
                                        </div>
                                        <div class="col-12 text-center">
                                            <div class="loading" id="loading" style="display:none;">Loading...</div>
                                            <div class="alert alert-success py-2" id="sentMsg" style="display:none;">
                                                Your message has been sent. Thank you!</div>
                                            <div class="alert alert-danger py-2" id="errorMsg" style="display:none;">
                                            </div>
                                            <button type="submit" class="btn btn-outline w-100">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Contact Section -->

    </main>

    <?php include __DIR__ . '/includes/site-footer.php'; ?>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

    <script>
    // Contact form AJAX submission
    document.getElementById('contactForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = this;
        const loading = document.getElementById('loading');
        const sentMsg = document.getElementById('sentMsg');
        const errorMsg = document.getElementById('errorMsg');

        loading.style.display = 'block';
        sentMsg.style.display = 'none';
        errorMsg.style.display = 'none';

        try {
            const res = await fetch('<?= url('contact.php') ?>', {
                method: 'POST',
                body: new FormData(form)
            });
            const data = await res.json();
            loading.style.display = 'none';

            if (res.ok) {
                sentMsg.style.display = 'block';
                form.reset();
            } else {
                errorMsg.textContent = data.errors ? data.errors.join(', ') : 'Something went wrong.';
                errorMsg.style.display = 'block';
            }
        } catch (err) {
            loading.style.display = 'none';
            errorMsg.textContent = 'Network error. Please try again.';
            errorMsg.style.display = 'block';
        }
    });
    </script>
</body>

</html>