# ChiikaMart - User Management System

Welcome to the **ChiikaMart Project**! This is an educational PHP application designed to teach beginner developers about fundamental web development concepts, featuring a complete catalog UI and user management dashboard.

Following an **MVC-style (Model-View-Controller) architecture**, the application is broken down into specific folders to keep the code organized, scalable, and easy to understand.

---

## 🏗️ The MVC Architecture Explained (For Beginners)

Before diving into the files, it's highly important to understand how the code is organized. We separate our code into different "Layers" so that HTML doesn't get tangled up with Database code.

*   **Views (`/views`)**: This is what the user *sees*. It contains the HTML, CSS, and structural design. It is the "Face" of the application.
*   **Controllers (`/controllers`)**: This is the "Traffic Cop". When a user clicks a button, the request goes to the controller. The controller looks at the request and decides where to send it.
*   **Business Logic (`/bl`)**: This is the "Brain". It processes the data, applies rules, and decides what actions need to be taken before saving or fetching data.
*   **Models (`/model`)**: This is the "Filing Cabinet". It is exclusively responsible for talking to the MySQL database. It writes data (INSERT) and reads data (SELECT).

---

## 📂 Project Structure

```text
ChiikaMart/
├── bl/
│   └── UserManagement.php       # Business logic - Processes user operations and dashboard stats
├── config/                      # Configuration files (e.g., mail.php)
├── controllers/
│   └── UserController.php       # Request router - Traffic cop for POST requests
├── helper/                      # Helper scripts (e.g., sendEmail.php)
├── images/                      # Image assets (Themed Chiikawa product images)
├── model/                       # Models & DB Config
│   ├── database.php             # Establishes the PDO database connection
│   └── registrationModel.php    # Handles SQL queries (INSERT, SELECT, UPDATE, DELETE)
├── Notes/
│   └── Week10Notes.md            # Chart.js lecture notes and setup steps
├── ResourcesForProject/          # Chart.js reference notes and SQL plan
│   ├── App Dev.md
│   ├── SQLCode.md
│   ├── bar.md
│   ├── line.md
│   └── doughnut.md
├── scripts/
│   ├── Service.js               # Client-side JavaScript (AJAX, SweetAlerts, Validation)
│   └── DashboardService.js      # Chart.js rendering for the dashboard
├── vendor/                      # Composer dependencies (PHPMailer, etc.)
├── views/
│   ├── Dashboard.php            # Admin dashboard view with charts and user tables
│   ├── HomePage.php             # Main storefront / catalog page
│   ├── LoginPage.php            # Login form view
│   └── RegistrationPage.php     # Full registration form 
└── README.md                    # You are reading this file!
```

---

## 📄 File Descriptions & Detailed 

### 1. `bl/UserManagement.php` (The Brain)

