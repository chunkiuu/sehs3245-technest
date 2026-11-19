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
| **Chow Chun Kiu**（組長） | PHP | `includes/session.php`、`includes/db.php`、`add_to_cart.php`、`remove_from_cart.php`、`place_order.php`，以及 `shop1/2/3.php`、`cart.php`、`thankyou.php` 的 PHP 部分 |
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
| CSS（`css/style.css`） | ✅ 已完成（所有頁面，包括響應式設計及動畫） |
| JavaScript（`js/validation.js`） | ⬜ 尚未完成 |

## 與組員原稿的差異

組員最初提交的檔案完整保存於 GitHub 的第一個 commit。

- 副檔名由 `.html` 改為 `.php`，使 PHP 能夠執行：`page1` → `index.php`、`page2` → `shop1.php`、`page4` → `shop2.php`、`page3` → `shop3.php`、`page5` → `cart.php`、`page6` → `thankyou.php`
- 各頁重複的 header 及 footer 抽出至 `includes/`，以 `include` 引入
- 介紹文字、產品內容及圖片沒有修改
- 感謝頁訊息改為「Your order has been placed successfully. A summary of your order is shown below.」；購物車及感謝頁表格標題由「Product / Service Plan」改為「Product」（本店只售產品，沒有 service plan）
- 購物頁的「Available quantity」及數量上限、購物車的數量上限，改為從資料庫讀取，下單後會自動減少（HTML 結構不變）
- `sql/shop.sql` 的資料庫結構與原稿相同，只修改：第 13 行 `--default` 加一個空格（否則匯入時會出錯），以及更換為購物頁的產品資料（產品編號 101 至 305）
- `sql/shop.sql` 的註解已由 Lo Ching Yu 改為英文；其後再修正 8 行註解（分類名稱改為與網站相同等），SQL 語句沒有改動

## 提交功課（由組長負責）

依照功課指引，最終須提交一個 zip 檔，檔名為 `組號_ChowChunKiu.zip`，內含：

- 所有 `.php`、`.css`、`.js` 檔案，以及 `images/` 及 `sql/shop.sql`
- Word 文件：所有程式碼及 SQL 語句；第一頁頂部列明 SEHS3245、Web Systems and Technologies、提交日期，以及全體組員姓名及學號
- 每位組員的 `.pptx`，檔名為 `組號_姓名_學號.pptx`，請於限期前交給組長

不需放入 zip：`README.md`、`.gitignore`、`.DS_Store`
