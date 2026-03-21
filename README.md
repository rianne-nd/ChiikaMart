# 1811 - User Management System

Welcome to the **1811 User Management System**! This documentation is designed to help developers of *all levels*, especially beginners, understand exactly how this application works, how the files connect to each other, and what each part of the code does. 

This is a PHP-based user management application that is currently transitioning. It uses an **MVC-style (Model-View-Controller)** architecture. This structure helps keep front-end code (HTML/UI) separate from back-end logic (PHP/Database).

Right now, the project is in a **transition phase**:
- **Adding Users:** Successfully connected to a MySQL Database using PDO.
- **Reading, Updating, Deleting, and Logging In:** Currently using PHP Sessions (temporary data storage) while we prepare to move them to the database in the next phases of development.

---

## ??? Architecture Visualization: How the Code Works

To help visualize how the application processes a request (like adding a user), let's look at the flow of data.

When a user clicks "Add" on the registration page, here is exactly what happens behind the scenes:

`mermaid
sequenceDiagram
    participant User as ?? User (Browser)
    participant UI as ??? View (RegistrationPage.php)
    participant JS as ?? JS Layer (Service.js)
    participant Router as ?? Controller (UserController.php)
    participant BL as ?? Biz Logic (UserManagement.php)
    participant Model as ??? Model (registrationModel.php)
    participant DB as ?? Database (MySQL)

    User->>UI: Fills out form & clicks "Add"
    UI->>JS: Triggers addFunc()
    JS->>Router: Sends AJAX POST request (fname, lName)
    Router->>BL: Reads POST keys, calls addUserFunc()
    BL->>Model: Passes data to createRegistration()
    Model->>DB: Prepares & Executes SQL INSERT INTO
    DB-->>Model: Returns Success
    Model-->>BL: Notifies success back
    BL-->>Router: Sends true/false response
    Router-->>JS: Returns response to browser
    JS->>User: Shows SweetAlert2 success popup & reloads page
`

---

## ?? Project Structure Explained

Here is an overview of why we put certain files in certain folders. This is the **MVC (Model-View-Controller)** concept in action:

`	ext
1811/
+-- bl/                          # "Business Logic" - The Brain of the app.
¦   +-- UserManagement.php       # Processes rules, talks to the DB models, and prepares data.
+-- controllers/                 # "Controller" - The Traffic Cop.
¦   +-- UserController.php       # Receives incoming signals (AJAX) and routes them to the Brain.
+-- css/                         # Custom Stylesheets go here.
+-- images/                      # Images and graphics go here.
+-- model/                       # "Model" - The Database Handlers.
¦   +-- database.php             # Connects securely to the MySQL database.
¦   +-- registrationModel.php    # Writes/Reads actual database tables using SQL.
+-- scripts/                     # Client-side JavaScript.
¦   +-- Service.js               # Uses AJAX to talk to the server behind the scenes.
+-- views/                       # "Views" - What the user actually sees (HTML).
¦   +-- Dashboard.php            # Placeholder dashboard page.
¦   +-- LoginPage.php            # Page where users can log in.
¦   +-- RegistrationPage.php     # Main page where users sign up and view table.
+-- PROGRESS.md                  # Tracks milestones (what we've done so far).
+-- README.md                    # This file!
`

---

## ?? File Descriptions & Detailed Explanations

In this section, we will break down what each file is doing and explain what the method parameters are. 

### 1. The Business Logic (l/UserManagement.php)

This file acts as the "Brain" of the application. The UserManagement class connects the initial requests from the Controller to the actual Database or Session operations.

| Function | Parameters | In-Depth Description |
|---|---|---|
| __construct() | *None* | Whenever UserManagement is created, this built-in constructor runs automatically. It attempts to load the Database class, establish a live connection to MySQL via PDO, and then prepares the Registration model so it's ready to use. |
| ddUserFunc() | $firstName<br>$lastName | Receives the strings for first name and last name. It immediately calls the Database layer (specifically createRegistration) to securely insert this new user into our SQL database permanently. |
| updateUserFunc() | $firstName<br>$lastName<br>$userID | Updates the existing FirstName and LastName inside the temporary PHP $_SESSION['userArray'] stored at the specific index position ($userID). *(Soon to be migrated to SQL)* |
| deleteUserFunc() | $userID | Finds the specific index position ($userID) inside the PHP session array, calls unset() to delete it entirely, and uses rray_values() to reset the numbering of the array indexes so it doesn't break our view loop. *(Soon to be migrated to SQL)* |
| getUser() | *None* | Grabs the entire $_SESSION['userArray'] from the server's temporary memory. If it's empty, it builds an empty array to prevent fatal errors when the page tries to loop through it. |
| loginUserFunc() | $firstName<br>$lastName | Checks if a user's exact First and Last name combinations exist inside the Session state using rray_search(). Returns "true" back to the browser if they matched, or "false" if they failed. |

---

### 2. The Models (model/)

Models strictly handle the data. In our app, they connect and send SQL Queries to MySQL.

**model/database.php**
This file connects our PHP application to the MySQL database securely using a standard known as **PDO** (PHP Data Objects). 
- **Port 3307:** We explicitly use port 3307 instead of the default 3306. This prevents conflicts because XAMPP uses its own MySQL, and sometimes another local MySQL installation can block the connection.
- **Try-Catch Block:** Used so that if the connection fails (e.g., the server is offline), it throws a neat, secure error message instead of crashing the whole site and exposing our passwords.

