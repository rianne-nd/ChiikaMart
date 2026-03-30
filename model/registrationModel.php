<?php
    class Registration{
        private $conn;
        public function __construct($db)
        {
            $this->conn = $db; // Assign the database connection to the private variable $conn for use within the class methods.
        }

    public function createRegistration ($firstName, $lastName) {
        try {
            $query = "INSERT INTO tbl_registration 
            (firstName, lastName, createdAt, updatedAt) 
            VALUES (:firstName, :lastName, :createdAt, :updatedAt)";

            $response = $this->conn->prepare($query);

            $response->bindParam(':firstName', $firstName);
            $response->bindParam(':lastName', $lastName);

            $dateNow = date('Y-m-d H:i:s'); // Get the current date and time in the format 'YYYY-MM-DD HH:MM:SS'
            
            $response->bindParam(':createdAt', $dateNow);
            $response->bindParam(':updatedAt', $dateNow);

            $response->execute();
            return $response;
        } catch (PDOException $ex) {
            // error handling for database 
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }

    public function updateRegistration ($firstName, $lastName, $userID) {
        try {
            $query = "UPDATE tbl_registration 
            SET firstName = :firstName, lastName = :lastName, updatedAt = :updatedAt 
            WHERE userID = :userID";

            $response = $this->conn->prepare($query);

            $response->bindParam(':firstName', $firstName);
            $response->bindParam(':lastName', $lastName);
            $response->bindParam(':userID', $userID);

            $dateNow = date('Y-m-d H:i:s'); // Get the current date and time in the format 'YYYY-MM-DD HH:MM:SS'

            $response->bindParam(':updatedAt', $dateNow);

            $response->execute();
            return $response;
        } catch (PDOException $ex) {
            // error handling for database 
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }

    public function deleteRegistration ($userID) {
            try {
                $query = "DELETE FROM tbl_registration 
                WHERE userID = :userID";

                $response = $this->conn->prepare($query);
                $response->bindParam(':userID', $userID);

                $response->execute();
                return $response;
            } catch (PDOException $ex) {
                // error handling for database 
                error_log("Database error: " . $ex->getMessage());
                return false;
            }
        }

    public function readRegistration () {
            try {
                $query = "SELECT * FROM tbl_registration 
                WHERE userID = :userID";

                $response = $this->conn->prepare($query);

                $response->execute();
                return $response;
            } catch (PDOException $ex) {
                // error handling for database 
                error_log("Database error: " . $ex->getMessage());
                return false;
            }
        }

    }
?>
