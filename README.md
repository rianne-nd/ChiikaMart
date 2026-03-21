# 1811 - User Management System

A PHP session-based user management application following an MVC-style architecture. Users can be registered, updated, deleted, and authenticated using data stored in PHP sessions.

---

## Project Structure

```
1811/
├── bl/
│   └── UserManagement.php       # Business logic - session-based user operations
├── controllers/
│   └── UserController.php       # Request router - handles all POST requests
├── css/                         # Stylesheets (empty)
├── images/                      # Image assets (empty)
├── model/                       # Data models and database configuration
│   ├── database.php             # PDO database connection setup
│   └── registrationModel.php    # Handles registration SQL queries
├── scripts/
│   └── Service.js               # Client-side AJAX service functions
├── views/
│   ├── Dashboard.php            # Dashboard view (placeholder)
│   ├── LoginPage.php            # Login form view
│   └── RegistrationPage.php     # Registration page with user table
└── README.md
```

---

## File Descriptions & Functions

### `bl/UserManagement.php`

Business logic layer. Contains the `UserManagement` class which manages users. Recently updated to integrate with the database for adding users.

| Function | Parameters | Description |
|---|---|---|
| `__construct()` | — | Establishes the database connection using the `Database` class and initializes the `Registration` model. |
| `addUserFunc()` | `$firstName`, `$lastName` | Calls the `createRegistration` method of the registration model to insert a new user into the database. |
| `updateUserFunc()` | `$firstName`, `$lastName`, `$userID` | Updates the `FirstName` and `LastName` of the user at index `$userID` in the session array. |
| `deleteUserFunc()` | `$userID` | Removes the user at index `$userID` using `unset()`, then re-indexes the array with `array_values()`. |
| `getUser()` | — | Returns the full `$_SESSION['userArray']`, or an empty array if the session variable is not set. |
| `loginUserFunc()` | `$firstName`, `$lastName` | Searches the session array for a matching first and last name using `array_search()`. Echoes `"true"` if found, otherwise `"false"`. |

---

### `model/database.php`

Database connection layer. Connects the project to a MySQL database using PDO.

| Function | Parameters | Description |
|---|---|---|
| `connect()` | — | Establishes and returns a PDO connection to the `projectappdev_db` database using a try-catch block for error handling. Uses `localhost` and standard XAMPP credentials. |

---

### `model/registrationModel.php`

Data model responsible for SQL queries and database manipulation related to registrations.

| Function | Parameters | Description |
|---|---|---|
| `__construct()` | `$db` | Stores the active database connection in a private variable. |
| `createRegistration()` | `$firstName, $lastName` | Prepares and executes an `INSERT INTO tbl_registration` query to add a new user to the database using securely bound parameters. |

---

### `controllers/UserController.php`

Acts as the request router. Starts the session, instantiates `UserManagement`, and delegates incoming POST requests to the appropriate business logic method based on which POST keys are present.

| POST Keys Present | Action Triggered |
|---|---|
| `fname`, `lName` | Calls `addUserFunc()` |
| `uFName`, `uLName`, `uID` | Calls `updateUserFunc()` |
| `dID` | Calls `deleteUserFunc()` |
| `lFName`, `lLName` | Calls `loginUserFunc()` |

---

### `scripts/Service.js`

Client-side layer. All functions communicate with `UserController.php` via jQuery AJAX POST requests and display SweetAlert2 confirmation dialogs on success.

| Function | Parameters | Description |
|---|---|---|
| `addFunc()` | — | Reads `txtFirstname` and `txtLastname` input values and sends a POST request to add a new user. On success, shows a SweetAlert and reloads the page. |
| `updateFunc()` | `userID` | Reads `txtFirstname` and `txtLastname` input values and sends a POST request to update the user at the given `userID`. On success, shows a SweetAlert and reloads the page. |
| `deleteFunc()` | `userID` | Sends a POST request to delete the user at the given `userID`. On success, shows a SweetAlert and reloads the page. |
| `changeFirstName()` | — | Sends a POST request with the current first and last name input values (legacy function, functionally overlaps with `addFunc()`). Reloads the page after an alert. |
| `redirectFunc()` | `redirectID` | Redirects the browser to a view page based on the ID: `1` → `LoginPage.php`, `2` → `Dashboard.php`, `3` → `RegistrationPage.php`. |
| `loginFunc()` | — | Reads `login_fName` and `login_lName` input values and sends a POST request to authenticate the user. Redirects to the Dashboard on success, or shows an alert on failure. |

---

### `views/RegistrationPage.php`

The main user-facing page. Starts the session, fetches the current user list via `getUser()`, and renders:
- A navigation bar (with a **LOGIN** redirect button).
- A registration form (First Name / Last Name inputs + **ADD** button).
- A responsive Materialize table listing all registered users with **UPDATE** and **DELETE** action buttons per row.

Depends on `Service.js` for all CRUD interactions.

---

### `views/LoginPage.php`

Login form view. Renders First Name and Last Name input fields with an **ADD** button (wired to `addFunc()`). Uses Materialize CSS for styling. Includes jQuery and SweetAlert2.

---

### `views/Dashboard.php`

Placeholder HTML page. Currently contains only a bare HTML5 shell with no content or functionality.

---

## Dependencies

| Library | Version | Purpose |
|---|---|---|
| [jQuery](https://jquery.com/) | 3.7.1 | AJAX requests |
| [SweetAlert2](https://sweetalert2.github.io/) | 11 | Success/error dialog modals |
| [Materialize CSS](https://materializecss.com/) | 1.0.0 | UI components and responsive layout |
| [Material Icons](https://fonts.google.com/icons) | — | Icon font |

---

## How It Works

1. The user opens `RegistrationPage.php`.
2. Entering a first and last name and clicking **ADD** triggers `addFunc()` in `Service.js`.
3. `Service.js` sends a jQuery AJAX POST to `UserController.php`.
4. `UserController.php` routes the request to the correct method in `UserManagement.php`.
5. `UserManagement.php` performs the operation (e.g., storing the new user in the database or modifying the session) and returns a response.
6. The page reloads and fetches the updated data.
