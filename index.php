<?php
$title = 'Home';
require_once "./includes/header.php";

$preview = new PreviewProvider($db, $username);

echo $preview->createPreviewVideo(null);
