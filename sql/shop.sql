-- File: sql/shop.sql
-- Owner: SQL (original author: Lo Ching Yu)
-- Description: creates the TechNest database, its tables and the product data.
-- How to use: phpMyAdmin > Import > choose this file.
-- Re-importing deletes the old local shop_db first, so everyone gets the same data.

-- 1. Create a fresh database (utf8mb4 so any text is stored correctly)
DROP DATABASE IF EXISTS shop_db;
CREATE DATABASE shop_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- 2. Work inside shop_db from now on
USE shop_db;

-- 3. Products table (same IDs as the shopping pages, e.g. 'P101')
CREATE TABLE products (
    product_id VARCHAR(10) PRIMARY KEY,               -- e.g. 'P101'
    category VARCHAR(50) NOT NULL,                    -- shopping page the product belongs to
    product_name VARCHAR(100) NOT NULL,               -- product name
    price DECIMAL(10, 2) NOT NULL,                    -- unit price with 2 decimal places
    stock INT NOT NULL DEFAULT 0 CHECK (stock >= 0),  -- default 0, never negative
    description TEXT                                  -- long description
);

-- 4. Orders table (one row per purchase)
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(50) NOT NULL,
    address VARCHAR(255) NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,             -- total price of the order
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 5. Order details table (one row per product in an order)
CREATE TABLE order_details (
    detail_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,                            -- links to orders
    product_id VARCHAR(10) NOT NULL,                  -- links to products
    quantity INT NOT NULL CHECK (quantity > 0),       -- how many of this product
    price DECIMAL(10, 2) NOT NULL,                    -- unit price at the time of purchase
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

-- 6. Product data (must match the shopping pages)
INSERT INTO products (product_id, category, product_name, price, stock, description) VALUES
-- Page 2 (shop1.php): Smartphones & Wearables
('P101', 'Smartphones & Wearables', 'Nova X1 Smartphone', 4999.00, 50, '6.5-inch display, 128 GB storage, 5G network support.'),
('P102', 'Smartphones & Wearables', 'Nova X2 Pro Smartphone', 6999.00, 30, '6.8-inch AMOLED display, 256 GB storage, triple camera.'),
('P103', 'Smartphones & Wearables', 'Pulse S Smartwatch', 1899.00, 80, 'Heart-rate monitoring, GPS, 7-day battery life.'),
('P104', 'Smartphones & Wearables', 'FitBand 5', 599.00, 120, 'Fitness tracking, sleep monitoring, water resistant.'),
('P105', 'Smartphones & Wearables', 'AirBuds Pro', 899.00, 100, 'Wireless earphones with active noise cancellation.'),
-- Page 3 (shop2.php): Computers & Displays
('P201', 'Computers & Displays', 'UltraBook 14 Laptop', 8999.00, 25, '14-inch display, 16 GB RAM, 512 GB SSD.'),
('P202', 'Computers & Displays', 'GamingBook 16 Laptop', 12999.00, 15, '16-inch display, 32 GB RAM, 1 TB SSD, dedicated graphics.'),
('P203', 'Computers & Displays', 'TabPro 11 Tablet', 3499.00, 40, '11-inch tablet, 128 GB storage, stylus support.'),
('P204', 'Computers & Displays', '27-inch 4K Monitor', 2999.00, 35, '4K UHD monitor with HDMI and DisplayPort inputs.'),
('P205', 'Computers & Displays', 'Mechanical Keyboard K80', 699.00, 60, 'RGB backlight, hot-swappable switches, USB-C connection.'),
-- Page 4 (shop3.php): Accessories & Smart Home
('P301', 'Accessories & Smart Home', 'Wireless Mouse M20', 299.00, 100, 'Ergonomic wireless mouse with adjustable DPI.'),
('P302', 'Accessories & Smart Home', 'Bluetooth Speaker Boom', 799.00, 70, 'Portable Bluetooth speaker with deep bass and 12-hour battery.'),
('P303', 'Accessories & Smart Home', '1TB Portable SSD', 899.00, 90, 'Fast USB-C portable SSD for backup and file transfer.'),
('P304', 'Accessories & Smart Home', 'WiFi 6 Router', 1299.00, 45, 'Dual-band WiFi 6 router with enhanced coverage.'),
('P305', 'Accessories & Smart Home', '1080p Webcam', 499.00, 65, 'Full HD webcam with built-in microphone for online meetings.');
