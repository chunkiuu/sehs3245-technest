<?php
/*
 * File: add_to_cart.php
 * Author: Chow Chun Kiu
 * Receives product_id + quantity from a shopping page form and adds it to $_SESSION['cart'].
 * See the $_SESSION['cart'] format at the top of cart.php.
 */
include 'includes/session.php';
include 'includes/db.php';

// 1. Read the form data
$productId = isset($_POST['product_id']) ? $_POST['product_id'] : '';
$quantity  = filter_var(isset($_POST['quantity']) ? $_POST['quantity'] : '', FILTER_VALIDATE_INT);

// 2. Look up the product in the database.
//    The name and price come from the database, not from the form, because users can edit the HTML.
$stmt = $pdo->prepare('SELECT product_id, product_name, price, stock FROM products WHERE product_id = ?');
$stmt->execute([$productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    $_SESSION['cart_message'] = 'Sorry, this product could not be found.';
} elseif ($quantity === false || $quantity < 1) {
    $_SESSION['cart_message'] = 'Please enter a whole number of 1 or more.';
} else {
    // 3. Add to the quantity already in the cart (0 if this product is not in the cart yet)
    $inCart = isset($_SESSION['cart'][$productId]) ? $_SESSION['cart'][$productId]['quantity'] : 0;
    $newQuantity = $inCart + $quantity;

    // 4. The quantity cannot be more than the available stock
    if ($newQuantity > $product['stock']) {
        $newQuantity = (int)$product['stock'];
        $_SESSION['cart_message'] = 'Only ' . $product['stock'] . ' units of ' . $product['product_name']
            . ' are available, so the quantity has been set to ' . $newQuantity . '.';
    } else {
        $_SESSION['cart_message'] = $product['product_name'] . ' has been added to your cart.';
    }

    // 5. Save the item in the session cart
    $_SESSION['cart'][$productId] = [
        'product_id'   => $product['product_id'],
        'product_name' => $product['product_name'],
        'unit_price'   => (float)$product['price'],
        'quantity'     => $newQuantity,
    ];
}

// Go back to the shopping cart page. SID keeps the session ID in the URL (no cookies).
header('Location: cart.php?' . SID);
exit;
?>
