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
    stock INT NOT NULL DEFAULT 0 CHECK (stock >= 0),  --default 0 stock with check>=0)
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
INSERT INTO products (product_name, price, stock, description) VALUES 
-- 【Category 1: 手機配件】
('磁吸無線充電寶', 299.00, 200, '10000mAh 容量，支援 MagSafe 磁吸'),
('軍規防摔手機殼', 159.00, 350, '四角氣囊防摔，輕薄手感'),
('高清鋼化玻璃貼', 49.00, 500, '9H 硬度，防指紋塗層'),
('快充編織充電線', 89.00, 400, 'Type-C to Lightning，支援 PD 快充'),
('磁吸手機支架', 129.00, 180, '單手操作，穩固不傷機'),
-- 【Category 2: 電腦周邊】
('75% 機械鍵盤', 699.00, 60, '熱插拔軸體，RGB 背光，支援三模連接'),
('人體工學無線滑鼠', 349.00, 85, '垂直設計，減輕手腕疲勞'),
('7合1 USB-C Hub', 299.00, 110, '支援 4K HDMI、SD 卡及 PD 100W 充電'),
('1080p 高清網絡攝影機', 259.00, 70, '內置雙降噪麥克風，自動對焦'),
('桌面藍牙音響', 499.00, 45, '木質音箱，低音渾厚'),
-- 【Category 3: 智能家居 IoT】
('掃地機器人', 1999.00, 25, '雷射導航，自動集塵與拖地功能'),
('藍牙智能體重秤', 199.00, 90, '測量體脂率、肌肉量，數據自動同步手機'),
('空氣淨化器', 1299.00, 40, 'HEPA 濾網，實時顯示空氣質量'),
('智能窗簾電機', 399.00, 65, '支援定時開關，靜音導軌設計'),
('溫濕度感應器', 79.00, 150, '電子墨水螢幕，支援聯動冷氣機及抽濕機');
