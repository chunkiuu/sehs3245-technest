<?php
/*
 * File: thankyou.php
 * Owner: HTML (page layout) + PHP (saving the order) + SQL (INSERT statements)
 * Page 6: Thank-you page. Saves the products in $_SESSION['cart'] into MySQL
 * (orders + order_details tables), then shows a thank-you message.
 */
include 'includes/session.php';

include 'includes/db.php';

// Only accept an order sent by the Buy button, with something in the cart.
// (After an order the cart is empty, so refreshing this page cannot save the order twice.)
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['cart'])) {
    header('Location: cart.php?' . SID);
    exit;
}

// 1. Read and check the customer details
$customerName = trim(isset($_POST['customer_name']) ? $_POST['customer_name'] : '');
$address      = trim(isset($_POST['address']) ? $_POST['address'] : '');
$_SESSION['customer'] = ['name' => $customerName, 'address' => $address];

$errors = [];
if ($customerName === '' || mb_strlen($customerName) > 50) {
    $errors[] = 'Please enter your name (maximum 50 characters).';
}
if ($address === '' || mb_strlen($address) > 255) {
    $errors[] = 'Please enter your address (maximum 255 characters).';
}

// 2. Update the quantities typed in the cart, and check each one against the stock
$stockStmt = $pdo->prepare('SELECT stock FROM products WHERE product_id = ?');
$total = 0;

foreach ($_SESSION['cart'] as $id => $item) {
    $newQuantity = isset($_POST['quantity'][$id]) ? filter_var($_POST['quantity'][$id], FILTER_VALIDATE_INT) : $item['quantity'];
    $stockStmt->execute([$id]);
    $stock = (int)$stockStmt->fetchColumn();

    if ($newQuantity === false || $newQuantity < 1 || $newQuantity > $stock) {
        $errors[] = 'The quantity of ' . $item['product_name'] . ' must be a whole number from 1 to ' . $stock . '.';
    } else {
        $_SESSION['cart'][$id]['quantity'] = $newQuantity;
        $total += $item['unit_price'] * $newQuantity;
    }
}

// Something is wrong: go back to the cart and show the first problem
if (!empty($errors)) {
    $_SESSION['cart_message'] = $errors[0];
    header('Location: cart.php?' . SID);
    exit;
}

// 3. Save the order. A transaction makes sure orders and order_details are saved together:
//    if any INSERT fails, rollBack() cancels all of them.
try {
    $pdo->beginTransaction();

    $orderStmt = $pdo->prepare('INSERT INTO orders (customer_name, address, total_amount) VALUES (?, ?, ?)');
    $orderStmt->execute([$customerName, $address, $total]);
    $orderId = $pdo->lastInsertId();

    $detailStmt = $pdo->prepare('INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)');
    foreach ($_SESSION['cart'] as $item) {
        $detailStmt->execute([$orderId, $item['product_id'], $item['quantity'], $item['unit_price']]);
    }

    $pdo->commit();
} catch (PDOException $e) {
    $pdo->rollBack();
    $_SESSION['cart_message'] = 'Sorry, your order could not be saved. Please try again.';
    header('Location: cart.php?' . SID);
    exit;
}

// 4. The order is saved: show the order reference (e.g. TN-000001) and empty the cart
$orderRef = 'TN-' . str_pad($orderId, 6, '0', STR_PAD_LEFT);
unset($_SESSION['cart'], $_SESSION['customer']);

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

        <!-- Order reference, set by the PHP code above -->
        <p class="order-reference">
            Order reference:
            <strong><?php echo htmlspecialchars($orderRef); ?></strong>
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
