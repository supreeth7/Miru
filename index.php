<?php
$title = 'Home';
require_once "./includes/header.php";

if (!isset($_SESSION["is_loggedIn"])) {
    header("Location: login.php");
}

$username = $_SESSION["is_loggedIn"];

$preview = new PreviewProvider($db, $username);

echo $preview->createPreviewVideo(null);
