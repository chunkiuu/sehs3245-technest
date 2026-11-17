<?php
/*
 * File: remove_from_cart.php
 * Owner: D
 * Receives product_id from cart.php and removes that item from the cart.
 * See the $_SESSION['cart'] format at the top of cart.php.
 */
session_start();

// TODO (D): unset($_SESSION['cart'][$_POST['product_id']]).

// Go back to the shopping cart page after the change
header('Location: cart.php');
exit;
?>
