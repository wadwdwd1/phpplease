<?php
require_once 'init.php';
require_login();
$user = $_SESSION['user'];
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Dashboard</title></head>
<body style="font-family:Arial;padding:20px">
  <h2>Welcome, <?=htmlspecialchars($user['username'])?></h2>
  <p>Email: <?=htmlspecialchars($user['email'] ?? '')?></p>
  <p>Role: <?=htmlspecialchars($user['role'] ?? 'user')?></p>

  <?php if (is_admin()): ?>
    <p><a href="admin.php">Open Admin Panel</a></p>
  <?php endif; ?>

  <p><a href="logout.php">Logout</a></p>
</body>
</html>
