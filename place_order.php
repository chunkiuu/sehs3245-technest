<?php
/*
 * File:        place_order.php
 * Team member: Chow Chun Kiu
 * Purpose:     Checks the order and saves it into MySQL, then shows the thank-you page.
 * Input:       POST from the "Buy" button in cart.php:
 *                customer_name, address, and quantity[product_id] for every product in the cart
 * Output:      one new row in the orders table, one row per product in the order_details table,
 *              the stock of each product reduced in the products table, then a redirect to thankyou.php
 *
 * Post/Redirect/Get: this file only saves the order and then redirects. The thank-you page is
 * loaded separately, so refreshing it cannot send (and save) the same order a second time.
 */
include 'includes/session.php';
include 'includes/db.php';

// Only accept an order sent by the Buy button (POST) with at least one product in the cart
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['cart'])) {
    header('Location: cart.php?' . SID);
    exit;
}

// 1. Read and check the customer details.
//    trim() removes spaces at both ends. mb_strlen() counts characters correctly, including Chinese.
//    The maximum lengths match the orders table: customer_name VARCHAR(50), address VARCHAR(255).
$customerName = trim(isset($_POST['customer_name']) ? $_POST['customer_name'] : '');
$address      = trim(isset($_POST['address']) ? $_POST['address'] : '');

// Keep what the user typed, so cart.php can fill the form in again if there is an error
$_SESSION['customer'] = ['name' => $customerName, 'address' => $address];

$errors = [];
if ($customerName === '' || mb_strlen($customerName) > 50) {
    $errors[] = 'Please enter your name (maximum 50 characters).';
}
if ($address === '' || mb_strlen($address) > 255) {
    $errors[] = 'Please enter your address (maximum 255 characters).';
}

// 2. Use the quantities typed in the cart, check each one against the stock, and add up the total
$stockStmt = $pdo->prepare('SELECT stock FROM products WHERE product_id = ?');
$total = 0;

foreach ($_SESSION['cart'] as $id => $item) {
    // Use the new quantity from the form; if it was not sent, keep the quantity already in the cart
    $newQuantity = isset($_POST['quantity'][$id]) ? filter_var($_POST['quantity'][$id], FILTER_VALIDATE_INT) : $item['quantity'];

    $stockStmt->execute([$id]);
    $stock = (int)$stockStmt->fetchColumn();   // fetchColumn() returns the single value (the stock)

    if ($newQuantity === false || $newQuantity < 1 || $newQuantity > $stock) {
        $errors[] = 'The quantity of ' . $item['product_name'] . ' must be a whole number from 1 to ' . $stock . '.';
    } else {
        $_SESSION['cart'][$id]['quantity'] = $newQuantity;
        $total += $item['unit_price'] * $newQuantity;
    }
}

// If anything is wrong, go back to the cart and show the first problem (nothing is saved)
if (!empty($errors)) {
    $_SESSION['cart_message'] = $errors[0];
    header('Location: cart.php?' . SID);
    exit;
}

// 3. Save the order and reduce the stock, using prepared statements (? placeholders prevent SQL injection).
//    A transaction treats all these SQL statements as one job: commit() saves everything together,
//    and if anything fails, rollBack() cancels all of them, so no half-saved order is left.
try {
    $pdo->beginTransaction();

    // One row in orders; lastInsertId() gives the new order_id created by AUTO_INCREMENT
    $orderStmt = $pdo->prepare('INSERT INTO orders (customer_name, address, total_amount) VALUES (?, ?, ?)');
    $orderStmt->execute([$customerName, $address, $total]);
    $orderId = $pdo->lastInsertId();

    // For each product: one row in order_details (linked to the order by order_id),
    // then take the quantity bought away from the stock.
    // "AND stock >= ?" makes sure the stock never goes below 0: if someone else has just bought
    // the last units, no row is updated (rowCount() is 0) and the whole order is cancelled.
    $detailStmt = $pdo->prepare('INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)');
    $stockStmt  = $pdo->prepare('UPDATE products SET stock = stock - ? WHERE product_id = ? AND stock >= ?');
    foreach ($_SESSION['cart'] as $item) {
        $detailStmt->execute([$orderId, $item['product_id'], $item['quantity'], $item['unit_price']]);

        $stockStmt->execute([$item['quantity'], $item['product_id'], $item['quantity']]);
        if ($stockStmt->rowCount() === 0) {
            throw new Exception('Sorry, there is not enough stock of ' . $item['product_name'] . ' left. Please change the quantity.');
        }
    }

    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollBack();

    // Show our own stock message; for a database error show a general message instead
    if ($e instanceof PDOException) {
        $_SESSION['cart_message'] = 'Sorry, your order could not be saved. Please try again.';
    } else {
        $_SESSION['cart_message'] = $e->getMessage();
    }
    header('Location: cart.php?' . SID);
    exit;
}

// 4. The order is saved.
//    Remember its ID in the session, so only this customer can see it on the thank-you page,
//    then empty the cart and the saved customer details.
$_SESSION['last_order_id'] = $orderId;
unset($_SESSION['cart'], $_SESSION['customer']);

header('Location: thankyou.php?' . SID);
exit;
?>
