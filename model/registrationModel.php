<?php
    class Registration{
        //To allow connection to the database every time we create an instance of the Registration class, we can use the constructor method to establish a connection to the database. This way, we can ensure that the database connection is available for any methods within the Registration class that need to interact with the database, such as adding new users or retrieving user information. By passing the database connection as a parameter to the constructor, we can also make the Registration class more flexible and reusable, allowing us to easily switch to a different database connection if needed without having to modify the internal logic of the class.
        //To enable us to access the connection inside the constructor, we can declare a private variable within the Registration class to hold the database connection. This variable can be assigned the value of the database connection passed as a parameter to the constructor. By doing this, we can ensure that the database connection is stored as a property of the Registration class and can be accessed by any methods within the class that require it. This approach allows us to maintain a clean and organized structure for our code while also providing easy access to the database connection whenever needed.
        private $conn;
        public function __construct($db)
        {
            $this->conn = $db; // Assign the database connection to the private variable $conn for use within the class methods.
        }

        public function createRegistration ($firstName, $email, $password, $roleID = 2) {
            try {
                // 1. Create the SQL query to insert a new registration record into the database. The query includes placeholders for the first name, last name, created at timestamp, and updated at timestamp. By using placeholders (e.g., :firstName), we can later bind the actual values to these parameters when executing the query, which helps prevent SQL injection attacks and allows for more secure database interactions.
                $query = "INSERT INTO users 
                (firstName, email, password, roleID, createdAt, updatedAt) 
                VALUES (:firstName, :email, :password, :roleID, :createdAt, :updatedAt)";

                // 2. Prepare the SQL query using the database connection. This alows us to execute the query with the bound parameters later on. The prepare method is used to create a prepared statement, which can be executed multiple times with different parameter values. This helps improve performance and security when interacting with the database.
                $response = $this->conn->prepare($query);

                // 3. Bind the actual values of $firstName and $lastName to the corresponding parameters in the prepared statement. This step involves associating the values of $firstName and $lastName with the placeholders (:firstName and :lastName) defined in the SQL query. Additionally, we can also bind the current timestamps for createdAt and updatedAt parameters to ensure that the registration record is accurately timestamped when it is inserted into the database.
                $response->bindParam(':firstName', $firstName);
                $response->bindParam(':email', $email);
                $response->bindParam(':password', $password);
                $response->bindParam(':roleID', $roleID);

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

        public function getUserbyEmail($email){
            try {
                // 1. Create the SQL query
                $query = "SELECT * FROM users WHERE email = :email";
                
                // 2. Prepare the SQL query
                $response = $this->conn->prepare($query);
                
                // 3. Bind the email parameter
                $response->bindParam(':email', $email);
                
                // 4. Execute the query
                $response->execute();
                return $response->fetch(PDO::FETCH_ASSOC); // Get the user data as an associative array (e.g., input john@example.com, returns ['firstName' => 'John', 'email' => 'john@example.com'])
                
            } catch (PDOException $ex) {
                error_log("Database error: " . $ex->getMessage());
                return false;
            }
        }
    }
?>