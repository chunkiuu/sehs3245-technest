<?php
/*
 * File:    add_to_cart.php
 * Author:  Chow Chun Kiu
 * Purpose: Adds a product to the shopping cart, then goes to the cart page.
 * Input:   POST product_id and quantity, sent by the "Add to Cart" form on shop1/2/3.php
 * Output:  updates $_SESSION['cart'] and $_SESSION['cart_message'], then redirects to cart.php
 *
 * The cart is stored in the session (no cookies). One entry per product, using the product ID as the key:
 *   $_SESSION['cart'][101] = ['product_id' => 101, 'product_name' => 'Nova X1 Smartphone',
 *                             'unit_price' => 4999.00, 'quantity' => 2];
 */
include 'includes/session.php';
include 'includes/db.php';

// 1. Read the form data.
//    FILTER_VALIDATE_INT gives a whole number, or false if the input is not one (e.g. "abc" or "1.5").
$productId = isset($_POST['product_id']) ? $_POST['product_id'] : '';
$quantity  = filter_var(isset($_POST['quantity']) ? $_POST['quantity'] : '', FILTER_VALIDATE_INT);

// 2. Find the product in the database.
//    The name and price are taken from the database, not from the form, because a user could edit the HTML.
//    The ? placeholder (prepared statement) keeps user input separate from the SQL, which prevents SQL injection.
$stmt = $pdo->prepare('SELECT product_id, product_name, price, stock FROM products WHERE product_id = ?');
$stmt->execute([$productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);   // one row as an array, or false if not found

// 3. Check the input, then add the product to the cart
if (!$product) {
    $_SESSION['cart_message'] = 'Sorry, this product could not be found.';
} elseif ($quantity === false || $quantity < 1) {
    $_SESSION['cart_message'] = 'Please enter a whole number of 1 or more.';
} else {
    // If the product is already in the cart, add to that quantity (otherwise start from 0)
    $inCart = isset($_SESSION['cart'][$productId]) ? $_SESSION['cart'][$productId]['quantity'] : 0;
    $newQuantity = $inCart + $quantity;

    // The total quantity cannot be more than the stock, so limit it and tell the user
    if ($newQuantity > $product['stock']) {
        $newQuantity = (int)$product['stock'];
        $_SESSION['cart_message'] = 'Only ' . $product['stock'] . ' units of ' . $product['product_name']
            . ' are available, so the quantity has been set to ' . $newQuantity . '.';
    } else {
        $_SESSION['cart_message'] = $product['product_name'] . ' has been added to your cart.';
    }

    // Save (or replace) this product's entry in the cart
    $_SESSION['cart'][$productId] = [
        'product_id'   => $product['product_id'],
        'product_name' => $product['product_name'],
        'unit_price'   => (float)$product['price'],
        'quantity'     => $newQuantity,
    ];
}

// 4. Go to the shopping cart page.
//    SID is a PHP constant like "PHPSESSID=abc123", so the session ID stays in the URL (no cookies).
//    exit stops the script straight after the redirect.
header('Location: cart.php?' . SID);
exit;
?>
