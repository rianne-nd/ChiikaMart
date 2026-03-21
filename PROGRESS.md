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

## 🚀 Next Steps / Pending
* Update the `$usermanagement->getUser()` function to `SELECT` data from the database so the frontend DataTables table loads actual remote database records instead of just the session cache.
* Migrate the Update (`UPDATE` SQL) and Delete (`DELETE` SQL) functionality from the session array to the database via `registrationModel.php`.
* Convert the login authorization to verify credentials via a database query.