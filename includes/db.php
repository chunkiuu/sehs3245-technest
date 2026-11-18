<?php
/*
 * File: includes/db.php
 * Author: Chow Chun Kiu
 * Connects to the shop_db MySQL database (XAMPP default: user "root", no password).
 * Usage: include 'includes/db.php'; then use $pdo.
 */
$pdo = new PDO('mysql:host=localhost;dbname=shop_db;charset=utf8mb4', 'root', '');

// Throw an exception when an SQL statement fails, so errors are not silently ignored
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
