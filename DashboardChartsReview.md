# Dashboard Charts and Cards: A Beginner's Review Guide

This guide explains how the ChiikaMart dashboard works from the database up to the visual charts. Use this to review for your teacher's questions!

---

## 🚀 The Data Path: How Data Reaches the Charts

Every chart and card follows the exact same 4-step journey in our code. If your teacher asks "How does the chart get its data?", explain this flow:

1. **The Model (`registrationModel.php`)**: This is where we talk to the database. We write an **SQL Query** to fetch the data we need (e.g., counting users, summing up sales).
2. **The Business Logic (`UserManagement.php`)**: This is a middleman. It calls the Model to get the database results and passes them forward to the View.
3. **The View / Frontend Prep (`Dashboard.php`)**: At the top of our dashboard page, PHP receives the data. We separate it into two lists (Arrays): one for **Labels** (like "January", "February") and one for **Data** (like $500, $800). We then use `json_encode` to convert PHP data into JavaScript variables.
4. **The JavaScript (`DashboardService.js`)**: We use a library called **Chart.js**. Our JS grabs the variables created in Step 3 and draws the lines, bars, or pie slices based on those numbers.

---

## 📊 Summary of Cards (The Top Summary Boxes)

Cards are simple queries that usually return just one single number to give a quick overview.

### 1. Total Sales Revenue
* **What it does:** Shows the total amount of money the store has made.
* **SQL Logic:** 
  ```sql
  SELECT COALESCE(SUM(totalAmount), 0) AS total_sales FROM tbl_orders
  ```
* **Explanation:** `SUM(totalAmount)` adds up all the order totals. `COALESCE(..., 0)` is a safety feature; if there are no orders, it returns 0 instead of a blank "NULL".

### 2. Total Orders
* **What it does:** Shows how many successful purchases have been placed in total.
* **SQL Logic:**
  ```sql
  SELECT COUNT(orderID) AS total_orders FROM tbl_orders
  ```
* **Explanation:** `COUNT()` simply counts the number of rows in the orders table.

### 3. Low Stock / Out of Stock Alerts
* **What it does:** Warns the admin if products are running out.
* **SQL Logic (Low Stock):**
  ```sql
  SELECT COUNT(productID) AS low_stock_count FROM tbl_products WHERE stockQuantity < 5
  ```
* **Explanation:** We count the products *only* `WHERE` the stock quantity is dangerously low (less than 5) or exactly 0.

---

## 📈 Detailed Breakdown: The Charts & Their Variables

Charts require grouping data together (using `GROUP BY` in SQL) to compare different categories. Below is the mapping for *each* chart, detailing its explicit SQL `AS` aliases and the corresponding PHP View variables used to map the arrays.

### 1. Sales Over Time (Line Chart)
* **SQL Connection (Model):** Grabs the formatted month and total revenue using aliases `order_month` and `total_revenue`.
  ```sql
  SELECT DATE_FORMAT(orderDate, '%Y-%m') AS order_month, 
         SUM(totalAmount) AS total_revenue 
  FROM tbl_orders GROUP BY order_month
  ```
* **PHP Variables (View / Dashboard.php):**
  * `Base:` $monthlySales = $usermanagement->getSalesByMonth();
  * `Labels:` $salesLabels = array_column($monthlySales, 'order_month');
  * `Data:` $salesData = array_column($monthlySales, 'total_revenue');
* **Javascript Global:** `window.salesOverTimeData`

### 2. User Registrations (Line Chart)
* **SQL Connection (Model):** Collects new accounts matched to a formatted month.
  ```sql
  SELECT DATE_FORMAT(createdAt, '%Y-%m') AS reg_month, 
         COUNT(userID) AS total_users 
  FROM tbl_users GROUP BY reg_month
  ```
* **PHP Variables (View / Dashboard.php):**
  * `Base:` $monthlyRegistrations = $usermanagement->getRegistrationsByMonth();
  * `Labels:` $registrationLabels = array_column($monthlyRegistrations, 'reg_month');
  * `Data:` $registrationData = array_column($monthlyRegistrations, 'total_users');
