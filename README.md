# TechNest – SEHS3245 Group Project

線上電子產品商店，使用 HTML5、CSS3、JavaScript、PHP 及 MySQL 製作，於 XAMPP 上執行。

## 加入 GitHub 專案

組長已將各位加入本專案（Collaborators），請盡快接受邀請：

1. 打開 GitHub 寄來的邀請電郵，按 **View invitation** → **Accept invitation**
   - 找不到電郵（可能在垃圾郵件內）：登入 GitHub 後，直接開啟 <https://github.com/chunkiuu/sehs3245-technest/invitations>
2. 邀請 **7 天後會失效**，失效後請通知組長重新邀請
3. 接受後即可在 GitHub 網頁或 GitHub Desktop 修改檔案

## 首次設定

1. 安裝 **XAMPP**，並啟動 **Apache** 及 **MySQL**
2. 將 `technest` 資料夾放入 `htdocs`（Windows：`C:\xampp\htdocs`；Mac：`/Applications/XAMPP/xamppfiles/htdocs`）
3. 開啟 <http://localhost/phpmyadmin> → 匯入（Import）→ 選擇 `sql/shop.sql` → 執行（Go）
   - 若之前已匯入過，請先刪除舊資料庫：點選 `shop_db` → Operations → Drop the database，再重新匯入
   - 重新匯入會清除所有訂單，產品存貨亦會回復原本數字
4. 開啟 <http://localhost/technest/>

`.php` 檔案不能直接點兩下開啟，必須透過 localhost 瀏覽。

## 分工

| 組員 | 負責語言 | 檔案 |
|---|---|---|
| **Chow Chun Kiu**（組長） | PHP | `includes/session.php`、`includes/db.php`、`includes/cart_functions.php`、`add_to_cart.php`、`remove_from_cart.php`、`update_cart.php`、`place_order.php`，以及 `shop1/2/3.php`、`cart.php`、`thankyou.php` 的 PHP 部分 |
| **KU Ho Tin** | HTML5 | `index.php`、`shop1.php`、`shop2.php`、`shop3.php`、`includes/header.php`、`includes/footer.php`、`images/`，以及 `cart.php`、`thankyou.php` 的 HTML 部分 |
| **SONG Guoqing** | CSS3 | `css/style.css` |
| **LIN Zixi** | JavaScript | `js/validation.js` |
| **Lo Ching Yu** | SQL | `sql/shop.sql`，以及 PHP 檔案內的 SQL 語句 |

## 協作守則

1. 開始工作前先取得最新版本（Pull），完成後立即上傳（Push）
   - 若出現合併衝突（conflict），請勿只保留自己的版本，以免覆蓋其他組員的修改；請先在群組通知組長
2. 只修改自己負責的檔案或部分
3. 修改共用檔案（`header.php`、`footer.php`、`db.php`）前，請先在群組通知
4. 請直接修改本資料夾內的 `.php` 檔案，不要再修改舊版的 `page1.html` 至 `page6.html`
5. 修改 `sql/shop.sql` 的資料表或產品資料後，請通知所有組員重新匯入（只修改註解則不需要）

## 進度

| 項目 | 狀態 |
|---|---|
| HTML 頁面（6 頁） | ✅ 已完成 |
| PHP（購物車、不使用 cookie 的 session、儲存訂單、扣減存貨、訂單摘要） | ✅ 已完成 |
| SQL 資料庫 | ✅ 已完成 |
| Logo（`images/logo.png`） | ✅ 已完成 |
| CSS（`css/style.css`） | ✅ 已完成（所有頁面） |
| JavaScript（`js/validation.js`） | ⬜ 尚未完成（詳見下面「JavaScript 待辦」） |

## JavaScript 待辦（LIN Zixi）

網站其他部分已經完成，只餘下 JavaScript。以下列出需要完成的三項工作及建議做法。

### 基本資料

