<?php

require_once "./includes/config.php";
require_once "./includes/classes/PreviewProvider.php";


if (!isset($_SESSION["is_loggedIn"])) {
    header("Location: login.php");
}

$username = $_SESSION["is_loggedIn"];

$preview = new PreviewProvider($db, $username);

$preview->createPreviewVideo("");
