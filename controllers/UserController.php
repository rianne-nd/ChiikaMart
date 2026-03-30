<?php

    session_start();

    require_once '../bl/userManagement.php';
    
    $usermanagement = new UserManagement();
   
    if(isset($_POST['aFName'], $_POST['aLName'])) {
        $usermanagement->addUserFunc($_POST['aFName'], $_POST['aLName']);
        exit;
    } else if (isset($_POST['uFName'], $_POST['uLName'], $_POST['uID'])) {
        $usermanagement->updateUserFunc($_POST['uFName'], $_POST['uLName'], $_POST['uID']);
        exit;
    } elseif(isset($_POST['dID'])) {
        $usermanagement->deleteUserFunc($_POST['dID']);
        exit;
    } elseif(isset($_POST['lFName'], $_POST['lLName'])) {
        $usermanagement -> loginUserFunc($_POST['lFName'], $_POST['lLName']);
        exit;
    }
    
?>
