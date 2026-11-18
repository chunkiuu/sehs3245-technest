# PHP 部分工作計劃

本文件說明網站中所有 PHP 功能的設計及分工，供負責 PHP 的組員參考及準備 presentation。

## 目標

1. 購物車以 PHP session 儲存，**完全不使用 cookie**
2. 顧客可將產品加入購物車、更改數量及移除產品
3. 按下 Buy 後，訂單寫入 MySQL 的 `orders` 及 `order_details` table，並顯示感謝頁及訂單編號

## 整體流程

```
shop1/2/3.php ──(Add to Cart)──▶ add_to_cart.php ──▶ cart.php
                                                      │
                     remove_from_cart.php ◀─(Remove)──┤
                                                      │
                                       (Buy) ──▶ place_order.php ──▶ 寫入 MySQL
                                                      │
                                                      ▼
                                     thankyou.php（從 MySQL 讀出訂單摘要）
```

所有頁面均以 `include 'includes/session.php';` 啟動 session。

## 第 1 步：不使用 cookie 的 session（`includes/session.php`）

PHP 預設會把 session ID 存放於 cookie（`PHPSESSID`）。為符合「不使用 cookie」的要求，於 `session_start()` 前加入以下設定：

| 設定 | 作用 |
|---|---|
| `session.use_cookies = 0` | 不以 cookie 儲存 session ID |
| `session.use_only_cookies = 0` | 容許從網址或表單讀取 session ID |
| `session.use_trans_sid = 1` | PHP 自動於所有連結及表單加上 session ID |
| `session.trans_sid_tags = a=href,form=` | 指定需要加上 session ID 的標籤（連結及表單） |
| `session.use_strict_mode = 1` | 拒絕不是由伺服器產生的 session ID，提高安全性 |

效果：
- 導覽列連結會自動變成 `shop1.php?PHPSESSID=...`
- 表單會自動加入隱藏欄位 `<input type="hidden" name="PHPSESSID" ...>`
- 因此各頁毋須再自行加入 session ID 的隱藏欄位
- 以 `header('Location: ...')` 轉頁時，PHP 不會自動加上 session ID，須寫成 `header('Location: cart.php?' . SID);`

## 第 2 步：加入購物車（`add_to_cart.php`）

1. 接收 `$_POST['product_id']` 及 `$_POST['quantity']`
2. 以 `filter_var(..., FILTER_VALIDATE_INT)` 檢查數量是否為 1 或以上的整數
3. 以 PDO prepared statement 從 `products` table 讀取產品名稱、價錢及存貨
   - 價錢以資料庫為準，不信任表單傳來的資料（用戶可修改 HTML）
4. 若購物車已有該產品，則增加數量；否則新增一項
5. 數量不可超過存貨，超出時以存貨為上限，並顯示提示訊息
6. 轉到 `cart.php`

購物車格式：

```php
$_SESSION['cart'][101] = [
    'product_id'   => 101,
    'product_name' => 'Nova X1 Smartphone',
    'unit_price'   => 4999.00,
    'quantity'     => 2,
];
```

提示訊息存放於 `$_SESSION['cart_message']`，由 `cart.php` 顯示一次後刪除。

## 第 3 步：移除產品（`remove_from_cart.php`）

1. 接收 Remove 按鈕傳來的 `$_POST['remove_id']`
2. `unset($_SESSION['cart'][$id]);`
3. 轉回 `cart.php`

`update_cart.php` 暫時毋須使用，因為購物車的數量會於按下 Buy 時一併送出。

## 第 4 步：購物車頁（`cart.php`）

- 顯示 `$_SESSION['cart_message']`（如有）
- 於 Buy 按鈕前加入顧客資料欄位：
  - `customer_name`：必填，最多 50 字（對應 `orders.customer_name VARCHAR(50)`）
  - `address`：必填，最多 255 字（對應 `orders.address VARCHAR(255)`）

## 第 5 步：儲存訂單（`place_order.php`）

1. 只接受由購物車送出的 POST，且購物車不可為空；否則轉回 `cart.php`
2. 按 `$_POST['quantity']` 更新數量，並檢查每個數量為 1 至存貨之間的整數
3. 檢查顧客姓名及地址不可為空，長度不可超過 table 的上限
4. 如有任何資料錯誤，存入提示訊息並轉回 `cart.php`
5. 以 transaction 寫入資料庫，確保訂單資料完整：
   1. `$pdo->beginTransaction()`
   2. `INSERT INTO orders (customer_name, address, total_amount)`
   3. `$orderId = $pdo->lastInsertId()`
   4. 以 `foreach` 為每件產品 `INSERT INTO order_details (order_id, product_id, quantity, price)`
   5. `$pdo->commit()`；如出錯則 `$pdo->rollBack()`
6. 所有 SQL 均使用 prepared statement（`prepare` 及 `execute`），防止 SQL injection
7. 訂單編號格式為 `TN-000001`
8. 寫入成功後，將訂單編號存入 `$_SESSION['last_order_id']`，清空購物車，再轉到 `thankyou.php`

## 第 6 步：感謝頁訂單摘要（`thankyou.php`）

1. 採用 **Post/Redirect/Get**：`place_order.php` 處理 POST 後轉頁，`thankyou.php` 以 GET 顯示。重新整理感謝頁只會再次顯示，不會重複下單，瀏覽器亦不會彈出「重新提交表單」的警告
2. 只讀取 `$_SESSION['last_order_id']` 的訂單，不接受網址上的訂單編號，避免他人查看其他顧客的姓名及地址
3. 訂單摘要從 MySQL 讀出（而非 session），證明訂單確實已存入資料庫：
   - `SELECT ... FROM orders WHERE order_id = ?`：顧客姓名、地址、總額、下單時間
   - `SELECT ... FROM order_details d JOIN products p ON d.product_id = p.product_id`：每件產品的名稱、單價及數量
4. 顯示內容一律使用 `htmlspecialchars()`，防止 XSS；地址以 `nl2br()` 保留換行

## 測試清單

- [ ] 瀏覽器的 cookie 列表中沒有 `PHPSESSID`
- [ ] 加入產品後，購物車顯示正確的名稱、單價、數量、小計及總額
- [ ] 同一產品加入兩次，數量會累加
- [ ] 數量超過存貨時，以存貨為上限並顯示提示
- [ ] 輸入 0、負數或小數時，不會加入購物車
- [ ] Remove 可移除產品
- [ ] 未填姓名或地址時，不能完成訂單
- [ ] 下單後，phpMyAdmin 的 `orders` 及 `order_details` 出現對應資料
- [ ] 下單後購物車清空；重新整理感謝頁不會重複下單
- [ ] 感謝頁顯示正確的顧客姓名、地址、產品、數量及總額
- [ ] 未下單直接開啟 `thankyou.php`，會轉回購物車
- [ ] 姓名輸入 `<b>Tim</b>`，感謝頁顯示文字而非粗體（防止 XSS）

## Presentation 重點（約 2 分鐘）

1. 為何及如何不使用 cookie：`session.php` 的設定及 `trans_sid`
2. 購物車的資料結構（`$_SESSION['cart']`）
3. 為何價錢從資料庫讀取，而非信任表單
4. 以 prepared statement 防止 SQL injection
5. 以 transaction 確保 `orders` 與 `order_details` 一同寫入
6. Post/Redirect/Get：重新整理不會重複下單
7. 感謝頁以 `JOIN` 從資料庫讀出訂單摘要，證明訂單已儲存
