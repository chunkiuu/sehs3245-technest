<?php
/*
 * File: shop1.php
 * Author: KU Ho Tin (HTML page layout), Chow Chun Kiu (PHP: stock loaded from the database)
 * Page 2: Shopping page - Smartphones & Wearables (5 products).
 */
include 'includes/session.php';
include 'includes/db.php';

// Load the current stock of every product from the database, e.g. $stock[101] = 50.
// The stock goes down after each order (place_order.php), so the page always shows the real amount.
$stock = $pdo->query('SELECT product_id, stock FROM products')->fetchAll(PDO::FETCH_KEY_PAIR);
$pageTitle = 'Smartphones & Wearables';
include 'includes/header.php';
?>

    <main>
        <h1>Smartphones &amp; Wearables</h1>

        <!-- Product Grid Section -->
        <section class="product-grid" aria-label="Smartphones and wearables product list">

            <!-- Product 1: Nova X1 -->
            <article class="product-card" data-product-id="101" data-product-name="Nova X1 Smartphone" data-unit-price="4999.00">
                <img src="images/p101.jpg" alt="Nova X1 Smartphone" class="product-image" width="220" height="220" />
                <h2>Nova X1 Smartphone</h2>
                <p>6.5-inch display, 128 GB storage, 5G network support.</p>
                <p class="price">Unit price: HK$4,999.00</p>
                <p class="stock">Available quantity: <?php echo $stock[101]; ?></p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="101" />
                    <label for="qty-101">Quantity:</label>
                    <input type="number" id="qty-101" name="quantity" class="qty-input" min="1" max="<?php echo $stock[101]; ?>" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <!-- Product 2: Nova X2 Pro -->
            <article class="product-card" data-product-id="102" data-product-name="Nova X2 Pro Smartphone" data-unit-price="6999.00">
                <img src="images/p102.jpg" alt="Nova X2 Pro Smartphone" class="product-image" width="220" height="220" />
                <h2>Nova X2 Pro Smartphone</h2>
                <p>6.8-inch AMOLED display, 256 GB storage, triple camera.</p>
                <p class="price">Unit price: HK$6,999.00</p>
                <p class="stock">Available quantity: <?php echo $stock[102]; ?></p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="102" />
                    <label for="qty-102">Quantity:</label>
                    <input type="number" id="qty-102" name="quantity" class="qty-input" min="1" max="<?php echo $stock[102]; ?>" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <!-- Product 3: Pulse S Smartwatch -->
            <article class="product-card" data-product-id="103" data-product-name="Pulse S Smartwatch" data-unit-price="1899.00">
                <img src="images/p103.jpg" alt="Pulse S Smartwatch" class="product-image" width="220" height="220" />
                <h2>Pulse S Smartwatch</h2>
                <p>Heart-rate monitoring, GPS, 7-day battery life.</p>
                <p class="price">Unit price: HK$1,899.00</p>
                <p class="stock">Available quantity: <?php echo $stock[103]; ?></p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="103" />
                    <label for="qty-103">Quantity:</label>
                    <input type="number" id="qty-103" name="quantity" class="qty-input" min="1" max="<?php echo $stock[103]; ?>" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <!-- Product 4: FitBand 5 -->
            <article class="product-card" data-product-id="104" data-product-name="FitBand 5" data-unit-price="599.00">
                <img src="images/p104.jpg" alt="FitBand 5" class="product-image" width="220" height="220" />
                <h2>FitBand 5</h2>
                <p>Fitness tracking, sleep monitoring, water resistant.</p>
                <p class="price">Unit price: HK$599.00</p>
                <p class="stock">Available quantity: <?php echo $stock[104]; ?></p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="104" />
                    <label for="qty-104">Quantity:</label>
                    <input type="number" id="qty-104" name="quantity" class="qty-input" min="1" max="<?php echo $stock[104]; ?>" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <!-- Product 5: AirBuds Pro -->
            <article class="product-card" data-product-id="105" data-product-name="AirBuds Pro" data-unit-price="899.00">
                <img src="images/p105.jpg" alt="AirBuds Pro" class="product-image" width="220" height="220" />
                <h2>AirBuds Pro</h2>
                <p>Wireless earphones with active noise cancellation.</p>
                <p class="price">Unit price: HK$899.00</p>
                <p class="stock">Available quantity: <?php echo $stock[105]; ?></p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="105" />
                    <label for="qty-105">Quantity:</label>
                    <input type="number" id="qty-105" name="quantity" class="qty-input" min="1" max="<?php echo $stock[105]; ?>" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

        </section>

        <!-- Navigation Buttons -->
        <div class="page-actions">
            <a href="index.php" class="button">Back to Introduction</a>
            <a href="cart.php" class="button">Go to Shopping Cart</a>
        </div>
    </main>

<?php include 'includes/footer.php'; ?>
