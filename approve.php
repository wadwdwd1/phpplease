<?php
require_once 'init.php';
if (!is_admin()) {
    header('Location: login.php'); exit;
}

$idx = isset($_GET['i']) ? intval($_GET['i']) : -1;
$pending = read_json_file(USER_PENDING_FILE);
if (!isset($pending[$idx])) {
    header('Location: admin.php'); exit;
}

$users = read_json_file(USERS_FILE);
$user = $pending[$idx];
$users[] = $user;
unset($pending[$idx]);

write_json_file(USERS_FILE, $users);
write_json_file(USER_PENDING_FILE, $pending);

header('Location: admin.php');
exit;
