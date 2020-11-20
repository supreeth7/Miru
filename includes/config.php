<?php

ob_start(); //Turns on output buffering during live deployment

session_start();

date_default_timezone_set("Asia/Kolkata");

$host = "localhost";
$database = "miru";
$username = "root";
$password = "admin1234*";

try {
    $db = new PDO("mysql:dbname=$database;host=$host", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
    exit("Connection failed. " . $e->getMessage());
}
