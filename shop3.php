<?php
/*
 * File: shop3.php
 * Owner: D
 * Page 4: Shopping page - Accessories & Smart Home (5 products).
 */
session_start();
$pageTitle = 'Accessories & Smart Home';
include 'includes/header.php';
?>

    <main>
        <h1>Accessories &amp; Smart Home</h1>

        <section class="product-grid" aria-label="Accessories and smart home product list">

            <!-- Product 1: Wireless Mouse -->
            <article class="product-card" data-product-id="P301" data-product-name="Wireless Mouse M20" data-unit-price="299.00">
                <img src="images/p301.jpg" alt="Wireless Mouse M20" class="product-image" width="220" height="220" />
                <h2>Wireless Mouse M20</h2>
                <p>Ergonomic wireless mouse with adjustable DPI.</p>
                <p class="price">Unit price: HK$299.00</p>
                <p class="stock">Available quantity: 100</p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="P301" />
                    <input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
                    <label for="qty-P301">Quantity:</label>
                    <input type="number" id="qty-P301" name="quantity" class="qty-input" min="1" max="100" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <!-- Product 2: Bluetooth Speaker -->
            <article class="product-card" data-product-id="P302" data-product-name="Bluetooth Speaker Boom" data-unit-price="799.00">
                <img src="images/p302.jpg" alt="Bluetooth Speaker Boom" class="product-image" width="220" height="220" />
                <h2>Bluetooth Speaker Boom</h2>
                <p>Portable Bluetooth speaker with deep bass and 12-hour battery.</p>
                <p class="price">Unit price: HK$799.00</p>
                <p class="stock">Available quantity: 70</p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="P302" />
                    <input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
                    <label for="qty-P302">Quantity:</label>
                    <input type="number" id="qty-P302" name="quantity" class="qty-input" min="1" max="70" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <!-- Product 3: Portable SSD -->
            <article class="product-card" data-product-id="P303" data-product-name="1TB Portable SSD" data-unit-price="899.00">
                <img src="images/p303.jpg" alt="1TB Portable SSD" class="product-image" width="220" height="220" />
                <h2>1TB Portable SSD</h2>
                <p>Fast USB-C portable SSD for backup and file transfer.</p>
                <p class="price">Unit price: HK$899.00</p>
                <p class="stock">Available quantity: 90</p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="P303" />
                    <input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
                    <label for="qty-P303">Quantity:</label>
                    <input type="number" id="qty-P303" name="quantity" class="qty-input" min="1" max="90" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <!-- Product 4: WiFi 6 Router -->
            <article class="product-card" data-product-id="P304" data-product-name="WiFi 6 Router" data-unit-price="1299.00">
                <img src="images/p304.jpg" alt="WiFi 6 Router" class="product-image" width="220" height="220" />
                <h2>WiFi 6 Router</h2>
                <p>Dual-band WiFi 6 router with enhanced coverage.</p>
                <p class="price">Unit price: HK$1,299.00</p>
                <p class="stock">Available quantity: 45</p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="P304" />
                    <input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
                    <label for="qty-P304">Quantity:</label>
                    <input type="number" id="qty-P304" name="quantity" class="qty-input" min="1" max="45" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <!-- Product 5: Webcam -->
            <article class="product-card" data-product-id="P305" data-product-name="1080p Webcam" data-unit-price="499.00">
                <img src="images/p305.jpg" alt="1080p Webcam" class="product-image" width="220" height="220" />
                <h2>1080p Webcam</h2>
                <p>Full HD webcam with built-in microphone for online meetings.</p>
                <p class="price">Unit price: HK$499.00</p>
                <p class="stock">Available quantity: 65</p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="P305" />
                    <input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
                    <label for="qty-P305">Quantity:</label>
                    <input type="number" id="qty-P305" name="quantity" class="qty-input" min="1" max="65" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

        </section>

        <div class="page-actions">
            <a href="index.php" class="button">Back to Introduction</a>
            <a href="cart.php" class="button">Go to Shopping Cart</a>
        </div>
    </main>
<?php include 'includes/footer.php'; ?>
