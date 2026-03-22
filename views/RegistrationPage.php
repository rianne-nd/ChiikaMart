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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
    
    
    <title>Document</title>
</head>
<body class = "#e3f2fd blue lighten-5">
    <nav>
    <div class="nav-wrapper #2962ff blue accent-4">
      <a href="#" class="brand-logo" style="padding-left: 24px; ">ꉂ(˵˃ ᗜ ˂˵)✮⋆˙˖Ი𐑼⋆</a> 
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <?php if(!empty($users)) : ?>
        <li><a href="https://materializecss.com/" target="_blank" >MaterializeCSS</a></li>
        <?php endif; ?>
        <a class="waves-effect waves-light btn-large" onclick="redirectFunc(1)"><i class="material-icons right">cloud</i>LOGIN</a>

      </ul>
    </div>  
    </nav>

    <br><br>
    <div class = "row">
        <div class = "col s4 m4 l4">
        </div>
        <div class = "col s4 m4 l4">
            <div class="row">
                <div class="row card-panel #e1f5fe light-blue lighten-5">
                    <div>
                        <h4 class="center-align">User Registration</h4>
                    </div>
                    <!-- First Name input -->
                    <div class="input-field col s12 m12 l12">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="txtRegisterFirstname" type="text" class="validate">
                        <label for="txtRegisterFirstname">First Name</label>
                    </div>
                    <!-- Email input -->
                        <div class="input-field col s6 m6 l6">
                        <i class="material-icons prefix">email</i>
                        <input id="txtRegisterEmail" type="email" class="validate">
                        <label for="txtRegisterEmail">Email</label>
                    </div>
                    <!-- Password input -->
                    <div class="input-field col s6 m6 l6">
                        <i class="material-icons prefix">lock</i>
                        <input id="txtRegisterPassword" type="password" class="validate">
                        <label for="txtRegisterPassword">Password</label>
                    </div>
                    <!-- Add Button -->
                    <div class = "col s12 m12 l12">
                        <a class="waves-effect waves-light btn-large #0d47a1 blue darken-4" style="width: 100%;" onclick="addFunc()">
                        <i class="material-icons right">add_circle</i>
                        ADD
                        </a>
                    </div>
                    
                    <br>
                    <div class="col s12 m12 l12">
                        <table id="myTable" class="highlight centered responsive-table display">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>First Name</th>
                                <th>Email</th>
                                <th>Password (Hashed)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($users)) : ?>
                            <?php foreach($users as $user) : ?>
                                <tr>
                                    <td><?= $user['userID'] ?></td>
                                    <td><?=  $user['firstName'] ?></td>
                                    <td><?=  $user['email'] ?></td>
                                    <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?= $user['password'] ?>"><?=  $user['password'] ?></td>
                                    <td>
                                        <a class="waves-effect waves-light btn #3f51b5 indigo" style="width: 100%; margin: 2%;" onclick="updateFunc(<?= $user['userID'] ?>)"><i class="material-icons right">autorenew</i>UPDATE</a>
                                        <a class="waves-effect waves-light btn #d32f2f red darken-2" style="width: 100%; margin: 2%;" onclick="deleteFunc(<?= $user['userID'] ?>)"><i class="material-icons right">remove_circle</i>DELETE</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class = "col s4 m4 l4"></div>
    </div>
   
        <script src = "../scripts/Service.js?v=<?= time(); ?>"></script>
                            
    <br><br>
</body>

</html>

<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    });
</script>