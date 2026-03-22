# 🌸 Chiikamart Integration: Midterm Master Plan

This document outlines the granular, step-by-step technical implementation plan for migrating the project to the `chiikamart_db`. It replaces temporary session-based arrays with actual database queries to fulfill your Midterm requirements: **1. Login, 2. Register, 3. Dashboard (Admin), 4. Database**.

---

## [ ] Phase 1: Database Initialization (Foundation)
**Goal:** Prepare the MySQL database and update the PDO connection to target the new tables.
- [ ] **Step 1:** Open `phpMyAdmin` and run the full `chiikamart_db` SQL setup script.
- [ ] **Step 2:** Open `1811/model/database.php`.
  - **Variables to Update:** 
    - Change `private $db_name = "projectappdev_db";` to `private $db_name = "chiikamart_db";`.
    - Ensure `private $port = "3307";` remains correctly configured.

---

## [x] Phase 2: Update Models (The Data Layer)
**Goal:** Restructure the SQL queries in your model to interact with the new `users` table instead of `tbl_registration`. Note that `createdAt` and `updatedAt` are MANDATORY for all tables and inserts.
- [x] **Step 1:** Open `1811/model/registrationModel.php`.
- [x] **Step 2:** Modify the Registration Method.
  - **Method to Update:** Change `createRegistration($firstName, $lastName)` to `createRegistration($firstName, $email, $password, $roleID = 2)`. *(Note: Role 2 is Customer).*
  - **SQL to Update:** Change the prepared statement to:
    `INSERT INTO users (firstName, email, password, roleID, createdAt, updatedAt) VALUES (:firstName, :email, :password, :roleID, :createdAt, :updatedAt)`
  - Bind the new parameters safely, and keep the existing `$dateNow` logic to guarantee `createdAt` and `updatedAt` are populated.
- [x] **Step 3:** Add the Login Read Method.
  - **Method to Create:** `getUserByEmail($email)`
  - **SQL to Create:** `SELECT * FROM users WHERE email = :email LIMIT 1`
  - **Return:** Return a single associative array containing the user's data (including `password` hash and `roleID`).

---

## [x] Phase 3: Update Business Logic & Controllers (The Brain)
**Goal:** Add secure password hashing and restructure payload parsing.
- [x] **Step 1:** Open `1811/bl/UserManagement.php` and remove all legacy `$_SESSION['userArray']` array-pushing code.
- [x] **Step 2:** Refactor `addUserFunc()`.
  - **Variables expected from POST:** `$_POST['firstName']`, `$_POST['email']`, `$_POST['password']`.
  - **Logic to Add:** 
    - `$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);`
  - **Method to Call:** `$this->regsModel->createRegistration($firstName, $email, $hashedPassword)`
- [x] **Step 3:** Refactor `loginUserFunc()`.
  - **Variables expected from POST:** `$_POST['login_email']`, `$_POST['login_password']`.
  - **Logic to Add:** 
    - Fetch DB record: `$user = $this->regsModel->getUserByEmail($email);`
    - Verify Hash: `if ($user && password_verify($req_password, $user['password']))`
  - **Session state to set:** `$_SESSION['userID'] = $user['userID'];`, `$_SESSION['roleID'] = $user['roleID'];`
- [x] **Step 4:** Open `1811/controllers/UserController.php`.
  - **Router Updates:** 
    - Change `isset($_POST['fname'], $_POST['lName'])` to `isset($_POST['firstName'], $_POST['email'], $_POST['password'])` for `#route_add`.
    - Change `isset($_POST['lFName'], $_POST['lLName'])` to `isset($_POST['login_email'], $_POST['login_password'])` for `#route_login`.

---

## [ ] Phase 4: Update Views & Client Scripts (The UI)
**Goal:** Adjust HTML forms and AJAX to collect user credentials instead of names.
- [ ] **Step 1:** Open `1811/views/RegistrationPage.php`.
  - **HTML to Update:** 
    - Change First Name id to `id="txtFirstName"`.
    - Change Last Name input to **Email**: `id="txtEmail"` (type="email").
    - Add **Password** input: `id="txtPassword"` (type="password").
- [ ] **Step 2:** Open `1811/views/LoginPage.php`.
  - **HTML to Update:** Change login inputs to `id="login_email"` and `id="login_password"`.
- [ ] **Step 3:** Open `1811/scripts/Service.js`.
  - **AJAX Add to Update (`addFunc`):**
    - `let fName = $("#txtFirstName").val();`, `let email = $("#txtEmail").val();`, `let password = $("#txtPassword").val();`
    - `data: { firstName: fName, email: email, password: password }`
  - **AJAX Login to Update (`loginFunc`):**
    - `let email = $('#login_email').val();`, `let password = $('#login_password').val();`
    - `data: { login_email: email, login_password: password }`

---

## [ ] Phase 5: Implement the Dashboard (The Destination)
**Goal:** Secure the routes and conditionally fork the UI based on Admin (`roleID = 1`) or Customer (`roleID = 2`).
- [ ] **Step 1:** Open `1811/views/Dashboard.php`.
- [ ] **Step 2:** Add Top-Level Security.
  - **PHP to Add:**
    ```php
    session_start();
    if (!isset($_SESSION['userID'])) {
        header("Location: LoginPage.php"); // Bounce unauthenticated users
        exit();
    }
    ```
- [ ] **Step 3:** Setup Role-based Rendering.
  - **Logic to Add:** 
    - `if ($_SESSION['roleID'] == 1) { // RENDER ADMIN DASHBOARD HTML }`
    - `else if ($_SESSION['roleID'] == 2) { // RENDER CUSTOMER DASHBOARD HTML }`

---

## ✅ Midterm Deliverables Checklist
- [ ] **1. Login:** Verifies hashed passwords against the DB and stores role in the Session.
- [ ] **2. Register:** Safely hashes passwords and inserts into 'chiikamart_db.users'.
- [ ] **3. Dashboard (Admin):** Detects `roleID == 1` and provides branching visual logic.
- [ ] **4. Database:** Fully connected via PDO without `userArray` bypasses.