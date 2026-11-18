<?php
/*
 * File:    includes/db.php
 * Author:  Chow Chun Kiu
 * Purpose: Connects to the shop_db MySQL database using PDO.
 * Usage:   include 'includes/db.php'; then run SQL with the $pdo object.
 *
 * XAMPP's default MySQL account is user "root" with no password.
 * charset=utf8mb4 lets the database store any text, including Chinese names.
 */
$pdo = new PDO('mysql:host=localhost;dbname=shop_db;charset=utf8mb4', 'root', '');

// If an SQL statement fails, stop with an error (exception) instead of failing silently
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
