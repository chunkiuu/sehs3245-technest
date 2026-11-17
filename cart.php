<?php
/*
 * File: cart.php
 * Owner: E
 * Page 5: Shopping cart. Lists the products stored in $_SESSION['cart'],
 * lets the user update or remove them, and has a "Buy" button.
 *
 * $_SESSION['cart'] format (written by D in add_to_cart.php):
 *   $_SESSION['cart']['P101'] = ['product_id' => 'P101', 'product_name' => 'Nova X1 Smartphone',
 *                                'unit_price' => 4999.00, 'quantity' => 2];
 */
session_start();
$pageTitle = 'Shopping Cart';
include 'includes/header.php';

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
?>

    <main>
        <h1>Your Shopping Cart</h1>

<?php if (empty($cart)) { ?>
        <p class="empty-cart-message">
            Your shopping cart is empty.
            <a href="shop1.php">Continue shopping</a>.
        </p>
<?php } else { ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th scope="col">Product / Service Plan</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
<?php
    foreach ($cart as $item) {
        $id = htmlspecialchars($item['product_id']);
        $subtotal = $item['unit_price'] * $item['quantity'];
        $total += $subtotal;
?>
                <tr>
                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                    <td>HK$<?php echo number_format($item['unit_price'], 2); ?></td>
                    <td>
                        <form action="update_cart.php" method="post" class="update-cart-form">
                            <input type="hidden" name="product_id" value="<?php echo $id; ?>" />
                            <label for="update-qty-<?php echo $id; ?>">Qty:</label>
                            <input type="number" id="update-qty-<?php echo $id; ?>" name="quantity" class="qty-input" min="1" step="1" value="<?php echo (int)$item['quantity']; ?>" required="required" />
                            <button type="submit" class="button small-button">Update</button>
                        </form>
                    </td>
                    <td>HK$<?php echo number_format($subtotal, 2); ?></td>
                    <td>
                        <form action="remove_from_cart.php" method="post" class="remove-cart-form">
                            <input type="hidden" name="product_id" value="<?php echo $id; ?>" />
                            <button type="submit" class="button small-button remove-button">Remove</button>
                        </form>
                    </td>
                </tr>
<?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th scope="row" colspan="3">Total</th>
                    <td>HK$<?php echo number_format($total, 2); ?></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
<?php } ?>

        <div class="cart-actions">
            <a href="shop1.php" class="button">Shop Smartphones &amp; Wearables</a>
            <a href="shop2.php" class="button">Shop Computers &amp; Displays</a>
            <a href="shop3.php" class="button">Shop Accessories &amp; Smart Home</a>

<?php if (!empty($cart)) { ?>
            <!-- TODO (E + C): add customer name / address fields here; orders table needs them -->
            <form action="thankyou.php" method="post" class="buy-form">
                <button type="submit" class="button buy-button">Buy</button>
            </form>
<?php } ?>
        </div>
    </main>

<?php include 'includes/footer.php'; ?>
