<?php
/*
 * File: includes/header.php
 * Owner: HTML
 * Shared page header (logo + navigation) included at the top of every page.
 * Before including this file, the page must include includes/session.php and
 * set $pageTitle, e.g. $pageTitle = 'Shopping Cart';
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TechNest - <?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/validation.js" defer="defer"></script>
</head>
<body>
    <!-- Header Section: Logo and Main Navigation -->
    <header class="site-header">
        <a href="index.php" class="logo-link">
            <img src="images/logo.png" alt="TechNest Online Shop logo" class="logo" width="140" height="70" />
        </a>
        <nav class="main-nav" aria-label="Main navigation">
            <a href="index.php">Home</a>
            <a href="shop1.php">Smartphones &amp; Wearables</a>
            <a href="shop2.php">Computers &amp; Displays</a>
            <a href="shop3.php">Accessories &amp; Smart Home</a>
            <a href="cart.php" class="cart-link">Shopping Cart</a>
        </nav>
    </header>
