<?php
    class Registration{
        private $conn;
        public function __construct($db)
        {
            $this->conn = $db; 
        }

    public function createRegistration ($firstName, $lastName, $suffix, $birthday, $phoneNumber, $email, $password, $street, $barangay, $city, $province, $zipCode) {
       $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);
        
        try {
            $query = "INSERT INTO tbl_users
            (firstName, lastName, suffix, birthday, phoneNumber, email, password, street, barangay, city, province, zipCode, createdAt, updatedAt)
            VALUES (:firstName, :lastName, :suffix, :birthday, :phoneNumber, :email, :password, :street, :barangay, :city, :province, :zipCode, :createdAt, :updatedAt)";

            $response = $this->conn->prepare($query);

            $response->bindParam(':firstName', $firstName);
            $response->bindParam(':lastName', $lastName);
            $response->bindParam(':suffix', $suffix);
            $response->bindParam(':birthday', $birthday);
            $response->bindParam(':phoneNumber', $phoneNumber);
            $response->bindParam(':email', $email);
            $response->bindParam(':password', $hashedPassword);
            $response->bindParam(':street', $street);
            $response->bindParam(':barangay', $barangay);
            $response->bindParam(':city', $city);
            $response->bindParam(':province', $province);
            $response->bindParam(':zipCode', $zipCode);

            $dateNow = date('Y-m-d H:i:s'); 
            
            $response->bindParam(':createdAt', $dateNow);
            $response->bindParam(':updatedAt', $dateNow);

            return $response->execute();
        } catch (PDOException $ex) {
            // error handling for database 
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }
    public function updateRegistration ($firstName, $lastName, $userID) {
        try {
            $query = "UPDATE tbl_users
            SET firstName = :firstName, lastName = :lastName, updatedAt = :updatedAt
            WHERE userID = :userID";

            $dateNow = date('Y-m-d H:i:s'); 

            $response = $this->conn->prepare($query);
            $response->bindParam(':firstName', $firstName);
            $response->bindParam(':lastName', $lastName);
            $response->bindParam(':userID', $userID);
            $response->bindParam(':updatedAt', $dateNow);

            $response->execute();
            return $response;
        } catch (PDOException $ex) {
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }
    public function deleteRegistration ($userID) {
            try {
                $query = "DELETE FROM tbl_users WHERE userID = :userID";
                $response = $this->conn->prepare($query);
                $response->bindParam(':userID', $userID);

                $response->execute();
                return $response;
            } catch (PDOException $ex) {
                error_log("Database error: " . $ex->getMessage());
                return false;
            }
        }
    public function readRegistration () {
            try {
                $query = "SELECT * FROM tbl_users";

                $response = $this->conn->prepare($query);

                $response->execute();
                return $response;
            } catch (PDOException $ex) {
                error_log("Database error: " . $ex->getMessage());
                return false;
            }
        }
    public function cardOrderStatus() {
            try {
                $query = "SELECT s.statusName, COUNT(o.orderID) AS total_orders
                FROM tbl_order_statuses s
                LEFT JOIN tbl_orders o
                    ON o.statusID = s.statusID
                GROUP BY s.statusName";

                $response = $this->conn->prepare($query);

                $response->execute();
                return $response;
            } catch (PDOException $ex) {
                error_log("Database error: " . $ex->getMessage());
                return false;
            }
        }
    public function cardInventoryCharacter() {
            try {
                $query = "SELECT c.charName, COUNT(p.productID) AS total_products
                FROM tbl_characters c
                LEFT JOIN tbl_products p
                    ON p.characterID = c.characterID
                GROUP BY c.charName";

                $response = $this->conn->prepare($query);

                $response->execute();
                return $response;
            } catch (PDOException $ex) {
                error_log("Database error: " . $ex->getMessage());
                return false;
            }
        }
    public function cardProductCollection() {
            try {
                $query = "SELECT c.collectionName, COUNT(p.productID) AS total_products
                FROM tbl_collections c
                LEFT JOIN tbl_products p
                    ON p.collectionID = c.collectionID
                GROUP BY c.collectionName";

                $response = $this->conn->prepare($query);

                $response->execute();
                return $response;
            } catch (PDOException $ex) {
                error_log("Database error: " . $ex->getMessage());
                return false;
            }
        }
    public function checkLoginDetails ($email) {
        try {
            $query = "SELECT * FROM tbl_users 
            WHERE email = :email";

            $response = $this->conn->prepare($query);

            $response->bindParam(':email', $email);

            $response->execute();
            return $response->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $ex) {
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }

    }
?>
