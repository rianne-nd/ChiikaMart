function addFunc() {
    var firstName = document.getElementById("txtFirstname").value;
    var lastName = document.getElementById("txtLastname").value;
    var suffix = document.getElementById("txtSuffix").value;
    var birthday = document.getElementById("txtBirthday").value;
    var phoneNumber = document.getElementById("txtPhoneNumber").value;

    var email = document.getElementById("txtEmail").value;
    var password = document.getElementById("txtPassword").value;
    var confirmPassword = document.getElementById("txtConfirmPassword").value;

    var street = document.getElementById("txtStreet").value;
    var barangay = document.getElementById("txtBarangay").value;
    var city = document.getElementById("txtCity").value;
    var province = document.getElementById("txtProvince").value;
    var zipCode = document.getElementById("txtZipCode").value;

    if (password !== confirmPassword) {
        Swal.fire({
            title: "Error!",
            text: "Passwords do not match. Please try again.",
            icon: "error",
            confirmButtonText: "OK"
        });
        return; 
    }


    $.ajax({
        url: '../controllers/UserController.php', 
        type: 'POST',
        data: { 
            aFName: firstName,
            aLName: lastName,
            aSuffix: suffix,
            aBirthday: birthday,
            aPhoneNumber: phoneNumber,
            aEmail: email,
            aPassword: password,
            aStreet: street,
            aBarangay: barangay,
            aCity: city,
            aProvince: province,
            aZipCode: zipCode

        },
        success: function(returnedData){
            if (returnedData == "true") {
                Swal.fire({
                title: "Success!",
                text: "User registered successfully!",
                icon: "success",
                confirmButtonText: "Click to Reload"
                }).then((result) => {
                    redirectFunc(1);

                });
            } else {
                Swal.fire({
                    title: "Database Error!",
                    text: "Failed to register user.",
                    icon: "error"
                });
            }
        },
        error: function(xhr){ 
            alert(xhr.status + " : " + xhr.responseText);
        }
    });
}

function redirectFunc(redirectID) {
    if(redirectID == 1) {
        window.location.href = "../views/LoginPage.php";
    }
    else if(redirectID == 2) {
        window.location.href = "../views/Dashboard.php";
    }
    else if(redirectID == 3) {
        window.location.href = "../views/RegistrationPage.php";
    }
    else if(redirectID == 4) {
        window.location.href = "../views/HomePage.php";
    }
}

function loginFunc() {
    var loginEmail = document.getElementById("txtLoginEmail").value;
    var loginPassword = document.getElementById("txtLoginPassword").value;
    
    if (loginEmail === "" || loginPassword === "") {
        Swal.fire({
            title: "Error!",
            text: "Please fill in both email and password fields.",
            icon: "error",
            confirmButtonText: "OK"
        });
        return; 
    }
    
    $.ajax({
        url: '../controllers/UserController.php', 
        type: 'POST',
        data: { 
            lEmail: loginEmail,
            lPassword: loginPassword
        },
        success: function(returnedData){
            if (returnedData == "true") {
                Swal.fire({
                    title: "Success!",
                    text: "User logged in successfully!",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    redirectFunc(4); 
                });
            } else {
                Swal.fire({
                    title: "Error!",
                    text: "User not found. Please check your credentials and try again.",
                    icon: "error"
                });
            }
        },
        error: function(xhr){
            alert(xhr.status + " : " + xhr.responseText);
        }   
    });    
}

function updateFunc(userID) {
    var firstName = document.getElementById("txtFirstname").value;
    var lastName = document.getElementById("txtLastname").value;
    $.ajax({
        url: '../controllers/UserController.php',
        type: 'POST',
        data: { 
            uFName: firstName,
            uLName: lastName,
            uID: userID                
        },
        success: function(returnedData){
            Swal.fire({
            title: "Success!",
            text: "User updated successfully!",
            icon: "success",
            confirmButtonText: "Click to Reload"
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload(true);
                }
            });
            
        },
        error: function(xhr){ 
            alert(xhr.status + " : " + xhr.responseText);
        }
    });
}

function deleteFunc(userID) {
    $.ajax({
        url: '../controllers/UserController.php', 
        type: 'POST',
        data: { 
            dID: userID
        },
        success: function(returnedData){
            Swal.fire({
            title: "Success!",
            text: "User deleted successfully!",
            icon: "success",
            confirmButtonText: "Click to Reload"
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload(true);
                }
            });

        },
        error: function(xhr){  
            alert(xhr.status + " : " + xhr.responseText);
        }
    });
}


$(document).ready( function () {
    if ($('#myTable').length) {
        $('#myTable').DataTable();
    }
});