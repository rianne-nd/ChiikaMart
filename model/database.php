<?php

class Database {
    private $host = "localhost";
    private $db_name = "projectitf_db";
    private $username = "root";
    private $password = "";

    public function connect() {
        try {
            $conn = new PDO ("mysql:host=$this->host;port=3307;dbname=$this->db_name",
                            $this->username, 
                            $this->password
                            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;

        } catch(PDOException $ex) {
            die("Connection has failed: " . $ex->getMessage());
        }
    }
}
?>