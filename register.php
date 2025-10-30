<?php
require_once 'init.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($username === '' || $password === '' || $email === '') {
        $errors[] = "All fields are required.";
    } else {
        $users = read_json_file(USERS_FILE);
        $pending = read_json_file(USER_PENDING_FILE);

        $exists = false;
        foreach (array_merge($users, $pending) as $u) {
            if (strtolower($u['username']) === strtolower($username) ||
                strtolower($u['email']) === strtolower($email)) {
                $exists = true;
                break;
            }
        }

        if ($exists) {
            $errors[] = "Username or email already exists.";
        } else {
            $pending[] = [
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'role' => 'user',
                'requested_at' => date('c')
            ];
            write_json_file(USER_PENDING_FILE, $pending);
            $success = "Registration submitted — waiting for admin approval.";
        }
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Register</title>
<style>
body{font-family:Arial;padding:20px}
.form{max-width:420px;margin:auto}
input{width:100%;padding:8px;margin:6px 0}
button{padding:8px 12px}
.error{color:#b00020}
.success{color:#006600}
</style>
</head>
<body>
<div class="form">
  <h2>Register</h2>
  <?php if($errors): ?><div class="error"><?=implode('<br>', $errors)?></div><?php endif; ?>
  <?php if($success): ?><div class="success"><?=htmlspecialchars($success)?></div><?php endif; ?>
  <form method="post">
    <label>Username</label><input name="username" required>
    <label>Email</label><input name="email" type="email" required>
    <label>Password</label><input name="password" type="password" required>
    <button type="submit">Register</button>
  </form>
  <p><a href="login.php">Back to login</a></p>
</div>
</body>
</html>