* **Javascript Global:** `window.userRegistrationData`

### 3. Order Status (Doughnut Chart)
* **SQL Connection (Model):** Tallies how many orders fall under each status category.
  ```sql
  SELECT s.statusName, 
         COUNT(o.orderID) AS total_orders 
  FROM tbl_order_statuses s 
  LEFT JOIN tbl_orders o ON o.statusID = s.statusID GROUP BY s.statusName
  ```
* **PHP Variables (View / Dashboard.php):**
  * `Base:` $orderStatuses = $usermanagement->getCardOrderStatus();
  * `Labels:` $statusLabels = array_column($orderStatuses, 'statusName');
  * `Data:` $statusData = array_column($orderStatuses, 'total_orders');
* **Javascript Global:** `window.orderStatusData`

### 4. Top Selling Products (Bar Chart)
* **SQL Connection (Model):** Calculates sum of item quantities.
  ```sql
  SELECT p.productName, 
         COALESCE(SUM(oi.quantity), 0) AS total_sold 
  ... GROUP BY p.productName
  ```
* **PHP Variables (View / Dashboard.php):**
  * `Base:` $topSellingProducts = $usermanagement->getTopSellingProducts();
  * `Labels:` $topSellingLabels = array_column($topSellingProducts, 'productName');
  * `Data:` $topSellingData = array_column($topSellingProducts, 'total_sold');
* **Javascript Global:** `window.topSellingData`

### 5. Revenue by Character (Bar Chart)
* **SQL Connection (Model):** Aggregates product income by the character it represents.
  ```sql
  SELECT c.charName, 
         COALESCE(SUM(...), 0) AS total_revenue 
  ... GROUP BY c.charName
  ```
* **PHP Variables (View / Dashboard.php):**
  * `Base:` $revenueByCharacter = $usermanagement->getRevenueByCharacter();
  * `Labels:` $characterRevenueLabels = array_column($revenueByCharacter, 'charName');
  * `Data:` $characterRevenueData = array_column($revenueByCharacter, 'total_revenue');
* **Javascript Global:** `window.revenueByCharacterData`

### 6. Revenue by Collection (Bar Chart)
* **SQL Connection (Model):** Aggregates product income by its parent collection.
  ```sql
  SELECT c.collectionName, 
         COALESCE(SUM(...), 0) AS total_revenue 
  ... GROUP BY c.collectionName
  ```
* **PHP Variables (View / Dashboard.php):**
  * `Base:` $revenueByCollection = $usermanagement->getRevenueByCollection();
  * `Labels:` $collectionRevenueLabels = array_column($revenueByCollection, 'collectionName');
  * `Data:` $collectionRevenueData = array_column($revenueByCollection, 'total_revenue');
* **Javascript Global:** `window.revenueByCollectionData`

### 7. Review Star Distribution (Bar Chart)
* **SQL Connection (Model):** Groups total ratings.
  ```sql
  SELECT ratingValue, 
         COUNT(reviewID) AS total_reviews 
  FROM tbl_reviews GROUP BY ratingValue
  ```
* **PHP Variables (View / Dashboard.php):**
  * `Base:` $reviewStarDistribution = $usermanagement->getReviewStarDistribution();
  * `Labels:` $reviewStarLabels = array_column($reviewStarDistribution, 'ratingValue');
  * `Data:` $reviewStarData = array_column($reviewStarDistribution, 'total_reviews');
* **Javascript Global:** `window.reviewStarData`

### 8. Lowest Stock Watchlist (Bar Chart)
* **SQL Connection (Model):** Grabs quantity for products dropping low in inventory.
  ```sql
  SELECT productName, 
         stockQuantity 
  FROM tbl_products ... 
  ```
* **PHP Variables (View / Dashboard.php):**
  * `Base:` $lowestStockWatchlist = $usermanagement->getLowestStockWatchlist();
  * `Labels:` $lowestStockLabels = array_column($lowestStockWatchlist, 'productName');
  * `Data:` $lowestStockData = array_column($lowestStockWatchlist, 'stockQuantity');
