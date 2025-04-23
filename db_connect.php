<?php
// db_connect.php
ini_set('display_errors', 0);
error_reporting(E_ALL);

// XAMPP default credentials
$db_host = 'localhost';
$db_user = 'root';          // Default XAMPP username
$db_pass = '';              // Default XAMPP password (empty)
$db_name = 'travelbuddy';   // Make sure this matches your database name

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_errno) {
    error_log("FATAL DB Connection Error: ({$mysqli->connect_errno}) {$mysqli->connect_error}");
    die("Database connection error. Please try again later.");
}

if (!$mysqli->set_charset('utf8mb4')) {
    error_log("Error setting character set utf8mb4: " . $mysqli->error);
}
?>