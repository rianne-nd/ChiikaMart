<?php

    session_start();
    // UserController.php
// This file contains the PHP code for handling user management operations such as adding, updating, deleting, and logging in users. It interacts with the UserManagement class to perform these operations based on AJAX requests from the front-end. -->

    // require_once is used to include the UserManagement class from the specified file path. This allows the UserController to create an instance of the UserManagement class and call its methods to manage user data stored in PHP sessions. The require_once statement ensures that the file is included only once, preventing potential issues with multiple inclusions.
    require_once '../bl/userManagement.php';
    
    // Create an instance of the UserManagement class, which will be used to call its methods for managing user data stored in PHP sessions. This instance allows the UserController to interact with the user management functionality provided by the UserManagement class, such as adding, updating, deleting, and retrieving users, as well as handling user login operations.
    $usermanagement = new UserManagement();

    // The following code checks for specific POST parameters to determine which user management operation to perform. Depending on the presence of these parameters, it calls the corresponding method in the UserManagement class to add, update, delete, or log in a user. After performing the operation, it exits to prevent further execution of the script.
    // For example, if the POST parameters 'fname' and 'lName' are set, it calls the addUserFunc method to add a new user with the provided first and last name. 
    // If the parameters 'uFName', 'uLName', and 'uID' are set, it calls the updateUserFunc method to update an existing user's information based on their user ID. 
    // If the parameter 'dID' is set, it calls the deleteUserFunc method to remove a user from the session array. 
    // Finally, if the parameters 'lFName' and 'lLName' are set, it calls the loginUserFunc method to check if a user's first and last name exist in the session array for login purposes.
   
    if(isset($_POST['rFName'], $_POST['rEmail'], $_POST['rPassword'])) {
        // Using the object $usermanagement, we call the addUserFunc method, passing the required fields received from the POST request as parameters.
        $usermanagement->addUserFunc($_POST['rFName'], $_POST['rEmail'], $_POST['rPassword']);
        exit;
    } else if (isset($_POST['uFName'], $_POST['uLName'], $_POST['uID'])) {
        $usermanagement->updateUserFunc($_POST['uFName'], $_POST['uLName'], $_POST['uID']);
        exit;
    } elseif(isset($_POST['dID'])) {
        $usermanagement->deleteUserFunc($_POST['dID']);
        exit;
    } elseif(isset($_POST['lEmail'], $_POST['lPassword'])) {
        $usermanagement -> loginUserFunc($_POST['lEmail'], $_POST['lPassword']);
        exit;
    }
    
?>
