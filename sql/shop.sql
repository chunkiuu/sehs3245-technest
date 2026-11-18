-- 檔案名稱: shop.sql
-- 負責組員: Lo Ching Yu
-- 描述: 建立網上商店的資料庫結構及產品資料表
-- 1. 在沒有已有shop_db的情況下建立一個新資料庫 (命名為 shop_db)
CREATE DATABASE IF NOT EXISTS shop_db; 
-- 2. 告訴 MySQL 接下來要在 shop_db 裡面操作
USE shop_db; 
-- 3. 建立產品資料表
CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,  -- product_id with auto increment
    product_name VARCHAR(100) NOT NULL,         -- product name
    price DECIMAL(10, 2) NOT NULL,              -- price with 2 dp
    stock INT NOT NULL DEFAULT 0 CHECK (stock >= 0),  -- default 0 stock with check>=0)
    description TEXT                            -- Long description (長文字)
);
-- 4. 建立訂單主表 (orders table) - Master Table (1NF & 2NF)
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,    -- Primary Key
    customer_name VARCHAR(50) NOT NULL,         -- customer name
    address VARCHAR(255) NOT NULL,              -- address
    total_amount DECIMAL(10, 2) NOT NULL,       -- total price
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- 5. 建立訂單明細表 (order_details table) - Detail Table (1NF & 2NF)
CREATE TABLE order_details (
    detail_id INT AUTO_INCREMENT PRIMARY KEY,  -- detail primary key
    order_id INT NOT NULL,                     -- Foreign Key link to TABLE orders
    product_id INT NOT NULL,                   -- Foreign Key link to TABLE products
    quantity INT NOT NULL CHECK (quantity > 0),   -- how many this item in this order
    price DECIMAL(10, 2) NOT NULL,              -- price (current price)
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);
-- 6. 插入初始產品資料 (測試用)
-- 分類：電子產品/3C店、手機配件、電腦周邊、智能家居 IoT
INSERT INTO products (product_id, product_name, price, stock, description) VALUES 
-- 【Category 1: 手機配件】
(101, 'Nova X1 Smartphone', 4999.00, 50, '6.5-inch display, 128 GB storage, 5G network support.'),
(102, 'Nova X2 Pro Smartphone', 6999.00, 30, '6.8-inch AMOLED display, 256 GB storage, triple camera.'),
(103, 'Pulse S Smartwatch', 1899.00, 80, 'Heart-rate monitoring, GPS, 7-day battery life.'),
(104, 'FitBand 5', 599.00, 120, 'Fitness tracking, sleep monitoring, water resistant.'),
(105, 'AirBuds Pro', 899.00, 100, 'Wireless earphones with active noise cancellation.'),
-- 【Category 2: 電腦周邊】
(201, 'UltraBook 14 Laptop', 8999.00, 25, '14-inch display, 16 GB RAM, 512 GB SSD.'),
(202, 'GamingBook 16 Laptop', 12999.00, 15, '16-inch display, 32 GB RAM, 1 TB SSD, dedicated graphics.'),
(203, 'TabPro 11 Tablet', 3499.00, 40, '11-inch tablet, 128 GB storage, stylus support.'),
(204, '27-inch 4K Monitor', 2999.00, 35, '4K UHD monitor with HDMI and DisplayPort inputs.'),
(205, 'Mechanical Keyboard K80', 699.00, 60, 'RGB backlight, hot-swappable switches, USB-C connection.'),
-- 【Category 3: 智能家居 IoT】
(301, 'Wireless Mouse M20', 299.00, 100, 'Ergonomic wireless mouse with adjustable DPI.'),
(302, 'Bluetooth Speaker Boom', 799.00, 70, 'Portable Bluetooth speaker with deep bass and 12-hour battery.'),
(303, '1TB Portable SSD', 899.00, 90, 'Fast USB-C portable SSD for backup and file transfer.'),
(304, 'WiFi 6 Router', 1299.00, 45, 'Dual-band WiFi 6 router with enhanced coverage.'),
(305, '1080p Webcam', 499.00, 65, 'Full HD webcam with built-in microphone for online meetings.');
