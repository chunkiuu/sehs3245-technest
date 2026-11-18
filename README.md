# TechNest – SEHS3245 Group Project

網上電子產品商店，以 HTML5、CSS3、JavaScript、PHP 及 MySQL 製作，於 XAMPP 上運行。

組員最初提交的檔案及其後的修改，請參閱 [CHANGES.md](CHANGES.md)。

## 首次設定（每位組員只需進行一次）

1. 安裝 **XAMPP** 及 **GitHub Desktop**
2. 於 GitHub Desktop 選擇 File → Clone repository → 選取本 repo，並將 Local path 設為 `htdocs`：
   - Windows：`C:\xampp\htdocs`
   - Mac：`/Applications/XAMPP/xamppfiles/htdocs`
3. 開啟 XAMPP，啟動（Start）**Apache** 及 **MySQL**
4. 開啟 <http://localhost/phpmyadmin> → Import → 選取 `sql/shop.sql` → Go
5. 於瀏覽器開啟 <http://localhost/technest/>

## 分工（每位組員只修改自己負責的檔案）

| 組員 | 頁面 | 負責技術 | 負責檔案 |
|---|---|---|---|
| **A**（組長） | 第 1 頁 Introduction | HTML5 及 include | `index.php`、`includes/header.php`、`includes/footer.php`、`images/logo.png` |
| **B** | 第 2 頁 Smartphones & Wearables | CSS3 | `shop1.php`、`css/style.css` |
| **C** | 第 3 頁 Computers & Displays | JavaScript | `shop2.php`、`js/validation.js` |
| **D** | 第 4 頁 Accessories & Smart Home | PHP Session | `shop3.php`、`add_to_cart.php`、`update_cart.php`、`remove_from_cart.php` |
| **E** | 第 5 頁購物車、第 6 頁感謝頁 | SQL 及 PHP | `cart.php`、`thankyou.php`、`includes/db.php`、`sql/shop.sql` |

## 協作守則

1. **開始工作前必須先 Pull**（GitHub Desktop：Fetch origin → Pull），完成後立即 Commit 及 Push
2. **只修改自己負責的檔案**
3. Commit message 須清楚說明修改內容，例如 `B: add hover effect to product cards`
4. 如需修改共用檔案（`header.php`、`footer.php`、`style.css`、`db.php`），**須先於群組通知其他組員**
5. **請勿上載 zip 檔**，所有檔案應直接放入 repo
6. **請直接修改 repo 內的檔案**（例如 `shop1.php`），切勿修改舊版 `page1.html` 至 `page6.html`

如修改了 `sql/shop.sql`，須於群組通知所有組員重新 Import 一次。

## 頁面流程

```
index.php → shop1/2/3.php → add_to_cart.php → cart.php → thankyou.php（存入 MySQL）
                                ↑ remove_from_cart.php（Remove 按鈕）
```

每頁開首以 `include 'includes/session.php';` 啟動 session（**不可直接使用 `session_start()`**）。此檔案已停用 cookie，PHP 會自動於所有連結及表單加上 session ID，因此毋須自行加入 session ID 的隱藏欄位。以 `header('Location: ...')` 轉頁時，須寫成 `header('Location: cart.php?' . SID);`。

PHP 部分的詳細設計見 [docs/php-plan.md](docs/php-plan.md)。

購物車以 `$_SESSION['cart']` 儲存，格式如下：

```php
$_SESSION['cart']['P101'] = [
    'product_id'   => 'P101',
    'product_name' => 'Nova X1 Smartphone',
    'unit_price'   => 4999.00,
    'quantity'     => 2,
];
```

## 待辦事項

- [ ] **A**：設計標誌（logo），儲存為 `images/logo.png`；以自己的文字改寫介紹內容（上限 600 字）
- [ ] **B**：編寫 `css/style.css`（所需的 class 名稱已列於檔案開首）
- [ ] **C**：編寫 `js/validation.js`（檢查數量；購物車頁更改數量時，以 `data-price` 即時更新 `subtotal-產品編號` 及 `cart-total`；按 Buy 前檢查顧客資料）
- [x] **PHP**：編寫 `add_to_cart.php` 及 `remove_from_cart.php`；`update_cart.php` 現時未有使用
- [x] **PHP**：於 `thankyou.php` 先按 `$_POST['quantity']` 更新數量，再將訂單寫入 `orders` 及 `order_details`
- [x] **PHP**：於購物車頁加入顧客姓名及地址欄位（`orders` table 需要此資料）
- [ ] **B、C 及 D**：考慮從 `products` table 讀取產品，再以 PHP `foreach` 輸出產品卡，避免 15 張產品卡的程式碼重複（影響 Readability 分數）
- [x] **PHP**：完成「不使用 cookie」的設定（`includes/session.php`）
- [ ] **B**：為新增的 `cart-message`（提示訊息）及 `customer-details`（顧客資料欄位）加入 CSS
- [ ] 縮小 `images/p202.jpg`（3284×1736 px，檔案過大）

## 提交功課（由組長負責）

最終須提交一個 zip 檔，內容包括：所有程式碼；Word 文件（載有所有程式碼及 SQL，首頁頂部須列明 SEHS3245、Web Systems and Technologies、提交日期，以及全體組員姓名及學號）；每位組員的 `組號_姓名_學號.pptx`。zip 檔須命名為 `組號_組長姓名.zip`。

程式碼內的註解（comment）一律以英文撰寫，因為講師會閱讀。
