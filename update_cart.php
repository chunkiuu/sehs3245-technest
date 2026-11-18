<?php
/*
 * File: update_cart.php
 * Owner: PHP
 * Changes the quantity of one item in the cart (receives product_id + quantity).
 * Note: cart.php no longer has an Update button; the edited quantities are sent
 * to thankyou.php with the Buy button. Keep this file only if the group adds an
 * Update button back (e.g. <button formaction="update_cart.php">).
 * See the $_SESSION['cart'] format at the top of cart.php.
 */
include 'includes/session.php';

// TODO (PHP, only if an Update button is added back): validate $_POST['quantity'] (whole number >= 1) and update $_SESSION['cart'][$_POST['product_id']]['quantity'].

// Go back to the shopping cart page after the change
header('Location: cart.php?' . SID);
exit;
?>
