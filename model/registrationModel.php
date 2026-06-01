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
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }
    public function updateRegistration ($firstName, $lastName, $suffix, $birthday, $phoneNumber, $email, $street, $barangay, $city, $province, $zipCode, $roleID, $isActive, $userID) {
        try {
            $query = "UPDATE tbl_users
            SET firstName = :firstName,
                lastName = :lastName,
                suffix = :suffix,
                birthday = :birthday,
                phoneNumber = :phoneNumber,
                email = :email,
                street = :street,
                barangay = :barangay,
                city = :city,
                province = :province,
                zipCode = :zipCode,
                roleID = :roleID,
                isActive = :isActive,
                updatedAt = :updatedAt
            WHERE userID = :userID";

            $dateNow = date('Y-m-d H:i:s'); 

            $response = $this->conn->prepare($query);
            $response->bindParam(':firstName', $firstName);
            $response->bindParam(':lastName', $lastName);
            $response->bindParam(':suffix', $suffix);
            $response->bindParam(':birthday', $birthday);
            $response->bindParam(':phoneNumber', $phoneNumber);
            $response->bindParam(':email', $email);
            $response->bindParam(':street', $street);
            $response->bindParam(':barangay', $barangay);
            $response->bindParam(':city', $city);
            $response->bindParam(':province', $province);
            $response->bindParam(':zipCode', $zipCode);
            $response->bindParam(':roleID', $roleID);
            $response->bindParam(':isActive', $isActive);
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

    public function totalSalesRevenue() {
        try {
            $query = "SELECT COALESCE(SUM(totalAmount), 0) AS total_sales FROM tbl_orders";

            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } catch (PDOException $ex) {
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }

    public function totalOrders() {
        try {
            $query = "SELECT COUNT(orderID) AS total_orders FROM tbl_orders";

            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } catch (PDOException $ex) {
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }

    public function lowStockCount() {
        try {
            $query = "SELECT COUNT(productID) AS low_stock_count
                FROM tbl_products
                WHERE stockQuantity < 5";

            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } catch (PDOException $ex) {
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }

    public function outOfStockCount() {
        try {
            $query = "SELECT COUNT(productID) AS out_stock_count
                FROM tbl_products
                WHERE stockQuantity = 0";

            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } catch (PDOException $ex) {
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }

    public function totalUsers() {
        try {
            $query = "SELECT COUNT(userID) AS total_users FROM tbl_users";

            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } catch (PDOException $ex) {
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }

    public function mostWishlisted() {
        try {
            $query = "SELECT productName, wishlist_count FROM (
                SELECT p.productName, COUNT(w.wishlistID) AS wishlist_count
                FROM tbl_products p
                LEFT JOIN tbl_wishlists w
                    ON p.productID = w.productID
                GROUP BY p.productID, p.productName
                ORDER BY wishlist_count DESC
                LIMIT 1
            ) AS ranked
            UNION ALL SELECT 'No Data', 0
            LIMIT 1";

            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } catch (PDOException $ex) {
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }

    public function averageRating() {
        try {
            $query = "SELECT COALESCE(AVG(ratingValue), 0) AS avg_rating
                FROM tbl_reviews
                WHERE isApproved = 1";

            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } catch (PDOException $ex) {
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }

    public function salesByMonth() {
        try {
            $query = "SELECT DATE_FORMAT(orderDate, '%Y-%m') AS order_month,
                COALESCE(SUM(totalAmount), 0) AS total_revenue
                FROM tbl_orders
                GROUP BY order_month
                ORDER BY order_month";

            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } catch (PDOException $ex) {
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }

    public function registrationsByMonth() {
        try {
            $query = "SELECT DATE_FORMAT(createdAt, '%Y-%m') AS reg_month,
                COUNT(userID) AS total_users
                FROM tbl_users
                GROUP BY reg_month
                ORDER BY reg_month";

            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } catch (PDOException $ex) {
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }

    public function topSellingProducts() {
        try {
            $query = "SELECT p.productName, COALESCE(SUM(oi.quantity), 0) AS total_sold
                FROM tbl_order_items oi
                INNER JOIN tbl_products p
                    ON p.productID = oi.productID
                GROUP BY p.productID, p.productName
                ORDER BY total_sold DESC
                LIMIT 5";

            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } catch (PDOException $ex) {
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }

    public function revenueByCharacter() {
        try {
            $query = "SELECT c.charName,
                COALESCE(SUM(oi.quantity * oi.priceAtPurchase), 0) AS total_revenue
                FROM tbl_order_items oi
                INNER JOIN tbl_products p
                    ON p.productID = oi.productID
                INNER JOIN tbl_characters c
                    ON c.characterID = p.characterID
                GROUP BY c.characterID, c.charName
                ORDER BY total_revenue DESC";

            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } catch (PDOException $ex) {
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }

    public function revenueByCollection() {
        try {
            $query = "SELECT c.collectionName,
                COALESCE(SUM(oi.quantity * oi.priceAtPurchase), 0) AS total_revenue
                FROM tbl_order_items oi
                INNER JOIN tbl_products p
                    ON p.productID = oi.productID
                INNER JOIN tbl_collections c
                    ON c.collectionID = p.collectionID
                GROUP BY c.collectionID, c.collectionName
                ORDER BY total_revenue DESC";

            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } catch (PDOException $ex) {
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }

    public function reviewStarDistribution() {
        try {
            $query = "SELECT ratingValue, COUNT(reviewID) AS total_reviews
                FROM tbl_reviews
                WHERE isApproved = 1
                GROUP BY ratingValue
                ORDER BY ratingValue";

            $response = $this->conn->prepare($query);
            $response->execute();
            return $response;
        } catch (PDOException $ex) {
            error_log("Database error: " . $ex->getMessage());
            return false;
        }
    }

    public function lowestStockWatchlist() {
        try {
            $query = "SELECT productName, stockQuantity
                FROM tbl_products
                ORDER BY stockQuantity ASC
                LIMIT 5";

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
