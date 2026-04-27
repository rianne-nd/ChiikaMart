<?php
require_once '../model/database.php';
require_once '../model/departmentModel.php';

// Rename departmentModel.php later for whatever use the dropdown table will be used for. This file is purely to make the dropdown dynamic
    class DepartmentManagement{ 
        private $depsModel;
        public function __construct(){
            $database = new Database(); 
            $db = $database->connect(); 

            $this->depsModel = new Department($db); 
        }

        
        // getDepartment() function is used to retrieve the list of departments from the database. calls readDepartment() from departmentModel.php
        public function getDepartment() {
            $response = $this->depsModel->readDepartment();
            return $response->fetchAll(PDO::FETCH_ASSOC); 
        }


        // getCardDepartment() function is used to retrieve the department information for the card display. calls cardDepartment() from departmentModel.php
        // caardDepartment() gets the department name and departmentID for the card display
        public function getCardDepartment() {
            $response = $this->depsModel->cardDepartment();
            return $response->fetchAll(PDO::FETCH_ASSOC); 
        }

    
    }
?>
