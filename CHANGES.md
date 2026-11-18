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
- **資料庫結構與原作者版本完全相同**（三個 table 的欄位、類型、`CHECK` 限制、foreign key 及中文註解均沒有修改）
- 只修改了兩處：
  1. 第 13 行 `--default` 改為 `-- default`（加一個空格）。MySQL 規定 `--` 後必須有空格才算註解，否則匯入時會出錯
  2. 產品資料（第 36 至 54 行）：15 件產品改為 HTML 的產品資料，並於 `INSERT` 指定 `product_id`（101 至 305），使其與購物頁的產品編號相同
- 所有註解（共 27 處）與原作者版本相同，包括分類註解（例如 `【Category 1: 手機配件】`）
- 檔案仍使用原有的 Windows 換行格式（CRLF）

註：較早的版本曾修改資料庫結構（`product_id` 改為 `VARCHAR`、新增 `category` 欄位等）。其後檢討認為這些修改並非必要，已於 2026 年 11 月 18 日還原，詳見文末。

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

## 組員更新（2026 年 11 月 17 日）

一位組員以舊版 `page1.html` 至 `page5.html` 作出修改，現已併入 repo 的對應檔案：

| 修改 | 併入的檔案 |
|---|---|
| 新增英文註解（例如 `Product 1: Nova X1`、`Header Section`、`Footer Section`） | `index.php`、`shop1/2/3.php`、`includes/header.php`、`includes/footer.php` |
| 產品圖片尺寸統一為 220×220，並加入 `class="product-image"` | `shop1/2/3.php` |
| 每個 Add to Cart 表單加入隱藏欄位，傳送 session ID（不使用 cookie） | `shop1/2/3.php` |
| 購物車改為單一表單：可直接更改數量，Remove 以 `formaction` 送往 `remove_from_cart.php`，並加入供 JavaScript 即時計算的 `data-price` 及 `<span id>` | `cart.php` |

為配合 repo 現有設計，作出以下調整：

- 保留 `include` 共用 header 及 footer，不採用各頁重複的 header
- 連結繼續使用 `index.php`，不使用 `intro.php`
- Buy 按鈕送往 `thankyou.php`，不使用 `checkout.php`
- 小計以 `unit_price × quantity` 即時計算，不使用 `$item['subtotal']`，以配合 README 所列的 session 格式
- Remove 按鈕加入 `formnovalidate`，即使數量欄位未填妥亦可移除產品

`page6.html` 及圖片沒有修改。`remove_from_cart.php`、`update_cart.php` 及 `thankyou.php` 的 TODO 註解已按新的購物車表單更新。

## PHP 功能（2026 年 11 月 18 日）

按 [docs/php-plan.md](docs/php-plan.md) 完成 PHP 部分：

| 檔案 | 修改 |
|---|---|
| `includes/session.php`（新增） | 停用 cookie，並以 `trans_sid` 自動於連結及表單加上 session ID；所有頁面改為 include 此檔案 |
| `add_to_cart.php` | 從資料庫讀取產品名稱及價錢，檢查數量及存貨，加入或累加至購物車 |
| `remove_from_cart.php` | 按 `remove_id` 移除產品 |
| `cart.php` | 顯示提示訊息；加入顧客姓名及地址欄位 |
| `thankyou.php` | 檢查資料後，以 transaction 及 prepared statement 將訂單寫入 `orders` 及 `order_details`，並顯示訂單編號（例如 `TN-000001`） |
| `shop1/2/3.php`、`cart.php` | 刪除人手加入的 session ID 隱藏欄位，因為 `session.php` 已自動加入，保留會出現重複 |
| `update_cart.php` | 轉頁時加上 `SID` |

## 分工調整（2026 年 11 月 18 日）

分工由「按頁面」改為「按語言」：組長負責 PHP，其餘四位組員分別負責 HTML、CSS、JavaScript 及 SQL。README 的分工表、待辦事項及各檔案開首的 `Owner` 註解已相應更新。

## 感謝頁訂單摘要（2026 年 11 月 18 日）

- 新增 `place_order.php`：原本 `thankyou.php` 內「檢查及儲存訂單」的程式碼移至此檔案，購物車的 Buy 表單改為送往此檔案
- `thankyou.php` 改為只負責顯示：以 `SELECT ... JOIN` 從 MySQL 讀出訂單，顯示顧客姓名、下單時間、送貨地址、每件產品及總額
- 採用 Post/Redirect/Get，重新整理感謝頁不會重複下單
- 感謝頁只顯示該顧客 session 內的訂單，他人無法透過網址查看

## 還原 SQL 結構（2026 年 11 月 18 日）

原作者的資料庫結構已完全還原，只保留必要的修改（第 13 行加一個空格，以及產品資料）。

- 產品編號由 `P101` 格式改為數字 `101`（配合原有的 `product_id INT`），已更新 `shop1/2/3.php` 內的 `value`、`data-product-id` 及 `id`
- 移除較早加入的 `category` 欄位、`DROP DATABASE IF EXISTS` 及 `utf8mb4` 設定（XAMPP 的 MariaDB 預設已使用 utf8mb4）
- 註解還原為原作者的中文註解
- 因原有檔案使用 `CREATE DATABASE IF NOT EXISTS`，**重新匯入前須先於 phpMyAdmin 刪除 `shop_db`**，否則會出現「table already exists」錯誤
