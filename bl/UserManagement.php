<?php
require_once '../model/database.php';
require_once '../model/registrationModel.php';
// import database connection and registration model to use in the UserManagement class for database interactions related to user management, such as storing user data in a database instead of using PHP sessions. 

// This file contains the UserManagement class which handles user-related operations such as adding, updating, deleting, and retrieving users. It uses PHP sessions to store user data in an array format. The class also includes a login function that checks if a user's first and last name exist in the session array.

    class UserManagement{ 
                            
        // Called to manage user data stored in PHP sessions, providing methods for adding, updating, deleting, and retrieving users, as well as a login function that checks if a user's first and last name exist in the session array.

        // Define the UserManagement class, which will contain methods for managing user data stored in PHP sessions.
        // The class includes methods for adding, updating, deleting, and retrieving users, as well as a login function that checks if a user's first and last name exist in the session array.
        // The constructor initializes the session variable to hold user data if it does not already exist. The addUserFunc method adds a new user to the session array, while the updateUserFunc method updates an existing user's information based on their user ID. The deleteUserFunc method removes a user from the session array, and the getUser method retrieves the current list of users. The loginUserFunc method checks if a user's first and last name exist in the session array and returns "true" or "false" accordingly.
        // The class uses try-catch blocks to handle exceptions that may occur during user management operations, and it returns appropriate HTTP response codes and error messages when exceptions are caught.
        // The class is designed to be used in conjunction with AJAX requests from the front-end, allowing for dynamic user management without the need for page reloads.
        // Overall, the UserManagement class provides a simple and effective way to manage user data using PHP sessions, making it suitable for small-scale applications or prototypes that do not require a database for user management.
        // Note: In a production environment, it is recommended to use a database for user management instead of PHP sessions, as sessions are not persistent and can be lost when the server restarts or when the session expires.
        // The class also does not include any security measures for handling user data, such as password hashing or input validation, which should be implemented in a real-world application to protect user information and prevent security vulnerabilities.
        // Additionally, the loginUserFunc method is a very basic implementation and should be enhanced to include proper authentication mechanisms, such as password verification and session management for logged-in users.
                            

        private $regsModel;


        // public is used to allow access to the class and its methods from outside the class, such as from controllers or views. It allows other parts of the application to create instances of the UserManagement class and call its methods to manage user data stored in PHP sessions.
        // private would restrict access to the class and its methods, making it inaccessible from outside the class. This would prevent other parts of the application from using the UserManagement class to manage user data, which is not desirable in this case since we want to allow interaction with the class from controllers and views.

        // public because it will be used later in the controllers
        // When a new instance of the UserManagement class is created, the constructor checks if the session variable 'userArray' exists. If it does not exist, it initializes 'userArray' as an empty array to hold user data. This ensures that the session variable is always available for storing user information when methods of the UserManagement class are called.
        public function __construct()
        {
            $database = new Database(); // class from database.php, used to establish a connection to the database. 
            $db = $database->connect(); // function from database.php, used to establish a connection to the database and return the connection object. This allows the UserManagement class to interact 
        
            // Initializes the $regsModel property of the UserManagement class, containing functions in our registrationModel.php
            $this->regsModel = new Registration($db); // class from registrationModel.php, used to handle registration-related operations such as creating new registrations in the database. By passing the database connection ($db) to the constructor of the Registration class, we can ensure that the UserManagement class has access to the necessary database connection for performing registration operations when needed.
        }

        public function addUserFunc($firstName, $lastName): void {
            try {
                // Call the createRegistration method of the $regsModel object from registrationModel.php to create a new registration record in the database
                if($this->regsModel->createRegistration($firstName, $lastName)) {
                    echo "User is added successfully.";
                } else {
                    // If the registration creation fails, return an error response
                    http_response_code(500);
                    echo "Failed to create registration.";
                }

            } catch (InvalidArgumentException $ex) {
                // Handle exception
                http_response_code(500);
                echo $ex->getMessage();
                exit;
            }
        }

        public function updateUserFunc($firstName, $lastName, $userID): void { 
            if(isset($_SESSION['userArray'][$userID])) {
                $_SESSION['userArray'][$userID]['FirstName'] = $firstName;
                    //$_SESSION['userArray'] is an array of users
                    //['userID'] is the specific user we want to update
                    //['FirstName'] is the field we want to update
                $_SESSION['userArray'][$userID]['LastName'] = $lastName;
            }
        }
        
        public function deleteUserFunc($userID): void {
            unset($_SESSION['userArray'][$userID]); // remove user at specified index
            $_SESSION['userArray'] = array_values($_SESSION['userArray']);  // reindex array 
        }  
        public function getUser() {
            return $_SESSION['userArray']; // return the current list of users stored in the session variable as an array. This method allows other parts of the application, such as controllers or views, to retrieve the user data for display or further processing. 
        }

        public function loginUserFunc($firstName, $lastName) {
            $fnameColumn = array_column($_SESSION['userArray'], 'FirstName'); // get array of first names
            $lnameColumn = array_column($_SESSION['userArray'], 'LastName'); // get array of last names

            // $firstName and $lastName are recieved from loginUserFunc in UserController.php, it is the needle we are looking for inside the haystack collumn $fnameColumn and $lnameColumn. If both the first name and last name are found in their respective columns, we return "true". If either the first name or last name is not found, we return "false". This allows us to check if a user's first and last name exist in the session array for login purposes.
            $fNameSearch = array_search($firstName, $fnameColumn); // search for first name in array
            $lNameSearch = array_search($lastName, $lnameColumn); // search for last name in array

            // Check if both the first name and last name are found in their respective columns. If both are found, return "true". If either is not found, return "false".
            if ($fNameSearch !== false && $lNameSearch !== false) {
                echo "true";
            } else{
                echo "false";
            }
        }
    }
?>