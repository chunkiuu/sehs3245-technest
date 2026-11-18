<?php
/*
 * File:    remove_from_cart.php
 * Author:  Chow Chun Kiu
 * Purpose: Removes one product from the shopping cart, then goes back to the cart page.
 * Input:   POST remove_id (the product ID), sent by the "Remove" button in cart.php
 * Output:  updates $_SESSION['cart'] and $_SESSION['cart_message'], then redirects to cart.php
 */
include 'includes/session.php';

// 1. Read which product to remove
$removeId = isset($_POST['remove_id']) ? $_POST['remove_id'] : '';

// 2. Remove it only if it is really in the cart, and prepare a message for the cart page
if (isset($_SESSION['cart'][$removeId])) {
    $_SESSION['cart_message'] = $_SESSION['cart'][$removeId]['product_name'] . ' has been removed from your cart.';
    unset($_SESSION['cart'][$removeId]);
}

// 3. Go back to the shopping cart page (SID keeps the session ID in the URL, no cookies)
header('Location: cart.php?' . SID);
exit;
?>
