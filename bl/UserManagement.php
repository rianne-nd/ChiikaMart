<?php
require_once '../model/database.php';
require_once '../model/registrationModel.php';

    class UserManagement{ 
        private $regsModel;

        public function __construct()
        {
            $database = new Database();  
            $db = $database->connect();  
        
            $this->regsModel = new Registration($db); // class from registrationModel.php, used to handle registration-related operations such as creating new registrations in the database. By passing the database connection ($db) to the constructor of the Registration class, we can ensure that the UserManagement class has access to the necessary database connection for performing registration operations when needed.
        }

        public function addUserFunc($firstName, $lastName): void {
            try {
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
            if($this ->regsModel->updateRegistration($firstName, $lastName, $userID)) {
                echo "User is updated successfully.";
            }
                else {
                    echo "Error is encountered while updating the user.";
                }
        }
        
        public function deleteUserFunc($userID): void {
            if($this ->regsModel->deleteRegistration($userID)) {
                echo "User is deleted successfully.";
            } else {
                echo "Error is encountered while deleting the user.";
            }
        }  
        public function getUser() {
            // return $_SESSION['userArray']; // return the current list of users stored in the session variable as an array. This method allows other parts of the application, such as controllers or views, to retrieve the user data for display or further processing. 
            $response = $this->regsModel->readRegistration(); // Call the readRegistration method of the $regsModel object to retrieve registration records from the database. The returned value is still an object
            return $response->fetchAll(PDO::FETCH_ASSOC); // Fetch all the registration records as an associative array and return it. This allows the calling code to access the user data in a structured format for display or further processing.
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