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

        public function addUserFunc($firstName, $lastName, $suffix, $birthday, $phoneNumber, $email, $password, $street, $barangay, $city, $province, $zipCode): void {
            try {
                if($this->regsModel->createRegistration($firstName, $lastName, $suffix, $birthday, $phoneNumber, $email, $password, $street, $barangay, $city, $province, $zipCode)) {
                    echo "true";
                } else {
                    echo "false";
                }

            } catch (InvalidArgumentException $ex) {
                // Handle exception
                echo $ex->getMessage();
                exit;
            }
        }

        public function updateUserFunc($firstName, $lastName, $userID): void { 
            if($this ->regsModel->updateRegistration($firstName, $lastName, $userID)) {
                echo "true";
            }
                else {
                    echo "false";
                }
        }
        
        public function deleteUserFunc($userID): void {
            if($this ->regsModel->deleteRegistration($userID)) {
                echo "true";
            } else {
                echo "false";
            }
        }  
        public function getUser() {
            // return $_SESSION['userArray']; // return the current list of users stored in the session variable as an array. This method allows other parts of the application, such as controllers or views, to retrieve the user data for display or further processing. 
            $response = $this->regsModel->readRegistration(); // Call the readRegistration method of the $regsModel object to retrieve registration records from the database. The returned value is still an object
            return $response->fetchAll(PDO::FETCH_ASSOC); // Fetch all the registration records as an associative array and return it. This allows the calling code to access the user data in a structured format for display or further processing.
        }

        public function loginUserFunc($email, $password) {
            if($this -> regsModel -> checkLoginDetails($email, $password)) {
                echo "true";
            } else {
                echo "false";
            }

        }
    }
?>