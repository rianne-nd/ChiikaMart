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
<div class="input-field col s12 m12 l12">
        <i class="material-icons prefix">email</i>
        <input id="txtLoginEmail" type="email" class="validate" required>
        <label for="txtLoginEmail">Email</label>
    </div>

    <div class="input-field col s12 m12 l12">
        <i class="material-icons prefix">lock</i>
        <input id="txtLoginPassword" type="password" class="validate" required>
        <label for="txtLoginPassword">Password</label>
    </div>

    <div class="col s12 m12 l12">
        <button type="submit" class="waves-effect waves-light btn-large blue darken-4" style="width: 100%;" onclick="loginFunc()">
            Login
            <i class="material-icons right">login</i>
        </button>
    </div>


    </div>
    <script src = "../scripts/Service.js"></script>
</body>
</html>