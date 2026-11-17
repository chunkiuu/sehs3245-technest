<?php
/*
 * File: shop1.php
 * Owner: B
 * Page 2: Shopping page - Smartphones & Wearables (5 products).
 */
session_start();
$pageTitle = 'Smartphones & Wearables';
include 'includes/header.php';
?>

    <main>
        <h1>Smartphones &amp; Wearables</h1>

        <section class="product-grid" aria-label="Smartphones and wearables product list">

            <article class="product-card" data-product-id="P101" data-product-name="Nova X1 Smartphone" data-unit-price="4999.00">
                <img src="images/p101.jpg" alt="Nova X1 Smartphone" class="product-image" width="220" height="293" />
                <h2>Nova X1 Smartphone</h2>
                <p>6.5-inch display, 128 GB storage, 5G network support.</p>
                <p class="price">Unit price: HK$4,999.00</p>
                <p class="stock">Available quantity: 50</p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="P101" />
                    <label for="qty-P101">Quantity:</label>
                    <input type="number" id="qty-P101" name="quantity" class="qty-input" min="1" max="50" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <article class="product-card" data-product-id="P102" data-product-name="Nova X2 Pro Smartphone" data-unit-price="6999.00">
                <img src="images/p102.jpg" alt="Nova X2 Pro Smartphone" class="product-image" width="220" height="220" />
                <h2>Nova X2 Pro Smartphone</h2>
                <p>6.8-inch AMOLED display, 256 GB storage, triple camera.</p>
                <p class="price">Unit price: HK$6,999.00</p>
                <p class="stock">Available quantity: 30</p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="P102" />
                    <label for="qty-P102">Quantity:</label>
                    <input type="number" id="qty-P102" name="quantity" class="qty-input" min="1" max="30" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <article class="product-card" data-product-id="P103" data-product-name="Pulse S Smartwatch" data-unit-price="1899.00">
                <img src="images/p103.jpg" alt="Pulse S Smartwatch" class="product-image" width="220" height="220" />
                <h2>Pulse S Smartwatch</h2>
                <p>Heart-rate monitoring, GPS, 7-day battery life.</p>
                <p class="price">Unit price: HK$1,899.00</p>
                <p class="stock">Available quantity: 80</p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="P103" />
                    <label for="qty-P103">Quantity:</label>
                    <input type="number" id="qty-P103" name="quantity" class="qty-input" min="1" max="80" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <article class="product-card" data-product-id="P104" data-product-name="FitBand 5" data-unit-price="599.00">
                <img src="images/p104.jpg" alt="FitBand 5" class="product-image" width="220" height="220" />
                <h2>FitBand 5</h2>
                <p>Fitness tracking, sleep monitoring, water resistant.</p>
                <p class="price">Unit price: HK$599.00</p>
                <p class="stock">Available quantity: 120</p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="P104" />
                    <label for="qty-P104">Quantity:</label>
                    <input type="number" id="qty-P104" name="quantity" class="qty-input" min="1" max="120" step="1" value="1" required="required" />
                    <button type="submit" class="button add-cart-button">Add to Cart</button>
                </form>
            </article>

            <article class="product-card" data-product-id="P105" data-product-name="AirBuds Pro" data-unit-price="899.00">
                <img src="images/p105.jpg" alt="AirBuds Pro" class="product-image" width="220" height="220" />
                <h2>AirBuds Pro</h2>
                <p>Wireless earphones with active noise cancellation.</p>
                <p class="price">Unit price: HK$899.00</p>
                <p class="stock">Available quantity: 100</p>
                <form class="add-to-cart-form" action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="P105" />
                    <label for="qty-P105">Quantity:</label>
                    <input type="number" id="qty-P105" name="quantity" class="qty-input" min="1" max="100" step="1" value="1" required="required" />
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
