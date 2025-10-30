<?php
session_start();

define('USERS_FILE', __DIR__ . '/users.json');
define('ADMIN_FILE', __DIR__ . '/admin.json');
define('USER_PENDING_FILE', __DIR__ . '/user_pending.json');

function read_json_file($file) {
    if (!file_exists($file)) {
        file_put_contents($file, json_encode([]), LOCK_EX);
    }
    $data = file_get_contents($file);
    $decoded = json_decode($data, true);
    return $decoded;
}

function write_json_file($file, $arr) {
    file_put_contents($file, json_encode($arr, JSON_PRETTY_PRINT), LOCK_EX);
}

function is_logged_in() {
    return isset($_SESSION['user']);
}

function require_login() {
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function is_admin() {
    return is_logged_in() && $_SESSION['user']['role'] === 'admin';
}
