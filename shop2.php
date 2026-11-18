<?php
/*
 * File: shop2.php
 * Owner: HTML
 * Page 3: Shopping page - Computers & Displays (5 products).
 */
include 'includes/session.php';
$pageTitle = 'Computers & Displays';
include 'includes/header.php';
?>

    <main>
        <h1>Computers &amp; Displays</h1>

        <section class="product-grid" aria-label="Computers and displays product list">

            <!-- Product 1: UltraBook 14 -->
            <article class="product-card" data-product-id="P201" data-product-name="UltraBook 14 Laptop" data-unit-price="8999.00">
                <img src="images/p201.jpg" alt="UltraBook 14 Laptop" class="product-image" width="220" height="220" />
                <h2>UltraBook 14 Laptop</h2>
                <p>14-inch display, 16 GB RAM, 512 GB SSD.</p>
                <p class="price">Unit price: HK$8,999.00</p>
                <p class="stock">Available quantity: 25</p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="P201" />
                    <label for="qty-P201">Quantity:</label>
                    <input type="number" id="qty-P201" name="quantity" class="qty-input" min="1" max="25" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <!-- Product 2: GamingBook 16 -->
            <article class="product-card" data-product-id="P202" data-product-name="GamingBook 16 Laptop" data-unit-price="12999.00">
                <img src="images/p202.jpg" alt="GamingBook 16 Laptop" class="product-image" width="220" height="220" />
                <h2>GamingBook 16 Laptop</h2>
                <p>16-inch display, 32 GB RAM, 1 TB SSD, dedicated graphics.</p>
                <p class="price">Unit price: HK$12,999.00</p>
                <p class="stock">Available quantity: 15</p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="P202" />
                    <label for="qty-P202">Quantity:</label>
                    <input type="number" id="qty-P202" name="quantity" class="qty-input" min="1" max="15" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <!-- Product 3: TabPro 11 -->
            <article class="product-card" data-product-id="P203" data-product-name="TabPro 11 Tablet" data-unit-price="3499.00">
                <img src="images/p203.jpg" alt="TabPro 11 Tablet" class="product-image" width="220" height="220" />
                <h2>TabPro 11 Tablet</h2>
                <p>11-inch tablet, 128 GB storage, stylus support.</p>
                <p class="price">Unit price: HK$3,499.00</p>
                <p class="stock">Available quantity: 40</p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="P203" />
                    <label for="qty-P203">Quantity:</label>
                    <input type="number" id="qty-P203" name="quantity" class="qty-input" min="1" max="40" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <!-- Product 4: 27-inch 4K Monitor -->
            <article class="product-card" data-product-id="P204" data-product-name="27-inch 4K Monitor" data-unit-price="2999.00">
                <img src="images/p204.jpg" alt="27-inch 4K Monitor" class="product-image" width="220" height="220" />
                <h2>27-inch 4K Monitor</h2>
                <p>4K UHD monitor with HDMI and DisplayPort inputs.</p>
                <p class="price">Unit price: HK$2,999.00</p>
                <p class="stock">Available quantity: 35</p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="P204" />
                    <label for="qty-P204">Quantity:</label>
                    <input type="number" id="qty-P204" name="quantity" class="qty-input" min="1" max="35" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <!-- Product 5: Mechanical Keyboard -->
            <article class="product-card" data-product-id="P205" data-product-name="Mechanical Keyboard K80" data-unit-price="699.00">
                <img src="images/p205.jpg" alt="Mechanical Keyboard K80" class="product-image" width="220" height="220" />
                <h2>Mechanical Keyboard K80</h2>
                <p>RGB backlight, hot-swappable switches, USB-C connection.</p>
                <p class="price">Unit price: HK$699.00</p>
                <p class="stock">Available quantity: 60</p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="P205" />
                    <label for="qty-P205">Quantity:</label>
                    <input type="number" id="qty-P205" name="quantity" class="qty-input" min="1" max="60" step="1" value="1" required="required" />
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
