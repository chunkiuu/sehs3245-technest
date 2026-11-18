<?php
/*
 * File: thankyou.php
 * Owner: HTML (page layout) + PHP (loading the order) + SQL (SELECT ... JOIN)
 * Page 6: Thank-you page. Shows a summary of the order just saved by place_order.php.
 * The summary is read back from MySQL, which shows the order really is in the database.
 */
include 'includes/session.php';
include 'includes/db.php';

// Only show the order saved in this customer's own session (not an order ID from the URL),
// so nobody can view another customer's name and address
if (!isset($_SESSION['last_order_id'])) {
    header('Location: cart.php?' . SID);
    exit;
}
$orderId = $_SESSION['last_order_id'];

// 1. Load the order (customer, address, total, date)
$orderStmt = $pdo->prepare('SELECT customer_name, address, total_amount, order_date FROM orders WHERE order_id = ?');
$orderStmt->execute([$orderId]);
$order = $orderStmt->fetch(PDO::FETCH_ASSOC);

// 2. Load the products in the order. JOIN gets the product name from the products table.
$itemsStmt = $pdo->prepare(
    'SELECT p.product_name, d.price, d.quantity
     FROM order_details d
     JOIN products p ON d.product_id = p.product_id
     WHERE d.order_id = ?
     ORDER BY d.detail_id'
);
$itemsStmt->execute([$orderId]);
$items = $itemsStmt->fetchAll(PDO::FETCH_ASSOC);

// Order reference shown to the customer, e.g. TN-000001
$orderRef = 'TN-' . str_pad($orderId, 6, '0', STR_PAD_LEFT);

$pageTitle = 'Thank You';
include 'includes/header.php';
?>

    <!-- Main thank-you section -->
    <main class="thank-you-section">
        <h1>Thank You for Shopping with TechNest, <?php echo htmlspecialchars($order['customer_name']); ?>!</h1>

        <p>
            Your order has been received successfully.
            The products or service plans you selected have been stored in our database.
        </p>

        <!-- Order details, loaded from the orders table -->
        <dl class="order-info">
            <dt>Order reference</dt>
            <dd class="order-reference"><strong><?php echo htmlspecialchars($orderRef); ?></strong></dd>
            <dt>Order date</dt>
            <dd><?php echo date('j M Y, H:i', strtotime($order['order_date'])); ?></dd>
            <dt>Deliver to</dt>
            <dd><?php echo nl2br(htmlspecialchars($order['address'])); ?></dd>
        </dl>

        <!-- Products in the order, loaded from the order_details table -->
        <table class="cart-table order-summary">
            <thead>
                <tr>
                    <th scope="col">Product / Service Plan</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
<?php foreach ($items as $item) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                    <td>HK$<?php echo number_format($item['price'], 2); ?></td>
                    <td><?php echo (int)$item['quantity']; ?></td>
                    <td>HK$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                </tr>
<?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th scope="row" colspan="3">Total</th>
                    <td>HK$<?php echo number_format($order['total_amount'], 2); ?></td>
                </tr>
            </tfoot>
        </table>

        <p>
            We appreciate your support and hope to see you again soon.
        </p>

        <div class="page-actions">
            <a href="index.php" class="button">Back to Home</a>
            <a href="shop1.php" class="button">Continue Shopping</a>
        </div>
    </main>

<?php include 'includes/footer.php'; ?>
