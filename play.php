<?php
require_once 'init.php';
require_login();
$user = $_SESSION['user'];
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Play</title></head>
<body style="font-family:Arial;padding:20px">
<h2>Welcome to the Play Page, <?=htmlspecialchars($user['username'])?></h2>
<p>This page is only accessible to logged-in users.</p>

<!-- You can add your game, content, or interactive features here -->
<p>[Your game or play content goes here]</p>

<p><a href="dashboard.php">Back to Dashboard</a> | <a href="logout.php">Logout</a></p>
</body>
</html>
