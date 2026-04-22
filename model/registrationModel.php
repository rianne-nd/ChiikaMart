<?php
    class Registration{
        //To allow connection to the database every time we create an instance of the Registration class, we can use the constructor method to establish a connection to the database. This way, we can ensure that the database connection is available for any methods within the Registration class that need to interact with the database, such as adding new users or retrieving user information. By passing the database connection as a parameter to the constructor, we can also make the Registration class more flexible and reusable, allowing us to easily switch to a different database connection if needed without having to modify the internal logic of the class.
        //To enable us to access the connection inside the constructor, we can declare a private variable within the Registration class to hold the database connection. This variable can be assigned the value of the database connection passed as a parameter to the constructor. By doing this, we can ensure that the database connection is stored as a property of the Registration class and can be accessed by any methods within the class that require it. This approach allows us to maintain a clean and organized structure for our code while also providing easy access to the database connection whenever needed.
        private $conn;
        public function __construct($db)
        {
            $this->conn = $db; // Assign the database connection to the private variable $conn for use within the class methods.
        }

        public function createRegistration ($fName, $lName, $dept) {

            try {
                // 1. Create the SQL query to insert a new registration record into the database. The query includes placeholders for the first name, last name, department, created at timestamp, and updated at timestamp. By using placeholders (e.g., :firstName), we can later bind the actual values to these parameters when executing the query, which helps prevent SQL injection attacks and allows for more secure database interactions.
                $query = "INSERT INTO tbl_registrations 
                (firstName, lastName, department, createdAt, updatedAt) 
                -- To insert the values into the database, we first use parameters (:firstName and :lastName) in the SQL query. Then later on, we will bind the actual values of $firstName and $lastName to these parameters.
                VALUES (:firstName, :lastName, :department, :createdAt, :updatedAt)";

                // 2. Prepare the SQL query using the database connection. This alows us to execute the query with the bound parameters later on. The prepare method is used to create a prepared statement, which can be executed multiple times with different parameter values. This helps improve performance and security when interacting with the database.
                $response = $this->conn->prepare($query);

                $password_hash = password_hash($fName, PASSWORD_ARGON2ID);

                $password_check = password_verify($fName, $password_hash);

                // Change based on use, just a sample. Add to login function later on.
                $selectQuery = "SELECT * FROM TBL WHERE EMAIL = EMAIL";
                if($selectQuery) {
                    $password_check = password_verify($inputted_pass, $selectQuery.password);
                    if( $password_check ) {
                    //bahala na kayo
                    }
                    //bahala
                }


                // Workaround since createdAt and updatedAt wont work.
                $dateNow = date('Y-m-d H:i:s'); // Get the current date and time in the format 'YYYY-MM-DD HH:MM:SS'

                // 3. Bind the actual values of $fName and $lName to the corresponding parameters in the prepared statement. This step involves associating the values of $fName and $lName with the placeholders (:firstName and :lastName) defined in the SQL query. Additionally, we can also bind the current timestamps for createdAt and updatedAt parameters to ensure that the registration record is accurately timestamped when it is inserted into the database.
                $response->bindParam(':firstName', $fName);
                $response->bindParam(':lastName', $lName);
                $response->bindParam(':department', $dept);

                $response->bindParam(':createdAt', $dateNow);
                $response->bindParam(':updatedAt', $dateNow);

                // 4. Execute the prepared statement to insert the new registration record into the database. This step involves running the SQL query with the bound parameters, which will add a new entry to the tbl_registrations table with the provided first name, last name, department, and timestamps for createdAt and updatedAt. If the execution is successful, the new registration record will be stored in the database, allowing us to later retrieve or manage this data as needed.
                $response->execute();
                return $response;
            } catch (PDOException $ex) {
                // error handling for database 
                error_log("Database error: " . $ex->getMessage());
                return false;
            }
        }

        public function readRegistration() {
            try {
                // 1. Create the SQL query to select all registration records from the database. This query retrieves all entries from the tbl_registration table, allowing us to access the complete list of registrations stored in the database.
                $query = "SELECT * FROM tbl_registrations";

                // 2. Prepare the SQL query using the database connection. This step allows us to execute the query and retrieve the results later on. By preparing the statement, we can also optimize performance and enhance security when interacting with the database.
                $response = $this->conn->prepare($query);

                // 3. Execute the prepared statement to fetch all registration records from the database. This step runs the SQL query and retrieves the data, which can then be processed or returned as needed. If successful, this will provide access to all registration entries stored in the tbl_registration table.
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