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

        public function getCardOrderStatus() {
            $response = $this->regsModel->cardOrderStatus();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getCardCharacterInventory() {
            $response = $this->regsModel->cardInventoryCharacter();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getCardProductCollection() {
            $response = $this->regsModel->cardProductCollection();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getTotalSalesRevenue() {
            $response = $this->regsModel->totalSalesRevenue();
            return $response->fetch(PDO::FETCH_ASSOC);
        }

        public function getTotalOrders() {
            $response = $this->regsModel->totalOrders();
            return $response->fetch(PDO::FETCH_ASSOC);
        }

        public function getLowStockCount() {
            $response = $this->regsModel->lowStockCount();
            return $response->fetch(PDO::FETCH_ASSOC);
        }

        public function getOutOfStockCount() {
            $response = $this->regsModel->outOfStockCount();
            return $response->fetch(PDO::FETCH_ASSOC);
        }

        public function getTotalUsers() {
            $response = $this->regsModel->totalUsers();
            return $response->fetch(PDO::FETCH_ASSOC);
        }

        public function getMostWishlisted() {
            $response = $this->regsModel->mostWishlisted();
            return $response->fetch(PDO::FETCH_ASSOC);
        }

        public function getAverageRating() {
            $response = $this->regsModel->averageRating();
            return $response->fetch(PDO::FETCH_ASSOC);
        }

        public function getSalesByMonth() {
            $response = $this->regsModel->salesByMonth();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getRegistrationsByMonth() {
            $response = $this->regsModel->registrationsByMonth();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getTopSellingProducts() {
            $response = $this->regsModel->topSellingProducts();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getRevenueByCharacter() {
            $response = $this->regsModel->revenueByCharacter();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getRevenueByCollection() {
            $response = $this->regsModel->revenueByCollection();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getReviewStarDistribution() {
            $response = $this->regsModel->reviewStarDistribution();
            return $response->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getLowestStockWatchlist() {
            $response = $this->regsModel->lowestStockWatchlist();
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