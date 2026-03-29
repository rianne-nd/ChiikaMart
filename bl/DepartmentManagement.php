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

        public function getDepartment() {
            $response = $this->depsModel->readDepartment();
            return $response->fetchAll(PDO::FETCH_ASSOC); 
        }

    
    }
?>
