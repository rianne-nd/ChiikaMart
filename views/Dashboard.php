<?php
    session_start();
    require_once '../bl/userManagement.php';

    $usermanagement = new UserManagement();
    // users contain the current session array of users, which is retrieved by calling the getUser method of the UserManagement class. This allows the registration page to display the list of registered users and their information, such as first name and last name, in a table format on the page. The $users variable is used in the HTML part of the code to loop through the user data and generate the table rows dynamically based on the current session data.
    $users = $usermanagement->getUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>