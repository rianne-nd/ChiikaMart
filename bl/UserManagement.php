<?php
require_once '../model/database.php';
require_once '../model/registrationModel.php';

    class UserManagement{ 
        private $regsModel;

        public function __construct()
        {
            $database = new Database();  
            $db = $database->connect();  
        
            $this->regsModel = new Registration($db); 
        }

        public function addUserFunc($firstName, $lastName, $suffix, $birthday, $phoneNumber, $email, $password, $street, $barangay, $city, $province, $zipCode) {
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

        public function updateUserFunc($firstName, $lastName, $userID)   { 
            if($this ->regsModel->updateRegistration($firstName, $lastName, $userID)) {
                echo "true";
            }
                else {
                echo "false";
                }
        }
        
        public function deleteUserFunc($userID) {
            if($this ->regsModel->deleteRegistration($userID)) {
                echo "true";
            } else {
                echo "false";
            }
        }  
        public function getUser() {
            $response = $this->regsModel->readRegistration(); 
            return $response->fetchAll(PDO::FETCH_ASSOC); 
        }

        


        public function loginUserFunc($email, $password) {
            $user = $this->regsModel->checkLoginDetails($email);

            $verifyPassword = password_verify($password, $user['password']);
            if($verifyPassword) {
                echo "true";
            } else {
                echo "false";
                
            }

        }
    }
?>