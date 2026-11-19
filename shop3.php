<?php
/*
 * File: shop3.php
 * Team member: KU Ho Tin (HTML page layout), Chow Chun Kiu (PHP: stock loaded from the database)
 * Page 4: Shopping page - Accessories & Smart Home (5 products).
 */
include 'includes/session.php';
include 'includes/db.php';

// Load the current stock of every product from the database, e.g. $stock[101] = 50.
// The stock goes down after each order (place_order.php), so the page always shows the real amount.
$stock = $pdo->query('SELECT product_id, stock FROM products')->fetchAll(PDO::FETCH_KEY_PAIR);
$pageTitle = 'Accessories & Smart Home';
include 'includes/header.php';
?>

    <main>
        <h1>Accessories &amp; Smart Home</h1>

        <section class="product-grid" aria-label="Accessories and smart home product list">

            <!-- Product 1: Wireless Mouse -->
            <article class="product-card" data-product-id="301" data-product-name="Wireless Mouse M20" data-unit-price="299.00">
                <img src="images/p301.jpg" alt="Wireless Mouse M20" class="product-image" width="220" height="220" />
                <h2>Wireless Mouse M20</h2>
                <p>Ergonomic wireless mouse with adjustable DPI.</p>
                <p class="price">Unit price: HK$299.00</p>
                <p class="stock">Available quantity: <?php echo $stock[301]; ?></p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="301" />
                    <label for="qty-301">Quantity:</label>
                    <input type="number" id="qty-301" name="quantity" class="qty-input" min="1" max="<?php echo $stock[301]; ?>" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <!-- Product 2: Bluetooth Speaker -->
            <article class="product-card" data-product-id="302" data-product-name="Bluetooth Speaker Boom" data-unit-price="799.00">
                <img src="images/p302.jpg" alt="Bluetooth Speaker Boom" class="product-image" width="220" height="220" />
                <h2>Bluetooth Speaker Boom</h2>
                <p>Portable Bluetooth speaker with deep bass and 12-hour battery.</p>
                <p class="price">Unit price: HK$799.00</p>
                <p class="stock">Available quantity: <?php echo $stock[302]; ?></p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="302" />
                    <label for="qty-302">Quantity:</label>
                    <input type="number" id="qty-302" name="quantity" class="qty-input" min="1" max="<?php echo $stock[302]; ?>" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <!-- Product 3: Portable SSD -->
            <article class="product-card" data-product-id="303" data-product-name="1TB Portable SSD" data-unit-price="899.00">
                <img src="images/p303.jpg" alt="1TB Portable SSD" class="product-image" width="220" height="220" />
                <h2>1TB Portable SSD</h2>
                <p>Fast USB-C portable SSD for backup and file transfer.</p>
                <p class="price">Unit price: HK$899.00</p>
                <p class="stock">Available quantity: <?php echo $stock[303]; ?></p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="303" />
                    <label for="qty-303">Quantity:</label>
                    <input type="number" id="qty-303" name="quantity" class="qty-input" min="1" max="<?php echo $stock[303]; ?>" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <!-- Product 4: WiFi 6 Router -->
            <article class="product-card" data-product-id="304" data-product-name="WiFi 6 Router" data-unit-price="1299.00">
                <img src="images/p304.jpg" alt="WiFi 6 Router" class="product-image" width="220" height="220" />
                <h2>WiFi 6 Router</h2>
                <p>Dual-band WiFi 6 router with enhanced coverage.</p>
                <p class="price">Unit price: HK$1,299.00</p>
                <p class="stock">Available quantity: <?php echo $stock[304]; ?></p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="304" />
                    <label for="qty-304">Quantity:</label>
                    <input type="number" id="qty-304" name="quantity" class="qty-input" min="1" max="<?php echo $stock[304]; ?>" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <!-- Product 5: Webcam -->
            <article class="product-card" data-product-id="305" data-product-name="1080p Webcam" data-unit-price="499.00">
                <img src="images/p305.jpg" alt="1080p Webcam" class="product-image" width="220" height="220" />
                <h2>1080p Webcam</h2>
                <p>Full HD webcam with built-in microphone for online meetings.</p>
                <p class="price">Unit price: HK$499.00</p>
                <p class="stock">Available quantity: <?php echo $stock[305]; ?></p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="305" />
                    <label for="qty-305">Quantity:</label>
                    <input type="number" id="qty-305" name="quantity" class="qty-input" min="1" max="<?php echo $stock[305]; ?>" step="1" value="1" required="required" />
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
