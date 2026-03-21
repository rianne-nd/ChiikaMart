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
    <!-- First Name -->
    <div class="input-field col s6 m6 l6">
        <i class="material-icons prefix">account_circle</i>
        <input id="login_fName" type="text" class="validate">
        <label for="login_fName">First Name</label>
    </div>
    <!-- Last Name -->
    <div class="input-field col s6 m6 l6"> 
        <i class="material-icons prefix">account_circle</i>
        <input id="login_lName" type="text" class="validate">
        <label for="login_lName">Last Name</label>
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
    <script src = "../scripts/Service.js"></script>
</body>
</html>