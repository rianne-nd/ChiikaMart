
# 1811 - User Management System

Welcome to the **1811 - User Management Project**! This is an educational PHP application designed to teach beginner developers about fundamental web development concepts. 

Currently, the project is in a **transitional phase**, migrating from a temporary "Session-based" storage system (where data is saved in your browser's temporary memory) to a persistent "Database" storage system (where data is permanently saved in a MySQL database). 

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
1811/
├── bl/
│   └── UserManagement.php       # Business logic - Processes user operations
├── controllers/
│   └── UserController.php       # Request router - Traffic cop for POST requests
├── css/                         # Stylesheets (Empty for now)
├── images/                      # Image assets (Empty for now)
├── model/                       # Models & DB Config
│   ├── database.php             # Establishes the PDO database connection
│   └── registrationModel.php    # Handles SQL queries (INSERT, SELECT)
├── scripts/
│   └── Service.js               # Client-side JavaScript (AJAX, SweetAlerts)
├── views/
│   ├── Dashboard.php            # Blank dashboard view
│   ├── LoginPage.php            # Login form view
│   └── RegistrationPage.php     # Registration form and DataTables user list
└── README.md                    # You are reading this file!
└── PROGRESS.md                  # A timeline log of project milestones made
```

---

## 📄 File Descriptions & Detailed 

### 1. `bl/UserManagement.php` (The Brain)

This file contains the core logic inside the `UserManagement` class. Think of it as the middleman between the Controller (handling the user's click) and the Model (the database). Recently, we updated this file to start pushing new users directly to the actual MySQL database instead of the temporary PHP session.

| Function | Parameters | Description / How it works |
|---|---|---|
| `__construct()` | — | The "Setup" function. When this class is called, it automatically establishes the database connection using the `Database` class and opens up the `Registration` model so we can run SQL queries. |
| `addUserFunc()` | `$firstName, $lastName, $suffix, $birthday, $phone, ...` | Takes all the typed-in user details and passes them directly to the `createRegistration` method. This saves the user to the `users` table in the database. |
| `updateUserFunc()` | `$firstName`, `$lastName`, `$userID` | Sends the updated user data to `regsModel->updateRegistration()` to modify an existing record in the database. |
| `deleteUserFunc()` | `$userID` | Sends the ID to `regsModel->deleteRegistration()` to permanently remove a user from the database. |
| `getUser()` | — | Fetches all currently tracked users directly from the database through `regsModel->readRegistration()`. |
| `loginUserFunc()` | `$email`, `$password` | Uses `regsModel->checkLoginDetails()` to query the database and verify the email and password combination instead of searching temporary session memory. |

---

### 🔗 2. `model/database.php` (The MySQL Connection)

This file connects our PHP code to the MySQL Database program (typically running via XAMPP). We use **PDO (PHP Data Objects)**.

| Function | Parameters | Description / How it works |
|---|---|---|
| `connect()` | — | Connects to `chiikamart_db`. **Crucial Detail:** We specifically route the connection to port `3307`. This bypasses default XAMPP connection errors (like "driver not found" or "Access denied") that happen if another local MySQL process is holding the default 3306 port hostage! |

---

### 🗃️✍️ 3. `model/registrationModel.php` (Database Queries)

This file handles the exact native SQL queries and database manipulation that talk to the actual database structure.

| Function | Parameters | Description / How it works |
|---|---|---|
| `__construct()` | `$db` | It catches the live database connection (from `database.php`) and saves it inside the class so the other functions can use it to talk to MySQL. |
| `createRegistration()` | `$firstName, $lastName, $suffix, ...` | Prepares and execute an SQL statement: `INSERT INTO users...`. It "binds" all input data to the query, alongside automatic timestamp variables for `createdAt` and `updatedAt`, then executes the push! |
| `updateRegistration()` | `$firstName, $lastName, $userID` | Prepares and executes an `UPDATE users` statement. Modifies the existing user's first/last name using the unique ID and syncs the new `updatedAt` timestamp. |
| `deleteRegistration()` | `$userID` | Prepares and executes a `DELETE FROM users` statement, completely removing the specific user record targeting their unique ID. |
| `readRegistration()` | — | Prepares and executes a `SELECT * FROM users` statement to fetch users from the database. |
| `checkLoginDetails()` | `$email`, `$password` | Performs a `SELECT` query on the `users` table looking for an exact match of the provided email and password. Returns the user details if found, or false if unauthorized. |

---

### 🚦⛕ 4. `controllers/UserController.php` (The Traffic Cop)
Acts as the request router. 
Starts the session, instantiates `UserManagement`, it listens strictly to **POST requests** (data sent safely behind the scenes) and delegates incoming POST requests to the appropriate business logic method based on which POST keys are present.. 

| POST Keys Detected | Action It Triggers in Business Logic |
|---|---|
| If all registration fields (`aFName`, `aLName`, `aEmail`, `aPassword`...) are received | Triggers `addUserFunc()` → Adds fully populated user to DB |
| If `uFName`, `uLName`, and `uID` are received | Triggers `updateUserFunc()` → Modifies user |
| If `dID` is received | Triggers `deleteUserFunc()` → Erases user |
| If `lEmail` and `lPassword` are received | Triggers `loginUserFunc()` → Verifies credentials in Database |

---

### 🚪⚠️ 5. `scripts/Service.js` (The Client-Side Magic)

This JavaScript file is loaded on the user's browser. It uses **jQuery AJAX** to magically talk to `UserController.php` *without* making the browser page refresh or flicker! It also triggers **SweetAlert2** popups for a beautiful user experience. 

| **Function** | **Parameters** | **Description / How it works** |
|---|---|---|
| `addFunc()` | — | Reads all registration input values (Name, Email, Password, Address, etc.) and validates that passwords match. Behind the scenes, it sends the full POST package to the Controller. On success, it pops up a green SweetAlert checkmark and auto-reloads the page to show the new data. |
| `updateFunc()` | `userID` | Reads `txtFirstname` and `txtLastname` input values, grabs the user's ID, sends the new name inputs to the Controller at the given `userID`, pops up an alert, and refreshes the table. |
| `deleteFunc()` | `userID` | Warns the user, sends a destructive POST command containing the given `userID` to the Controller, alerts success, and refreshes. |
| `redirectFunc()` | `redirectID` | Simple navigation. `1` takes you to Login, `2` to Dashboard, and `3` to Registration. |
| `loginFunc()` | — | Captures `txtLoginEmail` and `txtLoginPassword` input values and asks the Controller if they are valid. If `"true"`, sends the user into the App. If `"false"`, shows a red error popup. |
| `$(document).ready()` | — | **New:** Initializes DataTables right when the page loads, moved here for cleaner separation of Javascript from HTML view files. |

---

### 6. `views/RegistrationPage.php` (The Main User Interface)

This page is what the user interacts with. It includes:
1.  **A Navigation Bar** to redirect around the site.
2.  **Input Forms** (First Name, Last Name, and the **ADD** button).
3.  **An Interactive Table**: Displays all user data cleanly.
    *   *Beginner Note:* Recently upgraded by utilizing **DataTables**. DataTables is a powerful script that turns a boring standard HTML table into a dynamic, highly interactive application complete with instant Searching, Sorting (A-Z), and Page Pagination! Initialization has been cleanly moved to `Service.js`.

---

## 🧰 Tech Stack & Dependencies Explained

What external tools are we using to make this project look and feel modern?

| Library / Tool | Version | What is it used for? |
|---|---|---|
| [jQuery](https://jquery.com/) | 3.7.1 | A Javascript tool that makes writing AJAX (background server requests) and finding HTML elements incredibly easy. |
| [DataTables](https://datatables.net/) | 2.3.7 | A Javascript plugin attached to jQuery used in `RegistrationPage.php` to magically add a search bar, page numbers, and column sorting to our user table. |
| [SweetAlert2](https://sweetalert2.github.io/) | 11 | Success/error dialog modals |
| [Materialize CSS](https://materializecss.com/) | 1.0.0 | A CSS framework by Google. It gives us beautiful buttons, grids, and input fields without writing hundreds of lines of our own CSS. |

---

## ⚙️ Step-By-Step Process: Visualizing Data Flow

As a beginner, tracking how moving parts talk to each other is vital. Let's trace the exact lifecycle of what happens when you decide to register a brand new user in the app.

1.  **The User Interaction (View)**
    The user is sitting on `RegistrationPage.php`. They fill out all the fields (Name, Email, Password, Address, etc.) and click the **ADD** button.
2.  **The Javascript Intercept (Service.js)**
    The click triggers `addFunc()` inside `Service.js`. The Javascript grabs all the text inputs, validates them (e.g., checking if passwords match), packages them into variables (like `aFName`, `aEmail`), and silently sends them (via an AJAX POST request) to `UserController.php`. 
3.  **The Traffic Cop (Controller)**
    `UserController.php` receives the hidden package. Because it detects the wide array of new registration POST keys, it knows exactly what to do and triggers `addUserFunc()` in the Business Logic layer with all the collected arguments.
4.  **The Brain Checks the Request (Business Logic)**
    `UserManagement.php` wakes up. It takes all the provided fields and delegates them directly to the MySQL Database Model (`registrationModel.php`) to prepare a `createRegistration()` action.
5.  **The Cabinet Saves the File (Model & Database)**
    `registrationModel.php` receives the exact data. It connects to the MySQL Server on port 3307 using `database.php`. It securely translates the data into a parameterized SQL string: `INSERT INTO users (firstName, lastName, email, password)...` and fires it into the database. The comprehensive user profile is now permanently saved!
6.  **The Reply & The Reload (Back to View)**
    A success signal cascades back up the chain to the Controller, which replies to `Service.js` saying "Target Aquired!". `Service.js` flashes a beautiful SweetAlert2 checkmark to the user, and finally refreshes the page so the brand new DataTables list can show John Doe sitting in the table.
