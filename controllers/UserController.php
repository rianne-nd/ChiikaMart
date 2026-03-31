<?php

    session_start();

    require_once '../bl/userManagement.php';
    
    $usermanagement = new UserManagement();
   
    if(isset($_POST['aFName'], $_POST['aLName'], $_POST['aSuffix'], $_POST['aBirthday'], $_POST['aPhoneNumber'], $_POST['aEmail'], $_POST['aPassword'], $_POST['aStreet'], $_POST['aBarangay'], $_POST['aCity'], $_POST['aProvince'], $_POST['aZipCode'])) {
        $usermanagement->addUserFunc($_POST['aFName'], $_POST['aLName'], $_POST['aSuffix'], $_POST['aBirthday'], $_POST['aPhoneNumber'], $_POST['aEmail'], $_POST['aPassword'], $_POST['aStreet'], $_POST['aBarangay'], $_POST['aCity'], $_POST['aProvince'], $_POST['aZipCode']);
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
