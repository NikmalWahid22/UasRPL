<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

if (!defined('BASE_URL')) {
    define('BASE_URL', 'https://onelibrary.my.id');
}

if (!defined('APP_NAME')) {
    define('APP_NAME', 'Sistem Informasi Perpustakaan');
}

if (!defined('APP_ENV')) {
    define('APP_ENV', 'development');
}
