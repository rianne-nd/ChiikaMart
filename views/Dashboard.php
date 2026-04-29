<?php
    require_once '../bl/DepartmentManagement.php';

    $deptmanagement = new DepartmentManagement();
    $depts = $deptmanagement->getCardDepartment();

    // To make the barchart dynamic, we will store the department descriptions in the $labels array and the corresponding total user counts in the $data array. 
    // We will use these in the Service.js file to populate the labels and data for the Chart.js bar chart. 
    $labels = array_column($depts, 'departmentDescription');
    $data = array_column($depts, 'total_users');
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        <div>
            <canvas id="barChart" ></canvas>
        </div>
    </div>
    <script> 
    // To pass the PHP data to JavaScript, converting the PHP arrays ($labels and $data) into JSON format using json_encode(). This allows us to easily access the data in JavaScript as objects or arrays. We assign the JSON-encoded data to a global variable window.barData, which can then be used in our Chart.js configuration to populate the labels and data for the bar chart. By doing this, we can dynamically generate the chart based on the data retrieved from the database, allowing for a more interactive and data-driven visualization on the frontend.
        window.barData = {
            labels : <?= json_encode($labels) ?>,
            data : <?= json_encode($data) ?>
        }
    </script>
    <script src="../scripts/Service.js"></script>
</body>
</html>