<?php
    require_once '../bl/DepartmentManagement.php';

    $deptmanagement = new DepartmentManagement();
    $depts = $deptmanagement->getCardDepartment();
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

    <title>Document</title>
</head>
<body>
    <p> We are on the dashboard!</p>

    <div>
        <div class="row">
            <?php foreach($depts as $index => $dept) :  ?>
            <div class="col s12 m6">
            <div class="card blue-grey darken-1">
            <div class="card-content white-text">
                <span class="card-title"><?= $dept['departmentDescription'] ?></span>
                <p><?= $dept['total_users'] ?></p>
            </div>
        </div>
        </div>
        <?php endforeach; ?>

  </div>
            

    </div>
</body>
</html>