# 改動記錄（CHANGES）

組員原本交嘅檔案保存喺 repo 嘅**第一個 commit**（`Add groupmates' original files (unchanged)`），內容一隻字都冇改過。
**第二個 commit** 就係以下所有改動。喺 GitHub 撳入第二個 commit，就會逐行顯示改咗咩（紅色 = 刪除，綠色 = 新增）。

## 點解要改

原本嘅檔案直接放上 XAMPP 係 run 唔到嘅：

1. 檔案係 `.html`，Apache 唔會執行入面嘅 PHP
2. Link 指去 `intro.php`、`shop1.php` 等，但實際檔名係 `page1.html` 等，撳落去會出 404
3. `shop.SQL` 第 13 行 `--default` 少咗個空格，import 嗰陣會出 error
4. HTML 同 SQL 嘅產品唔同（例如 `Nova X1 Smartphone` 對 `磁吸無線充電寶`），ID 格式又唔同（`P101` 對 `1`），所以兩邊連唔到

全組決定用 **HTML 嗰套產品**（選擇 A）。

## 檔名對照

| 原本 | 依家 | 頁面 |
|---|---|---|
| `page1.html` | `index.php` | 第 1 頁 Introduction |
| `page2.html` | `shop1.php` | 第 2 頁 Smartphones & Wearables |
| `page4.html` | `shop2.php` | 第 3 頁 Computers & Displays |
| `page3.html` | `shop3.php` | 第 4 頁 Accessories & Smart Home |
| `page5.html` | `cart.php` | 第 5 頁購物車 |
| `page6.html` | `thankyou.php` | 第 6 頁 Thank-you |
| `shop.SQL` | `sql/shop.sql` | Database |

注意：`page3` 同 `page4` 調轉咗，等 link 嘅次序同類別對返。

## 每個檔改咗咩

### 所有頁面
- 每頁重複嘅 `<head>`、header 同 nav，抽出嚟放入 `includes/header.php`，footer 放入 `includes/footer.php`，每頁用 `include` 引入（避免 code 重複被扣 Readability 分）
- 每頁開頭開咗 `session_start()`（原本被 `//` comment 咗）
- 所有 `intro.php` link 改做 `index.php`

### `index.php`（原 `page1.html`）
- 介紹文字**完全冇改**
- 刪咗 footer 嘅「View Shopping Cart」link（nav 已經有）

### `shop1.php`（原 `page2.html`）
- 5 件產品**內容冇改**
- 刪咗 5 句中文 comment，例如「第 1 個產品：Nova X1（使用上一張圖）」

### `shop2.php`、`shop3.php`（原 `page4.html`、`page3.html`）
- 產品**內容冇改**
- 原本只有 `<main>` 嗰段，依家前後加咗 header 同 footer，縮排向右移咗 4 格

### `cart.php`（原 `page5.html`）
- 將 `<!-- PHP echo ... -->` 呢類示意 comment 改做真正嘅 PHP：用 `foreach` 讀 `$_SESSION['cart']`，計 subtotal 同 total
- 購物車冇嘢嗰陣先顯示「Your shopping cart is empty」，有嘢先顯示 table 同 Buy 掣
- Buy 掣由 `checkout.php` 改去 `thankyou.php`（唔使多一個檔）
- 加咗 TODO comment：要加客人姓名同地址欄位

### `thankyou.php`（原 `page6.html`）
- 多謝訊息**冇改**
- 加咗 TODO comment，寫明點樣將訂單寫入 database

### `sql/shop.sql`（原 `shop.SQL`）
- 15 件產品換成 HTML 嗰套（英文、ID 用 `P101` 格式），價錢同存貨跟返 HTML
- `product_id` 由 `INT AUTO_INCREMENT` 改做 `VARCHAR(10)`，等佢同 HTML 嘅 ID 一樣
- `products` 加咗 `category` 欄，記低產品屬於邊一頁
- `order_details.product_id` 都改做 `VARCHAR(10)`，等 foreign key 夾到
- 加咗 `DROP DATABASE IF EXISTS`，重新 import 嗰陣全組嘅 database 一定一樣（只影響自己部機）
- 加咗 `CHARACTER SET utf8mb4`
- 修正 `--default` 語法錯誤
- Comment 改做英文
- **保留咗**：3 個 table 嘅設計（`products`、`orders`、`order_details`）、所有 `CHECK` 限制、foreign key 同原作者名

### 圖片
- 15 張產品圖**完全冇改**

## 新加嘅檔（原本冇）

| 檔案 | 用途 | 負責 |
|---|---|---|
| `includes/header.php`、`includes/footer.php` | 共用 header 同 footer | A |
| `includes/db.php` | 連接 database | E |
| `add_to_cart.php`、`update_cart.php`、`remove_from_cart.php` | 購物車功能（空白，有 TODO） | D |
| `css/style.css` | 全站 CSS（空白，列咗用到嘅 class） | B |
| `js/validation.js` | JavaScript（空白，有 TODO） | C |
| `README.md` | Setup 步驟、分工、規則 | — |
| `.gitignore` | 唔 upload `.DS_Store`、zip 等 | — |
