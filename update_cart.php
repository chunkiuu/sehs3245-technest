<?php
/*
 * File:        update_cart.php
 * Team member: Chow Chun Kiu
 * Purpose:     Saves the quantities typed in the shopping cart, then goes back to the cart page.
 *              It runs when the user presses Enter in the cart (see the hidden default button
 *              at the top of the form in cart.php), so Enter updates the cart instead of
 *              removing a product.
 * Input:       POST quantity[product_id] for every product in the cart, plus customer_name and address
 * Output:      updates $_SESSION['cart'], $_SESSION['customer'] and $_SESSION['cart_message'],
 *              then redirects to cart.php
 */
include 'includes/session.php';
include 'includes/db.php';
include 'includes/cart_functions.php';

// Only accept the cart form (POST) with at least one product in the cart
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['cart'])) {
    header('Location: cart.php?' . SID);
    exit;
}

// 1. Keep the customer details typed so far, so they are still there when the cart page reloads
$_SESSION['customer'] = [
    'name'    => trim(isset($_POST['customer_name']) ? $_POST['customer_name'] : ''),
    'address' => trim(isset($_POST['address']) ? $_POST['address'] : ''),
];

// 2. Save the new quantities (each one is checked against the stock)
$errors = updateCartQuantities($pdo);

// 3. Tell the user what happened: the first problem, or that the cart was updated
$_SESSION['cart_message'] = empty($errors) ? 'Your cart has been updated.' : $errors[0];

// 4. Go back to the shopping cart page (SID keeps the session ID in the URL, no cookies)
header('Location: cart.php?' . SID);
exit;
?>
