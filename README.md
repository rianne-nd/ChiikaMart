# ChiikaMart - User Management and Catalog UI

ChiikaMart is a PHP + MySQL educational web app that uses an MVC-style structure and AJAX-based interactions for user registration, login, and dashboard management.

## Overview

The project includes:

- Registration flow with full profile fields
- Login validation against database records
- Dashboard table with update/delete actions
- Home page with themed UI and local image assets

Core architecture:

- `views/` for page interfaces
- `controllers/` for request routing
- `bl/` for business logic
- `model/` for database and SQL
- `scripts/` for client-side AJAX and navigation

## Project Structure

```text
ChiikaMart/
|- bl/
|  `- UserManagement.php
|- controllers/
|  `- UserController.php
|- images/
|  |- chiikawa Train.jpg
|  |- Chiikawa_keychain.png
|  |- Chiikawa_small2.png
|  |- Hachiware_medium.png
|  |- usagiBigFeatured.webp
|  `- Usagi_jumbo.png
|- model/
|  |- database.php
|  `- registrationModel.php
|- scripts/
|  `- Service.js
|- views/
|  |- Dashboard.php
|  |- HomePage.php
|  |- LoginPage.php
|  `- RegistrationPage.php
`- README.md
```

## Database

Connection is configured in `model/database.php`:

- Host: `localhost`
- Port: `3307`
- Database: `chiikamart_db`
- Username: `root`
- Password: empty

Model queries in `model/registrationModel.php` target table `tbl_users`.

## Request and Data Flow

1. User action starts in a view (`RegistrationPage.php`, `LoginPage.php`, `Dashboard.php`).
2. `scripts/Service.js` collects input values and sends AJAX POST requests to `controllers/UserController.php`.
3. `UserController.php` detects POST keys and calls the matching method in `bl/UserManagement.php`.
4. `UserManagement.php` delegates DB operations to `model/registrationModel.php`.
5. The controller response is returned as text (`"true"` or `"false"`) and handled by SweetAlert in the browser.

## Controller POST Routes

`controllers/UserController.php` routes by keys:

- Registration: `aFName`, `aLName`, `aSuffix`, `aBirthday`, `aPhoneNumber`, `aEmail`, `aPassword`, `aStreet`, `aBarangay`, `aCity`, `aProvince`, `aZipCode`
- Update: `uFName`, `uLName`, `uID`
- Delete: `dID`
- Login: `lEmail`, `lPassword`

## Main Files

- `views/RegistrationPage.php`: Full registration form UI
- `views/LoginPage.php`: Login page UI
- `views/Dashboard.php`: Table view for users, includes update/delete buttons
- `views/HomePage.php`: Themed home/catalog style page with local image assets
- `scripts/Service.js`: `addFunc`, `loginFunc`, `updateFunc`, `deleteFunc`, `redirectFunc`, DataTables init

## Front-End Libraries

- jQuery 3.7.1
- SweetAlert2 (CDN)
- DataTables 2.3.7
- Tailwind CSS (CDN)
- Google Fonts (Plus Jakarta Sans, Material Symbols)

## Quick Run Steps

1. Start Apache and MySQL in XAMPP.
2. Ensure MySQL is available on port `3307`.
3. Create/import database `chiikamart_db` and table `tbl_users` with required columns.
4. Open the app through XAMPP localhost path, then use:
   - `views/LoginPage.php` for login
   - `views/RegistrationPage.php` for registration
   - `views/HomePage.php` and `views/Dashboard.php` after navigation
