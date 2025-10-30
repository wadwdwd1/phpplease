<?php
require_once 'init.php';
if (!is_admin()) {
    header('Location: login.php'); exit;
}

$idx = isset($_GET['i']) ? intval($_GET['i']) : -1;
$pending = read_json_file(USER_PENDING_FILE);

if (isset($pending[$idx])) {
    unset($pending[$idx]);
    write_json_file(USER_PENDING_FILE, $pending);
}

header('Location: admin.php');
exit;
