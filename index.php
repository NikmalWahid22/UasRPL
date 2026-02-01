<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Asia/Jakarta');

// BASE PATH = public_html
define('BASE_PATH', __DIR__);

// load config
require_once BASE_PATH . '/config/config.php';

// load routes
require_once BASE_PATH . '/routes/web.php';