* **Javascript Global:** `window.lowestStockData`

---

## 🔍 Deep Dive Example: The "Top Selling Products" Chart

To get a little more complex and technical, here is the exact variable-by-variable journey for a single chart—The **Top Selling Products** Bar Chart. If your teacher asks you to "trace the data," here is exactly what happens step-by-step:

### Step 1: The Model (SQL Query)
**File:** `registrationModel.php`

```php
public function topSellingProducts() {
    $query = "SELECT p.productName, COALESCE(SUM(oi.quantity), 0) AS total_sold
              FROM tbl_products p ...";
    // ... execution
}
```
**What's happening:** The query groups items by their name. It creates two important column names that we will use as variables later:
*   `productName`: This will act as our Labels (the text under the bars).
*   `total_sold`: This will act as our Data (how tall the bars are).

### Step 2: The Business Logic (BL)
**File:** `UserManagement.php`

```php
public function getTopSellingProducts() {
    $response = $this->regsModel->topSellingProducts();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
```
**What's happening:** The method `getTopSellingProducts()` simply runs the SQL query and returns a multi-dimensional array containing all the `productName` and `total_sold` rows.

### Step 3: The View (PHP Array Processing)
**File:** `Dashboard.php` (Top Section)

```php
// 1. Fetching the raw list of dictionaries from the Business Logic
$topSellingProducts = $usermanagement->getTopSellingProducts();

// 2. Extracting just the column names into flat arrays
$topSellingLabels = array_column($topSellingProducts, 'productName');
$topSellingData = array_column($topSellingProducts, 'total_sold');
```
**What's happening (`array_column`):** 
*   The raw `$topSellingProducts` var looks like: `[ ["productName" => "Plushie A", "total_sold" => 5], ["productName" => "Mug B", "total_sold" => 10] ]`
*   `array_column($topSellingProducts, 'productName')` extracts *only* the names and dumps them into a new variable called `$topSellingLabels`: `["Plushie A", "Mug B"]`.
*   `array_column($topSellingProducts, 'total_sold')` does the same but creates an array of the numbers, stored in `$topSellingData`: `[5, 10]`.

### Step 4: Connecting PHP to JavaScript
**File:** `Dashboard.php` (Bottom Section)

```javascript
<script>
window.topSellingData = {
    labels: <?= json_encode($topSellingLabels) ?>,
    data: <?= json_encode($topSellingData) ?>
};
</script>
```
**What's happening:** We open a `<script>` tag. We create a global JavaScript variable called `window.topSellingData`. We use PHP's `json_encode` to safely inject our `$topSellingLabels` and `$topSellingData` arrays directly into JS.

### Step 5: Rendering the Chart
**File:** `DashboardService.js`

```javascript
var topSellingCanvas = document.getElementById("chartTopSelling");

new Chart(topSellingCanvas, {
    type: "bar",
    data: {
        labels: window.topSellingData.labels, // <--- Connects to Step 4
        datasets: [{
            label: "Units Sold",
            data: window.topSellingData.data, // <--- Connects to Step 4
            backgroundColor: "rgba(77, 96, 118, 0.35)",
        }]
    }
});
```
**What's happening:** We target the `<canvas id="chartTopSelling">` element on our HTML page. Then we tell `Chart.js` to build a `"bar"` chart, using `window.topSellingData.labels` for the X-axis and `window.topSellingData.data` for the Y-axis. 

---

## 🎯 Quick Cheat Sheet Summary for the Teacher

If the teacher asks you to summarize your code architecture:

> "Our application uses a **Layered Architecture**. 
> First, our **Model** (`registrationModel.php`) runs **SQL Queries** to fetch numbers and statistics from the database. 
> Second, our **Business Logic** (`UserManagement.php`) retrieves those results. 
> Third, our **View page** (`Dashboard.php`) turns the PHP data into JSON format so JavaScript can read it. 
> Finally, our **Frontend Script** (`DashboardService.js`) feeds that JSON data into **Chart.js** to draw the visuals on the screen."
