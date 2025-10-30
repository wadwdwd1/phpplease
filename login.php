<?php
require_once 'init.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Check admin.json
    $admin = read_json_file(ADMIN_FILE);
    if (isset($admin['username']) && strtolower($username) === strtolower($admin['username']) && $password === $admin['password']) {
        $_SESSION['user'] = $admin;
        header('Location: dashboard.php');
        exit;
    }

    // Check users.json
    $users = read_json_file(USERS_FILE);
    $found = null;
    foreach ($users as $u) {
        if (strtolower($u['username']) === strtolower($username) && $u['password'] === $password) {
            $found = $u;
            break;
        }
    }

    if ($found) {
        $_SESSION['user'] = $found;
        header('Location: dashboard.php');
        exit;
    } else {
        $errors[] = "Invalid username or password, or account not approved yet.";
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login</title>
<style>
body{font-family:Arial;padding:20px}
.form{max-width:420px;margin:auto}
input{width:100%;padding:8px;margin:6px 0}
button{padding:8px 12px}
.error{color:#b00020}
</style>
</head>
<body>
<div class="form">
  <h2>Login</h2>
  <?php if($errors): ?><div class="error"><?=implode('<br>', $errors)?></div><?php endif; ?>
  <form method="post">
    <label>Username</label><input name="username" required>
    <label>Password</label><input name="password" type="password" required>
    <button type="submit">Login</button>
  </form>
  <p><a href="register.php">Register</a></p>
</div>
</body>
</html>