| Function | Parameters | In-Depth Description |
|---|---|---|
| connect() | *None* | Attempts to assemble the connection variables (localhost, oot, port 3307, and database projectappdev_db) into a PDO string. If successful, returns the PDO connection object. |

**model/registrationModel.php**
This file contains the actual SQL query language used to manage our 	bl_registration table.

| Function | Parameters | In-Depth Description |
|---|---|---|
| __construct() | $db | It requires an active database connection ($db) upon initialization. It stores this connection internally so functions inside the class can use it reliably. |
| createRegistration() | $firstName<br>$lastName | Prepares the SQL Query: INSERT INTO tbl_registration (...). It uses "Prepared Statements" (bindParam) which safely injects the variables into the database, protecting the app from harmful SQL injection hacks. It also creates accurate Date/Time timestamps for when the user was created. |

---

### 3. The Controller (controllers/UserController.php)

Controllers are like traffic cops. You send them data, and they point the code in the right direction. 
This file looks for specific **POST keys** from the hidden AJAX requests and triggers the matching UserManagement function.

| POST Keys Present | Action Triggered | Explaination |
|---|---|---|
| name, lName | Calls ddUserFunc() | Controller sees you want to Add a user. Sends it to the logic handler. |
| uFName, uLName, uID | Calls updateUserFunc() | Controller sees the 'u' keys (Update). Updates existing session record. |
| dID | Calls deleteUserFunc() | Controller sees the 'd' key (Delete). Triggers session removal. |
| lFName, lLName | Calls loginUserFunc() | Controller sees logging 'l' keys (Login). Triggers authentication script. |

---

### 4. Client-Side Javascript (scripts/Service.js)

This file is what makes the page feel fast and smooth. Instead of refreshing your browser every time you click a button, JavaScript intercepts the click and sends an invisible request to the server behind the scenes (called **AJAX**). 

| Function | Parameters | In-Depth Description |
|---|---|---|
| ddFunc() | *None* | Captures exactly what the user typed in the 	xtFirstname and 	xtLastname boxes, builds an invisible POST packet, sends it to UserController.php, and if successful, triggers a SweetAlert success pop-up. |
| updateFunc() | userID | Needs to know the index/ID (userID) of the person you want to update. It sends the new text box strings over AJAX. Shows success popup when done. |
| deleteFunc() | userID | Needs the index/ID of the person to crush. Sends only that userID across AJAX. Deletes them, then cleanly reloads the screen to update the table visually. |
| edirectFunc() | edirectID | Simple helper that pushes the user to a different Web Page (e.g. 1 takes you to LoginPage.php). |
| loginFunc() | *None* | Examines exactly what the user typed into the login boxes, verifies via AJAX, and conditionally jumps them to the Dashboard if it worked, or barks a SweetAlert error if it failed. |

---

### 5. The Views (iews/)

*   **RegistrationPage.php:** The main event. It runs getUser() at the very top of the script so it can assemble the large HTML visual table loop of existing users. Uses a powerful plugin called DataTables.net so users can dynamically sort, search, and parse paginated list inputs instantly. It includes Materialize CSS for a sleek interface.
*   **LoginPage.php:** A clean card-view form where users input their names to attempt access to the system. 
*   **Dashboard.php:** This is currently just a placeholder/sandbox file. It has no features programmed yet (coming soon).

---

## ?? Dependencies

We use these excellent third-party tools to make everything look good and function properly:

| Library | Version | Purpose |
|---|---|---|
| [jQuery](https://jquery.com/) | 3.7.1 | Makes it incredibly easy to use AJAX ($.ajax()) so our page doesn't have to keep refreshing all the time. |
| [SweetAlert2](https://sweetalert2.github.io/) | 11 | Handles those beautiful, animated Confirmation/Error Popup modules you see on the screen. |
| [Materialize CSS](https://materializecss.com/) | 1.0.0 | A front-end framework based on Google's Material Design. Sets all the nice fonts, colors, grids, shadows, and button stylings. |
| [Material Icons](https://fonts.google.com/icons) | CDN | Provides the small icon vectors inside buttons (like little trash cans or pencil edit icons). |
| [DataTables](https://datatables.net/) | 2.3.7 | A robust jQuery plugin used specifically on RegistrationPage.php to immediately allow complex Searching and Sorting over large tables of users. |

---

## ??? Step-by-Step Developer Setup

If you are setting this up for the first time, follow these explicit setup steps:
1. Ensure your **XAMPP Server** is fully active. (Both **Apache** and **MySQL** modules turned ON).
2. Inside PHPMyAdmin or your DB console, ensure a database named projectappdev_db exists.
3. Be aware that the MySQL server mapped to this project requires **Port 3307**, not the normal 3306. (Refer to model/database.php).
4. Place the entire 1811 folder into C:\xampp\htdocs\
5. Open your web browser and navigate directly to: http://localhost/1811/views/RegistrationPage.php

---

## ?? Important Note / Next Steps

Because the data source is currently in a *mixed state* (database for inserts, but session arrays for displaying the lists), users added to the database via the "Add User" button will work beautifully in MySQL but **may not yet appear directly in the RegistrationPage table** until getUser() is migrated to read from 	bl_registration in the upcoming developmental sprint.
