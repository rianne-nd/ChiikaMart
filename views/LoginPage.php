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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Login</title>
</head>
<body>
    <!-- Email -->
    <div class="input-field col s6 m6 l6">
        <i class="material-icons prefix">email</i>
        <input id="txtLoginEmail" type="email" class="validate">
        <label for="txtLoginEmail">Email</label>
    </div>
    <!-- Password -->
    <div class="input-field col s6 m6 l6">
        <i class="material-icons prefix">lock</i>
        <input id="txtLoginPassword" type="password" class="validate">
        <label for="txtLoginPassword">Password</label>
    </div>
    <!-- Login Button -->
    <div class = "col s12 m12 l12">
        <a class="waves-effect waves-light btn-large #0d47a1 blue darken-4" style="width: 100%;" onclick="loginFunc()"> Login </a>
        <i class="material-icons right">add_circle</i>
        
        </a>
    </div>
    <!-- User Info (Display the logged-in user's first and last name) -->
    <div id="userInfo" class="col s12 m12 l12" style="margin-top: 20px; text-align: center; font-size: 1.2em;">

    </div>
    <script src = "../scripts/Service.js?v=<?= time(); ?>"></script>
</body>
</html>