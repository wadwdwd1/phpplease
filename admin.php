<?php
require_once 'init.php';
if (!is_admin()) {
    header('Location: login.php');
    exit;
}

$pending = read_json_file(USER_PENDING_FILE);
$users = read_json_file(USERS_FILE);
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Admin Panel</title>
<style>
body{font-family:Arial;padding:20px}
table{border-collapse:collapse;width:100%}
td,th{border:1px solid #ddd;padding:8px}
a.btn{display:inline-block;padding:6px 10px;margin-right:6px;text-decoration:none;border:1px solid #444;border-radius:4px}
</style>
</head>
<body>
  <h2>Admin Panel</h2>
  <p>Logged in as <strong><?=htmlspecialchars($_SESSION['user']['username'])?></strong></p>

  <h3>Pending Registrations</h3>
  <?php if (empty($pending)): ?>
    <p>No pending registrations.</p>
  <?php else: ?>
    <table>
      <tr><th>Username</th><th>Email</th><th>Requested At</th><th>Actions</th></tr>
      <?php foreach ($pending as $idx => $p): ?>
        <tr>
          <td><?=htmlspecialchars($p['username'])?></td>
          <td><?=htmlspecialchars($p['email'])?></td>
          <td><?=htmlspecialchars($p['requested_at'] ?? '')?></td>
          <td>
            <a class="btn" href="approve.php?i=<?=$idx?>">Approve</a>
            <a class="btn" href="reject.php?i=<?=$idx?>" onclick="return confirm('Are you sure you want to delete this user?')">Reject/Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif; ?>

  <h3>Approved Users</h3>
  <table>
    <tr><th>Username</th><th>Email</th><th>Role</th></tr>
    <?php foreach ($users as $u): ?>
      <tr>
        <td><?=htmlspecialchars($u['username'])?></td>
        <td><?=htmlspecialchars($u['email'] ?? '')?></td>
        <td><?=htmlspecialchars($u['role'] ?? 'user')?></td>
      </tr>
    <?php endforeach; ?>
  </table>

  <p><a href="dashboard.php">Back to Dashboard</a> | <a href="logout.php">Logout</a></p>
</body>
</html>
