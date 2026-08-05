<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Logout
 * Description : Destroy session and redirect to login
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';

logout();
redirect('admin/index.php');