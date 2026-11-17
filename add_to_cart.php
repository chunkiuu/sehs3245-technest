<?php
/*
 * File: add_to_cart.php
 * Owner: D
 * Receives product_id + quantity from a shopping page form and adds it to $_SESSION['cart'].
 * See the $_SESSION['cart'] format at the top of cart.php.
 */
session_start();

// TODO (D): read $_POST['product_id'] and $_POST['quantity'], validate them, look up the product name and price (from the products table), then add or increase the item in $_SESSION['cart'].

// Go back to the shopping cart page after the change
header('Location: cart.php');
exit;
?>
