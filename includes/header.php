<?php

require_once "config.php";
require_once "classes/Entity.php";
require_once "classes/PreviewProvider.php";


if (!isset($_SESSION["is_loggedIn"])) {
    header("Location: login.php");
}

$username = $_SESSION["is_loggedIn"];?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?>
    </title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;900&display=swap"
        rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/icons/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/icons/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/icons/favicon/favicon-16x16.png">
    <link rel="manifest" href="../assets/icons/favicon/site.webmanifest">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>