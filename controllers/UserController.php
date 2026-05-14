<?php
session_start();
// UserController.php

require_once '../bl/userManagement.php';
require_once '../helper/sendEmail.php';

$usermanagement = new UserManagement();

if (isset($_POST['aFName'], $_POST['aLName'], $_POST['aSuffix'], $_POST['aBirthday'], $_POST['aPhoneNumber'], $_POST['aEmail'], $_POST['aPassword'], $_POST['aStreet'], $_POST['aBarangay'], $_POST['aCity'], $_POST['aProvince'], $_POST['aZipCode'])) {
    
    $usermanagement->addUserFunc($_POST['aFName'], $_POST['aLName'], $_POST['aSuffix'], $_POST['aBirthday'], $_POST['aPhoneNumber'], $_POST['aEmail'], $_POST['aPassword'], $_POST['aStreet'], $_POST['aBarangay'], $_POST['aCity'], $_POST['aProvince'], $_POST['aZipCode']);
    
    $toEmail = filter_var($_POST['aEmail'], FILTER_SANITIZE_EMAIL);
    $toName = htmlspecialchars($_POST['aFName']);
    $subject = "Registration Successful - Welcome to ChiikaMart!";

    if (!filter_var($toEmail, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    $subject = "Welcome to ChiikaMart!";

    $body = <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <title>Welcome to ChiikaMart</title>
        </head>
        <body style="margin: 0; padding: 40px 10px; background-color: #fef8f4; background-image: radial-gradient(#e7e1dd 1px, transparent 1px); background-size: 20px 20px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased;">

            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color: #fef8f4; background-image: radial-gradient(#e7e1dd 1px, transparent 1px); background-size: 20px 20px;">
                <tr>
                    <td align="center">
                        
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 24px; border: 2px solid #e7e1dd; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
                            
                            <tr>
                                <td align="center" style="padding: 35px 20px; background-color: #f8f2ee; border-bottom: 1px solid #e7e1dd;">
                                    <h1 style="margin: 0; color: #2F4156; font-size: 28px; font-weight: 800; letter-spacing: -0.5px;">ChiikaMart</h1>
                                    <p style="margin: 5px 0 0 0; color: #71787c; font-size: 12px; text-transform: uppercase; letter-spacing: 2px;">The Adoption Center</p>
                                </td>
                            </tr>

                            <tr>
                                <td align="center" style="padding: 40px 30px;">
                                    
                                    <table border="0" cellpadding="0" cellspacing="0" style="background-color: #ffffff; padding: 12px 12px 35px 12px; border: 1px solid #e7e1dd; border-radius: 6px; box-shadow: 0 8px 20px rgba(0,0,0,0.06); margin-bottom: 35px;">
                                        <tr>
                                            <td align="center">
                                                <img src="https://i.ibb.co/KczHtCMt/f7677d237bf844773b83bdc8bf99af2a.jpg" alt="New Arrival Plushies" width="220" style="display: block; max-width: 100%; height: auto; border-radius: 4px; border: 1px dashed #c1c7cb;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="padding-top: 15px;">
                                                <p style="margin: 0; color: #3d6374; font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 2px;">New Arrivals!</p>
                                            </td>
                                        </tr>
                                    </table>

                                    <h2 style="margin: 0 0 15px 0; color: #2F4156; font-size: 26px; font-weight: bold; font-style: italic;">Welcome to the Family, {$toName}!</h2>
                                    <p style="margin: 0 0 35px 0; color: #41484b; font-size: 15px; line-height: 1.6; max-width: 450px;">
                                        We are so thrilled you've joined ChiikaMart! Our little adoption center is filled with soft, cuddly friends waiting for their forever homes. Get ready to explore our curated collection of handcrafted plushies.
                                    </p>

                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td align="center" style="background-color: #4d6076; border-radius: 50px;">
                                                <a href="http://localhost/ChiikaMart/views/HomePage.php" style="display: inline-block; padding: 14px 32px; color: #ffffff; text-decoration: none; font-size: 13px; font-weight: bold; text-transform: uppercase; letter-spacing: 1.5px;">Start Adopting</a>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>

                            <tr>
                                <td align="center" style="padding: 30px 20px; background-color: #f3ede9; border-top: 1px solid #e7e1dd;">
                                    <p style="margin: 0 0 10px 0; color: #426878; font-size: 18px;">
                                        ♡ &nbsp; 🛒
                                    </p>
                                    <p style="margin: 0; color: #71787c; font-size: 11px;">
                                        © 2024 Plushie Haven Adoption Center. Hand-stitched with love.
                                    </p>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>
        HTML;

    $result = sendEmail(
        $toEmail,
        $toName,
        $subject,
        $body
    );

    exit;

} else if (isset($_POST['uFName'], $_POST['uLName'], $_POST['uID'])) {
    $usermanagement->updateUserFunc($_POST['uFName'], $_POST['uLName'], $_POST['uID']);
    exit;
} elseif (isset($_POST['dID'])) {
    $usermanagement->deleteUserFunc($_POST['dID']);
    exit;
} elseif (isset($_POST['lEmail'], $_POST['lPassword'])) {
    $usermanagement->loginUserFunc($_POST['lEmail'], $_POST['lPassword']);
    exit;
}

?>