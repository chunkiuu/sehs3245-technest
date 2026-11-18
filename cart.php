<?php
/*
 * File: cart.php
 * Owner: HTML (page layout) + PHP (cart logic)
 * Page 5: Shopping cart. Lists the products stored in $_SESSION['cart'].
 * The table and the Buy button are wrapped in a single form, so the latest
 * quantities are sent to place_order.php when the user clicks "Buy".
 *
 * $_SESSION['cart'] format (written in add_to_cart.php):
 *   $_SESSION['cart']['P101'] = ['product_id' => 'P101', 'product_name' => 'Nova X1 Smartphone',
 *                                'unit_price' => 4999.00, 'quantity' => 2];
 */
// Start session tracking.
include 'includes/session.php';
$pageTitle = 'Shopping Cart';
include 'includes/header.php';

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;

// A message from add_to_cart.php, remove_from_cart.php or place_order.php (shown once, then deleted)
$message = isset($_SESSION['cart_message']) ? $_SESSION['cart_message'] : '';
unset($_SESSION['cart_message']);

// Customer details typed before, so the user does not need to type them again after an error
$customerName = isset($_SESSION['customer']['name']) ? $_SESSION['customer']['name'] : '';
$address      = isset($_SESSION['customer']['address']) ? $_SESSION['customer']['address'] : '';
?>

    <main>
        <h1>Your Shopping Cart</h1>

<?php if ($message !== '') { ?>
        <p class="cart-message"><?php echo htmlspecialchars($message); ?></p>
<?php } ?>

<?php if (empty($cart)) { ?>
        <p class="empty-cart-message">
            Your shopping cart is empty.
            <a href="shop1.php">Continue shopping</a>.
        </p>
<?php } else { ?>
        <!--
            Wrap the table and Buy button in a single form.
            When the user clicks "Buy", the latest quantities will be sent to place_order.php.
        -->
        <form action="place_order.php" method="post" id="checkout-form">

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
                            <label for="qty-<?php echo $id; ?>">Qty:</label>
                            <!--
                                name="quantity[product_id]" allows PHP to receive an array of quantities.
                                data-price is used for JavaScript to know the unit price.
                            -->
                            <input type="number"
                                   id="qty-<?php echo $id; ?>"
                                   name="quantity[<?php echo $id; ?>]"
                                   class="qty-input real-time-qty"
                                   min="1"
                                   step="1"
                                   value="<?php echo (int)$item['quantity']; ?>"
                                   data-price="<?php echo $item['unit_price']; ?>"
                                   required="required" />
                        </td>
                        <!-- Span IDs are used by JavaScript to update the subtotal dynamically -->
                        <td>HK$<span id="subtotal-<?php echo $id; ?>" class="subtotal-text"><?php echo number_format($subtotal, 2); ?></span></td>
                        <td>
                            <!-- formaction overrides the main form action to go to remove_from_cart.php -->
                            <button type="submit" formaction="remove_from_cart.php" formnovalidate="formnovalidate" name="remove_id" value="<?php echo $id; ?>" class="button small-button remove-button">Remove</button>
                        </td>
                    </tr>
<?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="row" colspan="3">Total</th>
                        <!-- Span ID used by JavaScript to update the grand total dynamically -->
                        <td>HK$<span id="cart-total" class="total-text"><?php echo number_format($total, 2); ?></span></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <!-- Customer details: saved in the orders table (maxlength matches the table columns) -->
            <fieldset class="customer-details">
                <legend>Customer Details</legend>
                <p>
                    <label for="customer-name">Name:</label>
                    <input type="text" id="customer-name" name="customer_name" maxlength="50" required="required"
                           value="<?php echo htmlspecialchars($customerName); ?>" />
                </p>
                <p>
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" maxlength="255" rows="3" cols="40" required="required"><?php echo htmlspecialchars($address); ?></textarea>
                </p>
            </fieldset>

            <div class="cart-actions">
                <a href="shop1.php" class="button">Shop Smartphones &amp; Wearables</a>
                <a href="shop2.php" class="button">Shop Computers &amp; Displays</a>
                <a href="shop3.php" class="button">Shop Accessories &amp; Smart Home</a>

                <!-- Buy Button submits the whole form to place_order.php -->
                <button type="submit" class="button buy-button">Buy</button>
            </div>
        </form>
<?php } ?>
    </main>

<?php include 'includes/footer.php'; ?>
