# TechNest – SEHS3245 Group Project

網上電子產品店，用 HTML5 + CSS3 + JavaScript + PHP + MySQL 製作，喺 XAMPP 上面 run。

組員原本交嘅檔案同後來改咗咩，睇 [CHANGES.md](CHANGES.md)。

## 第一次 setup（每人做一次）

1. 裝 **XAMPP** 同 **GitHub Desktop**
2. GitHub Desktop → File → Clone repository → 揀呢個 repo，Local path 揀 `htdocs`：
   - Windows：`C:\xampp\htdocs`
   - Mac：`/Applications/XAMPP/xamppfiles/htdocs`
3. 開 XAMPP，Start **Apache** 同 **MySQL**
4. 開 <http://localhost/phpmyadmin> → Import → 揀 `sql/shop.sql` → Go
5. 喺 browser 開 <http://localhost/technest/>

## 分工（每人只改自己嘅檔）

| 組員 | 頁面 | 負責技術 | 負責嘅檔 |
|---|---|---|---|
| **A**（Leader） | 第 1 頁 Introduction | HTML5 + include | `index.php`、`includes/header.php`、`includes/footer.php`、`images/logo.png` |
| **B** | 第 2 頁 Smartphones & Wearables | CSS3 | `shop1.php`、`css/style.css` |
| **C** | 第 3 頁 Computers & Displays | JavaScript | `shop2.php`、`js/validation.js` |
| **D** | 第 4 頁 Accessories & Smart Home | PHP Session | `shop3.php`、`add_to_cart.php`、`update_cart.php`、`remove_from_cart.php` |
| **E** | 第 5 頁購物車、第 6 頁 Thank-you | SQL + PHP | `cart.php`、`thankyou.php`、`includes/db.php`、`sql/shop.sql` |

## 5 條規則

1. **開工前一定要撳 Pull**（GitHub Desktop：Fetch origin → Pull），寫完即刻 Commit + Push
2. **只改自己負責嘅檔**
3. Commit message 要寫清楚，例如 `B: add hover effect to product cards`
4. 要改共用檔（`header.php`、`footer.php`、`style.css`、`db.php`），**先喺 group chat 講**
5. **唔好 upload zip 檔**，所有嘢都直接放入 repo

改咗 `sql/shop.sql` 嘅話，要喺 group chat 通知大家重新 Import 一次。

## 頁面流程

```
index.php → shop1/2/3.php → add_to_cart.php → cart.php → thankyou.php（存入 MySQL）
                                ↑ update_cart.php / remove_from_cart.php
```

購物車用 `$_SESSION['cart']` 儲存（**唔准用 cookie**）。格式：

```php
$_SESSION['cart']['P101'] = [
    'product_id'   => 'P101',
    'product_name' => 'Nova X1 Smartphone',
    'unit_price'   => 4999.00,
    'quantity'     => 2,
];
```

## 未完成（TODO）

- [ ] **A**：設計 logo，存做 `images/logo.png`；介紹文字改寫成自己嘅講法（上限 600 字）
- [ ] **B**：寫 `css/style.css`（class 名已經列喺檔案頂）
- [ ] **C**：寫 `js/validation.js`（數量檢查、即時計 subtotal、Buy 之前檢查客人資料）
- [ ] **D**：寫 `add_to_cart.php`、`update_cart.php`、`remove_from_cart.php`
- [ ] **E**：`thankyou.php` 寫入 `orders` 同 `order_details`
- [ ] **E + C**：購物車頁加客人姓名同地址欄位（`orders` table 需要）
- [ ] **B + C + D**：考慮由 `products` table 讀產品，再用 PHP `foreach` 印出產品卡，避免 15 張卡 code 重複（Readability 分）
- [ ] 縮細 `images/p202.jpg`（3284×1736 px，太大）

## 交功課（Leader）

最後要交一個 zip，入面有：所有 code、Word 檔（所有 code + SQL，第一頁頂要有 SEHS3245、Web Systems and Technologies、交功課日期、全組姓名同學號）、每人一份 `組號_姓名_學號.pptx`。zip 檔名：`組號_Leader名.zip`。

Comment 一律用英文寫，因為 lecturer 會睇。
