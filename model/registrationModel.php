<?php
    class Registration{
        private $conn;
        public function __construct($db)
        {
            $this->conn = $db; // Assign the database connection to the private variable $conn for use within the class methods.
        }

    public function createRegistration ($firstName, $lastName, $suffix, $birthday, $phoneNumber, $email, $password, $street, $barangay, $city, $province, $zipCode) {
        try {
            $query = "INSERT INTO users
            (firstName, lastName, suffix, birthday, phoneNumber, email, password, street, barangay, city, province, zipCode, createdAt, updatedAt)
            VALUES (:firstName, :lastName, :suffix, :birthday, :phoneNumber, :email, :password, :street, :barangay, :city, :province, :zipCode, :createdAt, :updatedAt)";

            $response = $this->conn->prepare($query);

            $response->bindParam(':firstName', $firstName);
            $response->bindParam(':lastName', $lastName);
            $response->bindParam(':suffix', $suffix);
            $response->bindParam(':birthday', $birthday);
            $response->bindParam(':phoneNumber', $phoneNumber);
            $response->bindParam(':email', $email);
            $response->bindParam(':password', $password);
            $response->bindParam(':street', $street);
            $response->bindParam(':barangay', $barangay);
            $response->bindParam(':city', $city);
            $response->bindParam(':province', $province);
            $response->bindParam(':zipCode', $zipCode);

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
            $query = "UPDATE users
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
                $query = "DELETE FROM users WHERE userID = :userID";
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
                $query = "SELECT * FROM users";

                $response = $this->conn->prepare($query);

                $response->execute();
                return $response;
            } catch (PDOException $ex) {
                // error handling for database 
                error_log("Database error: " . $ex->getMessage());
                return false;
            }
        }

    public function checkLoginDetails ($email, $password) {
        try {
            $query = "SELECT * FROM users 
            WHERE email = :email AND password = :password";

            $response = $this->conn->prepare($query);

            $response->bindParam(':email', $email);
            $response->bindParam(':password', $password);

            $response->execute();
            return $response->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array. If a matching record is found, it will return the user details; otherwise, it will return false.
        }
        catch (PDOException $ex) {
            // error handling for database 
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }

    }
?>