This file contains the core logic inside the `UserManagement` class. Think of it as the middleman between the Controller (handling the user's click) and the Model (the database). 

| Function | Parameters | Description / How it works |
|---|---|---|
| `__construct()` | — | The "Setup" function. Automatically establishes the database connection using the `Database` class and opens up the `Registration` model. |
| `addUserFunc()` | `$firstName` to `$zipCode` (12 params) | Passes all user details to the model to save to the database. Replies with `"true"` or `"false"`. |
| `updateUserFunc()` | `$firstName`, `$lastName`, `$userID` | Updates the chosen user's first and last name in the DB. |
| `deleteUserFunc()` | `$userID` | Removes the targeted user from the database. |
| `getUser()` | — | Fetches and returns all registered users natively from the `tbl_users` database table. |
| `loginUserFunc()` | `$email`, `$password` | Searches the database for the given email, and utilizes `password_verify()` to confirm the string matches the hash stored in the DB. |
| `getCardOrderStatus()` | — | Fetches order statuses from `tbl_order_statuses` and `tbl_orders` for the dashboard chart. |
| `getCardCharacterInventory()` | — | Fetches product character inventory from `tbl_characters` and `tbl_products`. |
| `getCardProductCollection()` | — | Fetches collection stats from `tbl_collections` and `tbl_products`. |
| `getTotalSalesRevenue()` | — | Uses `SUM(totalAmount)` from `tbl_orders` to calculate total shop revenue. |
| `getTotalOrders()` | — | Uses `COUNT(orderID)` from `tbl_orders` to calculate total order volume. |
| `getLowStockCount()` | — | Counts products where `stockQuantity < 5`. |
| `getOutOfStockCount()` | — | Counts products where `stockQuantity = 0`. |
| `getTotalUsers()` | — | Counts all users from `tbl_users`. |
| `getMostWishlisted()` | — | Finds the most wishlisted product with its total wishlist count. |
| `getAverageRating()` | — | Calculates average rating from approved reviews in `tbl_reviews`. |
| `getSalesByMonth()` | — | Returns monthly revenue data for the sales trend chart. |
| `getRegistrationsByMonth()` | — | Returns monthly user registrations for the trend chart. |
| `getTopSellingProducts()` | — | Returns the top 5 products by total units sold. |
| `getRevenueByCharacter()` | — | Aggregates revenue grouped by character. |
| `getRevenueByCollection()` | — | Aggregates revenue grouped by collection. |
| `getReviewStarDistribution()` | — | Counts how many reviews exist per star rating. |
| `getLowestStockWatchlist()` | — | Returns the 5 products closest to zero stock. |

---

### 🔗 2. `model/database.php` (The MySQL Connection)

This file connects our PHP code to the MySQL Database program. We use **PDO (PHP Data Objects)**.

| Function | Parameters | Description / How it works |
|---|---|---|
| `connect()` | — | Connects to `chiikamart_db`. **Crucial Detail:** We specifically route the connection to port `3307`. This bypasses default XAMPP connection errors if another local MySQL process is using 3306! |

---

### 🗃️✍️ 3. `model/registrationModel.php` (Database Queries)

This file handles the exact native SQL queries and database manipulation that talk to the actual database structure.

| Function | Parameters | Description / How it works |
|---|---|---|
| `__construct()` | `$db` | Catches the live database connection (from `database.php`) and saves it inside the class. |
| `createRegistration()` | `$firstName` to `$zipCode` (12 params) | Hashes the password securely using `PASSWORD_ARGON2ID`. Prepares an `INSERT INTO tbl_users` statement, safely binds all 12 user details alongside timestamps, and executes. |
| `updateRegistration()` | `$firstName`, `$lastName`, `$userID` | Prepares an `UPDATE tbl_users` statement to modify the user's name based on their ID. |
| `deleteRegistration()` | `$userID` | Prepares a `DELETE FROM tbl_users` statement. |
| `readRegistration()` | — | Prepares a `SELECT * FROM tbl_users` statement to grab all registered users. |
| `checkLoginDetails()` | `$email` | Prepares a secure `SELECT * FROM tbl_users WHERE email = :email`. Fetches the result to compare passwords during login. |
| Dashboard Chart Functions | — | `cardOrderStatus()`, `cardInventoryCharacter()`, and `cardProductCollection()` run specific `LEFT JOIN` counting queries to fuel the admin dashboard charts. |
| `totalSalesRevenue()` | — | `SUM(totalAmount)` from `tbl_orders` for total revenue. |
| `totalOrders()` | — | `COUNT(orderID)` from `tbl_orders` for overall order volume. |
| `lowStockCount()` | — | Counts products where `stockQuantity < 5`. |
| `outOfStockCount()` | — | Counts products where `stockQuantity = 0`. |
| `totalUsers()` | — | Counts all users in `tbl_users`. |
| `mostWishlisted()` | — | Finds the most wishlisted product using `tbl_wishlists` and `tbl_products`. |
| `averageRating()` | — | Averages approved ratings from `tbl_reviews`. |
| `salesByMonth()` | — | Monthly revenue grouping using `DATE_FORMAT(orderDate, '%Y-%m')`. |
| `registrationsByMonth()` | — | Monthly registrations using `DATE_FORMAT(createdAt, '%Y-%m')`. |
| `topSellingProducts()` | — | Top 5 products by total quantity sold using `tbl_order_items`. |
| `revenueByCharacter()` | — | Revenue totals grouped by character. |
| `revenueByCollection()` | — | Revenue totals grouped by collection. |
| `reviewStarDistribution()` | — | Count of reviews per rating value. |
| `lowestStockWatchlist()` | — | 5 products with the lowest stock. |

---

### 🚦⛕ 4. `controllers/UserController.php` (The Traffic Cop)
Acts as the request router. Starts the session, instantiates `UserManagement`, listens strictly to **POST requests**, and delegates incoming POST requests to the appropriate business logic method.

| POST Keys Detected | Action It Triggers in Business Logic |
|---|---|
| `aFName` through `aZipCode` | Triggers `addUserFunc()` → Adds user to DB safely hashed |
| `uFName`, `uLName`, `uID` | Triggers `updateUserFunc()` → Modifies user's name |
| `dID` | Triggers `deleteUserFunc()` → Erases user |
| `lEmail`, `lPassword` | Triggers `loginUserFunc()` → Tries to securely log in |

---

### 🚪⚠️ 5. `scripts/Service.js` (The Client-Side Magic)

This JavaScript file is loaded on the user's browser. It uses **jQuery AJAX** to magically talk to `UserController.php` *without* making the browser page refresh or flicker! It also triggers **SweetAlert2** popups and handles input validation.

| Function | Parameters | Description / How it works |
|---|---|---|
| `addFunc()` | — | Reads all 12 registration inputs. Validates if passwords match. Sends a POST package to the Controller. On success, shows a green SweetAlert and redirects to Login. |
| `updateFunc()` | `userID` | Reads `txtFirstname` and `txtLastname`, sends the new name to the Controller at the given `userID`, alerts success, and refreshes. |
| `deleteFunc()` | `userID` | Warns the user, sends a POST command containing the given `userID` to the Controller, alerts success, and refreshes. |
| `redirectFunc()` | `redirectID` | Simple navigation. `1`: Login, `2`: Dashboard, `3`: Registration, `4`: HomePage. |
| `loginFunc()` | — | Captures email/password, validates if empty, and asks the Controller. If `"true"`, sends the user to the HomePage. |
| `allowOnlyNumber()` | `element` | A validation script ensuring users can only type numbers into the Phone Number and Zip Code input fields. |

---

## 🧰 Tech Stack & Dependencies Explained

What external tools are we using to make this project look and feel modern?

| Library / Tool | Version | What is it used for? |
|---|---|---|
| [jQuery](https://jquery.com/) | 3.7.1 | Makes writing AJAX (background server requests) incredibly easy. |
| [DataTables](https://datatables.net/) | 2.3.7 | Adds magic search bars, numbers, and sorting to our user table. |
| [SweetAlert2](https://sweetalert2.github.io/) | 11 | Beautiful Success/Error dialog popups. |
| [Chart.js](https://www.chartjs.org/) | CDN | Renders the dashboard charts (bar, line, doughnut). |
| [Tailwind CSS](https://tailwindcss.com/) | CDN | A utility-first CSS framework for rapid UI styling. |

---

## ⚙️ Step-By-Step Process: Visualizing Data Flow

Let's trace the exact lifecycle of what happens when you register a brand new user in the app.

1.  **The User Interaction (View)**
    The user is sitting on `RegistrationPage.php`. They type their details ("John", "john@email.com", etc.) into the text fields and click the Register button.
2.  **The Javascript Intercept (Service.js)**
    The click triggers `addFunc()` inside `Service.js`. The Javascript grabs all 12 inputs, checks if the passwords match, and packages them into variables (like `aFName`, `aEmail`). It then silently sends them (via an AJAX POST request) to `UserController.php`. 
3.  **The Traffic Cop (Controller)**
    `UserController.php` receives the hidden package. Because it detects the keys `aFName... aZipCode`, it immediately triggers the `addUserFunc()` located in the Business Logic layer.
4.  **The Brain Checks the Request (Business Logic)**
    `UserManagement.php` wakes up. It receives the inputs, recognizes we need to save this permanently, and signals the MySQL Database Model (`registrationModel.php`) to prepare a `createRegistration()` action.
5.  **The Cabinet Saves the File (Model & Database)**
    `registrationModel.php` receives the data. It connects to the MySQL Server on port `3307` using `database.php`. It securely hashes the password with `PASSWORD_ARGON2ID`, translates the data into an SQL string: `INSERT INTO tbl_users...` and fires it into the database. John Doe is now permanently saved!
6.  **The Reply & The Redirect (Back to View)**
    A success signal cascades back up the chain to the Controller, which replies to `Service.js` saying "true". `Service.js` flashes a beautiful SweetAlert2 checkmark to the user, and finally redirects them to the Login page (`redirectFunc(1)`).
   - `views/LoginPage.php` for login
   - `views/RegistrationPage.php` for registration
   - `views/HomePage.php` and `views/Dashboard.php` after navigation

---

## 📊 Dashboard Chart Data Flow (Chart.js)

1. **Dashboard.php loads the data**
    The dashboard calls `UserManagement` methods that return aggregated stats (totals, counts, and grouped results).
2. **PHP converts DB rows into arrays**
    It uses `array_column()` to extract chart labels and dataset arrays.
3. **PHP passes arrays to JavaScript**
    It embeds `window.*` objects with `json_encode()` (e.g., `window.salesOverTimeData`).
4. **DashboardService.js renders the charts**
    The dashboard-only script reads the `window.*` objects and creates Chart.js charts on matching `<canvas>` elements.
5. **Future improvement**
    The chart logic can be moved into a dedicated dashboard JS file without changing the PHP data flow.
