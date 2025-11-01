<?php
require_once 'init.php';
require_login();
$user = $_SESSION['user'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Play</title>
<style>
html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow: hidden;
}
iframe {
    border: none;
    width: 100%;
    height: 100%;
}
</style>
</head>
<body>
<iframe src="https://example.com" allowfullscreen></iframe>
</body>
</html>