- 只需修改 `js/validation.js`；所有頁面已經透過 `includes/header.php` 以 `<script src="js/validation.js" defer="defer"></script>` 載入
- 因為使用了 `defer`，script 會在頁面 HTML 讀取完後才執行，可以直接用 `document.querySelector()` 等找元素
- 同一個檔案會在 6 頁執行，所以每項功能要先檢查該頁有沒有相關元素（例如 `if (form) { ... }`），沒有就略過
- **請勿修改 HTML、PHP 或 CSS**；如需要新的 `id` 或 `class`，請先通知組長
- **每段 JavaScript 都要有英文註解**（評分 Readability 要求「Commenting is expected for JavaScript code」）
- 不可使用 cookie；亦不要用 `localStorage` 保存購物車（購物車由 PHP session 處理）
- PHP 已在伺服器端再檢查一次所有資料，JavaScript 的作用是讓用戶**即時**看到錯誤及結果，毋須等頁面重新載入

### 可使用的 HTML 元素

| 頁面 | 元素 | 說明 |
|---|---|---|
| `shop1/2/3.php` | `form.add-to-cart-form` | 每件產品一個表單，共 5 個 |
| | `input.qty-input`（例如 `id="qty-101"`） | 數量欄，有 `min="1"` 及 `max="存貨"` |
| | `article.product-card` | 有 `data-product-id`、`data-product-name`、`data-unit-price` |
| `cart.php` | `form#checkout-form` | 整個購物車（表格、顧客資料、Buy 按鈕）都在這個表單內 |
| | `input.real-time-qty`（例如 `id="qty-101"`） | 購物車數量欄，有 `min`、`max`、`data-price`（單價） |
| | `span#subtotal-101` | 該產品的小計（數字部分，例如 `9,998.00`） |
| | `span#cart-total` | 總額（數字部分） |
| | `input#customer-name` | 姓名，最多 50 字 |
| | `textarea#address` | 地址，最多 255 字 |
| | `button.buy-button` | Buy 按鈕 |
| | `button.remove-button` | 每行一個 Remove 按鈕（有 `formnovalidate`，用來移除產品） |
| | 表單第一個（隱藏的）按鈕 | 讓用戶在數量欄按 Enter 時更新購物車（`update_cart.php`），**請勿刪除** |

### 任務 1：購物頁按「Add to Cart」前檢查數量

- 數量必須是 **1 至存貨（`max`）之間的整數**；不符合就阻止送出，並顯示英文提示，例如 `Please enter a whole number from 1 to 50.`
- 建議做法：
  - 為每個 `.add-to-cart-form` 加上 `submit` 事件
  - 用 `Number(input.value)` 及 `Number.isInteger()` 檢查，與 `Number(input.max)` 比較
  - 不符合時：`input.setCustomValidity('提示文字')`、`input.reportValidity()`、`event.preventDefault()`
  - 在數量欄的 `input` 事件中用 `input.setCustomValidity('')` 清除提示
  - 好處：使用瀏覽器內置的提示框，**毋須新增 HTML 或 CSS**

### 任務 2：購物車即時計算小計及總額

- 用戶改變數量時，**不用重新載入頁面**，即時更新該行小計及總額
- 建議做法：
  - 為每個 `.real-time-qty` 加上 `input` 事件
  - 產品編號：`input.id.replace('qty-', '')`；單價：`Number(input.dataset.price)`
  - 小計 = 單價 × 數量，寫入 `document.getElementById('subtotal-' + 編號)`
  - 總額 = 把所有有效的小計加起來，寫入 `#cart-total`
  - 數字格式與 PHP 相同：`value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })`（例如 `9998` 顯示為 `9,998.00`）
  - 數量無效（空白、0、小數、超過存貨）時，該行不計入總額

### 任務 3：按「Buy」前檢查所有資料

- 檢查：
  - 姓名不可空白（**只輸入空格也算空白**，用 `.trim()`），最多 50 字
  - 地址不可空白，最多 255 字
  - 每個數量都是 1 至存貨之間的整數
