<?php
define('BASE_URL', 'http://localhost/vastbook');
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/vastbook');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();


$conn = [
    'host' => 'localhost',
    'db' => 'vastbook',
    'user' => 'mike',
    'pass' => 'mike',
    'charset' => 'utf8mb4',
];