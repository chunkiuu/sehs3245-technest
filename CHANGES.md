# 修改記錄（CHANGES）

組員最初提交的檔案保存於本 repo 的**第一個 commit**（`Add groupmates' original files (unchanged)`），內容未經任何修改。
**第二個 commit** 包含以下所有修改。於 GitHub 點選第二個 commit，即可逐行查看修改內容（紅色為刪除，綠色為新增）。

## 修改原因

原有檔案直接放到 XAMPP 上無法運行：

1. 檔案副檔名為 `.html`，Apache 不會執行其中的 PHP
2. 連結指向 `intro.php`、`shop1.php` 等，但實際檔名為 `page1.html` 等，點選後會出現 404 錯誤
3. `shop.SQL` 第 13 行的 `--default` 缺少空格，匯入時會出現錯誤
4. HTML 與 SQL 的產品資料不同（例如 `Nova X1 Smartphone` 與 `磁吸無線充電寶`），ID 格式亦不一致（`P101` 與 `1`），因此兩者無法連接

全組決定採用 **HTML 的產品資料**（選擇 A）。

## 檔名對照

| 原檔名 | 現檔名 | 頁面 |
|---|---|---|
| `page1.html` | `index.php` | 第 1 頁 Introduction |
| `page2.html` | `shop1.php` | 第 2 頁 Smartphones & Wearables |
| `page4.html` | `shop2.php` | 第 3 頁 Computers & Displays |
| `page3.html` | `shop3.php` | 第 4 頁 Accessories & Smart Home |
| `page5.html` | `cart.php` | 第 5 頁購物車 |
| `page6.html` | `thankyou.php` | 第 6 頁感謝頁 |
| `shop.SQL` | `sql/shop.sql` | 資料庫 |

注意：`page3` 與 `page4` 的次序已對調，使連結次序與產品類別一致。

## 各檔案的修改內容

### 所有頁面
- 各頁重複的 `<head>`、header 及 nav 已抽出至 `includes/header.php`，footer 則抽出至 `includes/footer.php`，各頁以 `include` 引入（避免程式碼重複而被扣 Readability 分數）
- 各頁開首已啟用 `session_start()`（原本以 `//` 註解停用）
- 所有 `intro.php` 連結已改為 `index.php`

### `index.php`（原 `page1.html`）
- 介紹文字**完全沒有修改**
- 刪除 footer 中的「View Shopping Cart」連結（導覽列已有相同連結）

### `shop1.php`（原 `page2.html`）
- 5 件產品的**內容沒有修改**
- 刪除 5 句中文註解，例如「第 1 個產品：Nova X1（使用上一張圖）」

### `shop2.php`、`shop3.php`（原 `page4.html`、`page3.html`）
- 產品**內容沒有修改**
- 原檔只有 `<main>` 部分，現已於前後加入 header 及 footer，縮排亦向右移四格

### `cart.php`（原 `page5.html`）
- 將 `<!-- PHP echo ... -->` 等示意註解改寫為可運行的 PHP：以 `foreach` 讀取 `$_SESSION['cart']`，並計算小計及總額
- 購物車沒有產品時，只顯示「Your shopping cart is empty」；有產品時才顯示表格及 Buy 按鈕
- Buy 按鈕的目標由 `checkout.php` 改為 `thankyou.php`（毋須額外檔案）
- 加入 TODO 註解：須加入顧客姓名及地址欄位

### `thankyou.php`（原 `page6.html`）
- 感謝訊息**沒有修改**
- 加入 TODO 註解，說明將訂單寫入資料庫的步驟

### `sql/shop.sql`（原 `shop.SQL`）
- 15 件產品改為 HTML 的產品資料（英文，ID 採用 `P101` 格式），價錢及存貨與 HTML 一致
- `product_id` 由 `INT AUTO_INCREMENT` 改為 `VARCHAR(10)`，使其與 HTML 的 ID 相同
- `products` 新增 `category` 欄位，記錄產品所屬頁面
- `order_details.product_id` 亦改為 `VARCHAR(10)`，使 foreign key 能夠對應
- 加入 `DROP DATABASE IF EXISTS`，確保每次重新匯入後全組的資料庫內容一致（只影響個人電腦）
- 加入 `CHARACTER SET utf8mb4`
- 修正 `--default` 的語法錯誤
- 註解改以英文撰寫
- **保留**：三個 table 的設計（`products`、`orders`、`order_details`）、所有 `CHECK` 限制、foreign key 及原作者姓名

### 圖片
- 15 張產品圖片**完全沒有修改**

## 新增檔案（原本沒有）

| 檔案 | 用途 | 負責 |
|---|---|---|
| `includes/header.php`、`includes/footer.php` | 共用 header 及 footer | A |
| `includes/db.php` | 連接資料庫 | E |
| `add_to_cart.php`、`update_cart.php`、`remove_from_cart.php` | 購物車功能（空白，附 TODO） | D |
| `css/style.css` | 全站 CSS（空白，已列出所需 class） | B |
| `js/validation.js` | JavaScript（空白，附 TODO） | C |
| `README.md` | 設定步驟、分工及守則 | — |
| `.gitignore` | 避免上載 `.DS_Store`、zip 等檔案 | — |
