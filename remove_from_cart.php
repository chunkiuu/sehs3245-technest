<?php
/*
 * File: remove_from_cart.php
 * Owner: D
 * Receives remove_id (the product_id) from the Remove button in cart.php
 * and removes that item from the cart.
 * See the $_SESSION['cart'] format at the top of cart.php.
 */
session_start();

// TODO (D): unset($_SESSION['cart'][$_POST['remove_id']]).

// Go back to the shopping cart page after the change
header('Location: cart.php');
exit;
?>
