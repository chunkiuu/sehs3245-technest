<?php
/*
 * File:        includes/cart_functions.php
 * Team member: Chow Chun Kiu
 * Purpose:     Shared shopping cart code used by update_cart.php and place_order.php,
 *              so the quantity check is written only once.
 * Usage:       include 'includes/cart_functions.php'; after session.php and db.php.
 */

/*
 * Saves the quantities typed in the cart form ($_POST['quantity'][product_id])
 * into $_SESSION['cart']. Each quantity must be a whole number from 1 to the
 * product's current stock in the database.
 * A valid quantity is saved; an invalid one is left unchanged and reported.
 * Returns a list of error messages (an empty array when every quantity is valid).
 */
function updateCartQuantities($pdo)
{
    $errors = [];
    $stockStmt = $pdo->prepare('SELECT stock FROM products WHERE product_id = ?');

    foreach ($_SESSION['cart'] as $id => $item) {
        // Use the new quantity from the form; if it was not sent, keep the quantity already in the cart.
        // FILTER_VALIDATE_INT gives a whole number, or false for input such as "abc" or "1.5".
        $newQuantity = isset($_POST['quantity'][$id]) ? filter_var($_POST['quantity'][$id], FILTER_VALIDATE_INT) : $item['quantity'];

        $stockStmt->execute([$id]);
        $stock = (int)$stockStmt->fetchColumn();   // fetchColumn() returns the single value (the stock)

        if ($newQuantity === false || $newQuantity < 1 || $newQuantity > $stock) {
            $errors[] = 'The quantity of ' . $item['product_name'] . ' must be a whole number from 1 to ' . $stock . '.';
        } else {
            $_SESSION['cart'][$id]['quantity'] = $newQuantity;
        }
    }

    return $errors;
}
?>
