<?php
/*
 * File: remove_from_cart.php
 * Author: Chow Chun Kiu
 * Receives remove_id (the product_id) from the Remove button in cart.php
 * and removes that item from the cart.
 * See the $_SESSION['cart'] format at the top of cart.php.
 */
include 'includes/session.php';

$removeId = isset($_POST['remove_id']) ? $_POST['remove_id'] : '';

if (isset($_SESSION['cart'][$removeId])) {
    $_SESSION['cart_message'] = $_SESSION['cart'][$removeId]['product_name'] . ' has been removed from your cart.';
    unset($_SESSION['cart'][$removeId]);
}

// Go back to the shopping cart page. SID keeps the session ID in the URL (no cookies).
header('Location: cart.php?' . SID);
exit;
?>
