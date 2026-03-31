# Project Progress & Updates

This file tracks the ongoing evolution of the ChiikaMart (1811 User Management) project, detailing the shift from a basic session-based prototype to a robust database-driven application.

---

## 📅 March 21, 2026 - Initial Setup & Front-End Polish
* **Bug Fix:** Resolved the "Headers already sent" PHP error that was preventing the `session_start()` from working properly in `UserController`. Output (like HTML comments or whitespace) was accidentally being sent before the session was started.
* **Architecture:** Formally established the MVC-style directory structure (`views/`, `controllers/`, `bl/`).
* **UI/UX Enhancement:** Replaced the manually crafted fallback HTML table logic with **DataTables.net**. This introduced automatic sorting, searching, and pagination to the `RegistrationPage.php` user table, as well as native "No data available in table" handling.
* **Version Control:** Initialized the local Git repository and officially linked and pushed the project to GitHub under the name `ChiikaMart`.

---

## 📅 March 22, 2026 - Database Integration & Models
* **Database Introduction:** Created the `model/` directory to house database connections and SQL-related logic, migrating away from strictly using `$_SESSION['userArray']`.
* **PDO Connection:** Created `database.php` which uses a PDO connection string to securely connect to the `projectappdev_db`.
* **Database Driver Debugging:** Resolved a database connectivity issue ("could not find driver") and an "Access denied" error. The fix involved utilizing the correct XAMPP MySQL port (`3307`) rather than the conflicting default Windows MySQL port.
* **Registration Model (`registrationModel.php`):** 
    * Established a dedicated data model handling user records.
    * Implemented the `createRegistration($firstName, $lastName)` function using prepared SQL statements (`INSERT INTO tbl_registration`) and boundary parameters to safely insert users and prevent SQL injection.
    * Fixed a table naming bug (`tbl_registrations` -> `tbl_registration`) and standard SQL syntax errors.
* **Business Logic Updates:** Upgraded the `__construct()` inside `bl/UserManagement.php` to immediately establish the `$db` connection upon class initialization, and updated the `addUserFunc()` to successfully fire database queries rather than session array appends.
* **Documentation:** Updated the `README.md` file to reflect the new models folder, the PDO connection file, and the architectural shift away from temporary sessions. 


---

## � March 31, 2026 - Expanding Database Capabilities & Form Design
* **Login Implementation:** Successfully transitioned the login workflow away from temporary array checks. The loginFunc in Javascript now collects email and password, ships them securely via POST, and queries the users table via checkLoginDetails(). If verified, logs the user in successfully.
* **Full Registration Implementation:** Expanded `RegistrationPage` inputs to collect all necessary User Data (suffix, birthday, phone, email, password, address, etc.). Updated `addFunc` in `Service.js`, `UserController.php`, `UserManagement.php`, and `createRegistration` in `registrationModel.php` to handle all this new data and map it successfully to the `users` table.
* **Registration Model Expanded:** Implemented the full suite of CRUD database queries inside `registrationModel.php`:
    * Added `updateRegistration($firstName, $lastName, $userID)` pointing an `UPDATE` query to `tbl_registration`.
    * Added `deleteRegistration($userID)` pointing a `DELETE` query targeting specific records in `tbl_registration`.
    * Added `readRegistration()` building out the initial logic for retrieving `SELECT` statements from the database.
* **Controller Updates:** Changed POST keys in `UserController.php` and variable references inside `Service.js` to ensure the Javascript properly sends the data points using matching identifiers (using `aFName`, `aLName`).
* **Document Refinements:** Refreshed `README.md` to properly document the new methods within `model/registrationModel.php`, `bl/UserManagement.php`'s newly integrated CRUD mapping, and properly cited the usage of the `chiikamart_db` connection.

---

## 🚀 Next Steps / Pending
* Fix potential parameter bug mapping within `readRegistration()` (specifically `WHERE userID = :userID`). Connect that functional query properly to the frontend DataTables table.
* Expand the `RegistrationPage` inputs to get all necessary User Data fields (`firstName`, `lastName`, `email`, `address`, `phoneNumber`). Configure the corresponding database tables so they hold all extra properties safely.



