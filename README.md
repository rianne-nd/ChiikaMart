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

## 📄 File Descriptions & Detailed Walkthroughs

### 1. `bl/UserManagement.php` (The Brain)

This file contains the core logic inside the `UserManagement` class. Think of it as the middleman between the Controller (handling the user's click) and the Model (the database). Recently, we updated this file to start pushing new users directly to the actual MySQL database instead of the temporary PHP session.

| Function | Parameters | Description / How it works |
|---|---|---|
| `__construct()` | — | The "Setup" function. When this class is called, it automatically establishes the database connection using the `Database` class and opens up the `Registration` model so we can run SQL queries. |
| `addUserFunc()` | `$firstName`, `$lastName` | Takes the typed-in names and passes them directly to the `createRegistration` method. This saves the user to the `tbl_registration` table in the database. |
| `updateUserFunc()` | `$firstName`, `$lastName`, `$userID` | *Legacy:* Currently updates the `FirstName` and `LastName` of the user inside the temporary PHP `$_SESSION` array. |
| `deleteUserFunc()` | `$userID` | *Legacy:* Removes the targeted user from the `$_SESSION` array by using PHP's `unset()` function, then re-indexes the array cleanly. |
| `getUser()` | — | *Legacy:* Fetches and returns all currently tracked users from `$_SESSION['userArray']`. If there's no session, it safely returns an empty array. |
| `loginUserFunc()` | `$firstName`, `$lastName` | Searches the current session array for matched names. It replies with `"true"` if the user exists, and `"false"` if they do not. |

---

### 2. `model/database.php` (The MySQL Connection)

This file connects our PHP code to the MySQL Database program (typically running via XAMPP). We use **PDO (PHP Data Objects)** because it is highly secure and prevents hackers from bypassing inputs (SQL Injection).

| Function | Parameters | Description / How it works |
|---|---|---|
| `connect()` | — | Connects to `projectappdev_db`. **Crucial Detail:** We specifically route the connection to port `3307`. This bypasses default XAMPP connection errors (like "driver not found" or "Access denied") that happen if another local MySQL process is holding the default 3306 port hostage! |

---

### 3. `model/registrationModel.php` (Database Queries)

This file handles the exact native SQL text commands that talk to the actual database structure.

| Function | Parameters | Description / How it works |
|---|---|---|
| `__construct()` | `$db` | It catches the live database connection (from `database.php`) and saves it inside the class so the other functions can use it to talk to MySQL. |
| `createRegistration()` | `$firstName, $lastName` | Prepares a secure SQL statement: `INSERT INTO tbl_registration...`. It safely "binds" `$firstName` and `$lastName` to the query, alongside automatic timestamp variables for `createdAt` and `updatedAt`, then executes the push! |

---

### 4. `controllers/UserController.php` (The Traffic Cop)

Imagine you have 4 different buttons clicking at once. This file acts as the router. It listens strictly to **POST requests** (data sent safely behind the scenes). 

| POST Keys Detected | Action It Triggers in Business Logic |
|---|---|
| If `fname` and `lName` are received | Triggers `addUserFunc()` → Adds user to DB |
| If `uFName`, `uLName`, and `uID` are received | Triggers `updateUserFunc()` → Modifies user |
| If `dID` is received | Triggers `deleteUserFunc()` → Erases user |
| If `lFName` and `lLName` are received | Triggers `loginUserFunc()` → Tries to log in |

---

### 5. `scripts/Service.js` (The Client-Side Magic)

This JavaScript file is loaded on the user's browser. It uses **jQuery AJAX** to magically talk to `UserController.php` *without* making the browser page refresh or flicker! It also triggers **SweetAlert2** popups for a beautiful user experience. 

| Function | Parameters | Description / How it works |
|---|---|---|
| `addFunc()` | — | Reads the text typed into the First Name & Last Name boxes. Behind the scenes, it sends a secret POST package to the Controller. On success, it pops up a green SweetAlert checkmark and auto-reloads the page to show the new data. |
| `updateFunc()` | `userID` | Grabs the user's ID, sends the new name inputs to the Controller, pops up an alert, and refreshes the table. |
| `deleteFunc()` | `userID` | Warns the user, sends a destructive POST command containing the ID to the Controller, alerts success, and refreshes. |
| `redirectFunc()` | `redirectID` | Simple navigation. `1` takes you to Login, `2` to Dashboard, and `3` to Registration. |
| `loginFunc()` | — | Captures typed login names and asks the Controller if they are valid. If `"true"`, sends the user to the Dashboard. If `"false"`, shows a red error popup. |

---

### 6. `views/RegistrationPage.php` (The Main User Interface)

This page is what the user interacts with. It includes:
1.  **A Navigation Bar** to redirect around the site.
2.  **Input Forms** (First Name, Last Name, and the **ADD** button).
3.  **An Interactive Table**: Displays all user data cleanly.
    *   *Beginner Note:* Recently upgraded by utilizing **DataTables**. DataTables is a powerful script that turns a boring standard HTML table into a dynamic, highly interactive application complete with instant Searching, Sorting (A-Z), and Page Pagination!

---

## 🧰 Tech Stack & Dependencies Explained

What external tools are we using to make this project look and feel modern?

| Library / Tool | Version | What is it used for? |
|---|---|---|
| [jQuery](https://jquery.com/) | 3.7.1 | A Javascript tool that makes writing AJAX (background server requests) and finding HTML elements incredibly easy. |
| [DataTables](https://datatables.net/) | 2.3.7 | A Javascript plugin attached to jQuery used in `RegistrationPage.php` to magically add a search bar, page numbers, and column sorting to our user table. |
| [SweetAlert2](https://sweetalert2.github.io/) | 11 | Replaces ugly, default browser alert warnings with gorgeous, customized popup modals. |
| [Materialize CSS](https://materializecss.com/) | 1.0.0 | A CSS framework by Google. It gives us beautiful buttons, grids, and input fields without writing hundreds of lines of our own CSS. |

---

## ⚙️ Step-By-Step Process: Visualizing Data Flow

As a beginner, tracking how moving parts talk to each other is vital. Let's trace the exact lifecycle of what happens when you decide to register a brand new user in the app.

1.  **The User Interaction (View)**
    The user is sitting on `RegistrationPage.php`. They type "John" and "Doe" into the text fields and click the **ADD** button.
2.  **The Javascript Intercept (Service.js)**
    The click triggers `addFunc()` inside `Service.js`. The Javascript grabs the text "John" and "Doe", packages them into variables called `fname` and `lName`. It then silently sends them (via an AJAX POST request) to `UserController.php`. 
3.  **The Traffic Cop (Controller)**
    `UserController.php` receives the hidden package. Because it detects the keys `fname` and `lName`, it knows exactly what to do. It immediately triggers the `addUserFunc()` located in the Business Logic layer.
4.  **The Brain Checks the Request (Business Logic)**
    `UserManagement.php` wakes up. It receives "John" and "Doe". It recognizes we need to save this permanently, so it signals the MySQL Database Model (`registrationModel.php`) to prepare a `createRegistration()` action.
5.  **The Cabinet Saves the File (Model & Database)**
    `registrationModel.php` receives the data. It connects to the MySQL Server on port 3307 using `database.php`. It securely translates the data into an SQL string: `INSERT INTO tbl_registration (firstName, lastName)...` and fires it into the database. John Doe is now permanently saved!
6.  **The Reply & The Reload (Back to View)**
    A success signal cascades back up the chain to the Controller, which replies to `Service.js` saying "Target Aquired!". `Service.js` flashes a beautiful SweetAlert2 checkmark to the user, and finally refreshes the page so the brand new DataTables list can show John Doe sitting in the table.
