<?php
/*
 * File: update_cart.php
 * Owner: D
 * Receives product_id + quantity from cart.php and changes the quantity of that item.
 * See the $_SESSION['cart'] format at the top of cart.php.
 */
session_start();

// TODO (D): validate $_POST['quantity'] (whole number >= 1) and update $_SESSION['cart'][$_POST['product_id']]['quantity'].

// Go back to the shopping cart page after the change
header('Location: cart.php');
exit;
?>