- **注意**：Remove 按鈕及按 Enter 時使用的隱藏按鈕亦在同一個表單內，**不可以阻止它們**。在 `#checkout-form` 的 `submit` 事件中，用 `event.submitter` 判斷是哪個按鈕送出，只有 `event.submitter` 是 `.buy-button` 時才檢查
- 錯誤提示同樣可用 `setCustomValidity()` 及 `reportValidity()`

### 建議的檔案結構

```js
/*
 * File:        js/validation.js
 * Team member: LIN Zixi
 * Purpose:     ...（說明這個檔案做甚麼）
 */

// Helper: format a number like PHP number_format(), e.g. 9998 -> "9,998.00"
function formatMoney(value) { ... }

// Helper: is the quantity a whole number between min and max?
function isValidQuantity(input) { ... }

// Task 1: shopping pages
function setUpAddToCartForms() { ... }

// Task 2: shopping cart quantities
function updateCartTotals() { ... }
function setUpCartQuantities() { ... }

// Task 3: Buy button
function setUpCheckoutForm() { ... }

setUpAddToCartForms();
setUpCartQuantities();
setUpCheckoutForm();
```

### 完成後的測試清單

- [ ] 購物頁：數量輸入 0、-1、1.5、空白、超過存貨，按 Add to Cart 時都被阻止並有提示
- [ ] 購物頁：正常數量可以加入購物車
- [ ] 購物車：改變數量時，小計及總額即時更新，格式與原本相同（例如 `HK$9,998.00`）
- [ ] 購物車：姓名或地址留空（或只有空格）時，按 Buy 被阻止並有提示
- [ ] 購物車：Remove 仍然可以正常移除產品
- [ ] 購物車：在數量欄按 Enter，會更新購物車，不會移除任何產品
- [ ] 其他頁面（首頁、感謝頁）沒有 JavaScript 錯誤（瀏覽器 Console 沒有紅色錯誤）
- [ ] 每段 JavaScript 都有英文註解

## 與組員原稿的差異

組員最初提交的檔案完整保存於 GitHub 的第一個 commit。

- 副檔名由 `.html` 改為 `.php`，使 PHP 能夠執行：`page1` → `index.php`、`page2` → `shop1.php`、`page4` → `shop2.php`、`page3` → `shop3.php`、`page5` → `cart.php`、`page6` → `thankyou.php`
- 各頁重複的 header 及 footer 抽出至 `includes/`，以 `include` 引入
- 介紹文字、產品內容及圖片沒有修改
- 感謝頁訊息改為「Your order has been placed successfully. A summary of your order is shown below.」；購物車及感謝頁表格標題由「Product / Service Plan」改為「Product」（本店只售產品，沒有 service plan）
- 購物頁的「Available quantity」及數量上限、購物車的數量上限，改為從資料庫讀取，下單後會自動減少（HTML 結構不變）
- 購物車表單最前面加入一個隱藏按鈕：在數量欄按 Enter 時會更新購物車（`update_cart.php`）。修正前，按 Enter 會使用表單內第一個 submit 按鈕，即第一行的 Remove，導致第一件產品被移除
- `sql/shop.sql` 的資料庫結構與原稿相同，只修改：第 13 行 `--default` 加一個空格（否則匯入時會出錯），以及更換為購物頁的產品資料（產品編號 101 至 305）
- `sql/shop.sql` 的註解已由 Lo Ching Yu 改為英文；其後再修正 8 行註解（分類名稱改為與網站相同等），SQL 語句沒有改動

## 提交功課（由組長負責）

依照功課指引，最終須提交一個 zip 檔，檔名為 `組號_ChowChunKiu.zip`，內含：

- 所有 `.php`、`.css`、`.js` 檔案，以及 `images/` 及 `sql/shop.sql`
- Word 文件：所有程式碼及 SQL 語句；第一頁頂部列明 SEHS3245、Web Systems and Technologies、提交日期，以及全體組員姓名及學號
- 每位組員的 `.pptx`，檔名為 `組號_姓名_學號.pptx`，請於限期前交給組長

不需放入 zip：`README.md`、`.gitignore`、`.DS_Store`
