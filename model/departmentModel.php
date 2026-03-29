 <?php
//  Rename departmentModel.php later for whatever use the dropdown table will be used for. This file is purely to make the dropdown dynamic 

    class Department {
        private $conn;
        public function __construct($db)
        {
            $this->conn = $db; // Assign the database connection to the private variable $conn for use within the class methods.
        }

        public function createRegistration ($fName, $lName) {
            try {
                // 1. Create the SQL query to insert a new registration record into the database. The query includes placeholders for the first name, last name, created at timestamp, and updated at timestamp. By using placeholders (e.g., :firstName), we can later bind the actual values to these parameters when executing the query, which helps prevent SQL injection attacks and allows for more secure database interactions.
                $query = "INSERT INTO tbl_registrations 
                (firstName, lastName, createdAt, updatedAt) 
                -- To insert the values into the database, we first use parameters (:firstName and :lastName) in the SQL query. Then later on, we will bind the actual values of $firstName and $lastName to these parameters.
                VALUES (:firstName, :lastName, :createdAt, :updatedAt)";

                // 2. Prepare the SQL query using the database connection. This alows us to execute the query with the bound parameters later on. The prepare method is used to create a prepared statement, which can be executed multiple times with different parameter values. This helps improve performance and security when interacting with the database.
                $response = $this->conn->prepare($query);

                // 3. Bind the actual values of $fName and $lName to the corresponding parameters in the prepared statement. This step involves associating the values of $fName and $lName with the placeholders (:firstName and :lastName) defined in the SQL query. Additionally, we can also bind the current timestamps for createdAt and updatedAt parameters to ensure that the registration record is accurately timestamped when it is inserted into the database.
                $response->bindParam(':firstName', $fName);
                $response->bindParam(':lastName', $lName);

                // Workaround since createdAt and updatedAt wont work.
                $dateNow = date('Y-m-d H:i:s'); // Get the current date and time in the format 'YYYY-MM-DD HH:MM:SS'
                
                $response->bindParam(':createdAt', $dateNow);
                $response->bindParam(':updatedAt', $dateNow);

                // 4. Execute the prepared statement to insert the new registration record into the database. This step involves running the SQL query with the bound parameters, which will add a new entry to the tbl_registrations table with the provided first name, last name, and timestamps for createdAt and updatedAt. If the execution is successful, the new registration record will be stored in the database, allowing us to later retrieve or manage this data as needed.
                $response->execute();
                return $response;
            } catch (PDOException $ex) {
                // error handling for database 
                error_log("Database error: " . $ex->getMessage());
                return false;
            }
        }

        public function readDepartment() {
            try {
                $query = "SELECT * FROM tbl_departments";
                $response = $this->conn->prepare($query);
                $response->execute();
                return $response;
            } catch (PDOException $ex) {
                // error handling for database 
                error_log("Database error: " . $ex->getMessage());
                return false;
            }
        }

        public function updateRegistration($fName, $lName, $regID) {
            $query = "UPDATE tbl_registrations 
            SET firstName = :firstName, lastName = :lastName, updatedAt = :updatedAt 
            WHERE registrationID = :registrationID";

            $dateNow = date('Y-m-d H:i:s'); // Get the current date and time in the format 'YYYY-MM-DD HH:MM:SS'
            
            $response = $this->conn->prepare($query);
            $response->bindParam(':firstName', $fName);
            $response->bindParam(':lastName', $lName);
            $response->bindParam(':registrationID', $regID);
            $response->bindParam(':updatedAt', $dateNow);

            $response->execute();
            return $response;
        }

        public function deleteRegistration($regID) {
            $query = "DELETE FROM tbl_registrations WHERE registrationID = :registrationID";

            $response = $this->conn->prepare($query);
            $response->bindParam(':registrationID', $regID);

            $response->execute();
            return $response;
        }


    }
?>