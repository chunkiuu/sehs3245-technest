<?php
/*
 * File: thankyou.php
 * Owner: E
 * Page 6: Thank-you page. Saves the products in $_SESSION['cart'] into MySQL
 * (orders + order_details tables), then shows a thank-you message.
 */
session_start();

// TODO (E): if the cart is not empty:
//   0. update each item's quantity from $_POST['quantity'] (array: product_id => quantity,
//      sent by the Buy button in cart.php); check each value is a whole number >= 1
//   1. include 'includes/db.php';
//   2. INSERT one row into orders, get the new id with $pdo->lastInsertId()
//   3. INSERT one row into order_details for each item in $_SESSION['cart']
//   4. set $orderRef (e.g. 'TN-' . $orderId), then unset($_SESSION['cart'])
// Use prepared statements ($pdo->prepare / execute) for user input.

$pageTitle = 'Thank You';
include 'includes/header.php';
?>

    <!-- Main thank-you section -->
    <main class="thank-you-section">
        <h1>Thank You for Shopping with TechNest!</h1>

        <p>
            Your order has been received successfully.
            The products or service plans you selected have been stored in our database.
        </p>

        <!-- Order reference ($orderRef is set by the TODO code above) -->
        <p class="order-reference">
            Order reference:
            <strong><?php echo isset($orderRef) ? htmlspecialchars($orderRef) : 'TN-000000'; ?></strong>
        </p>

        <p>
            We appreciate your support and hope to see you again soon.
        </p>

        <div class="page-actions">
            <a href="index.php" class="button">Back to Home</a>
            <a href="shop1.php" class="button">Continue Shopping</a>
        </div>
    </main>

<?php include 'includes/footer.php'; ?>
