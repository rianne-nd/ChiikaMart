const inputFirstName = document.getElementById("txtFirstname");
const inputLastName = document.getElementById("txtLastname");
const inputSuffix = document.getElementById("txtSuffix");
const inputPhone = document.getElementById("txtPhoneNumber");
const inputZipCode = document.getElementById("txtZipCode");

if (inputFirstName) {
    inputFirstName.addEventListener("input", function() {
        allowOnlyLetters(this);
    });
}

if (inputLastName) {
    inputLastName.addEventListener("input", function() {
        allowOnlyLetters(this);
    });
}

if (inputSuffix) {
    inputSuffix.addEventListener("input", function() {
        allowSuffixInput(this);
    });
}

// "If inputPhone exists on this page, THEN add the listener"
if (inputPhone) {
    inputPhone.addEventListener("input", function() {
        allowOnlyNumber(this);
    });
}

// "If inputZipCode exists on this page, THEN add the listener"
if (inputZipCode) {
    inputZipCode.addEventListener("input", function() {
        allowOnlyNumber(this);
    });
}

function allowOnlyNumber(element) {
    element.value = element.value.replace(/[^0-9]/g, "");
}


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

    if (birthday !== "") {
        var selectedDate = new Date(birthday);
        var today = new Date();
        
       today.setHours(0, 0, 0, 0);

        if (selectedDate > today) {
            Swal.fire({
                title: "Error!",
                text: "Birthday cannot be a future date. Please select a valid date.",
                icon: "error",
                confirmButtonText: "OK"
            });
            return; 
        }
    }

    if (!phoneNumber.startsWith("09")) {
        Swal.fire({
            title: "Error!",
            text: "Please enter a valid 11-digit mobile number starting with 09.",
            icon: "warning",
            confirmButtonText: "OK"
        });
        return;
    }

    if (password.length < 8) {
        Swal.fire({
            title: "Error!",
            text: "For your security, passwords must be at least 8 characters long.",
            icon: "warning",
            confirmButtonText: "OK"
        });
        return;
    }

    var uppercasePattern = /[A-Z]/;
    var uniqueCharPattern = /[^A-Za-z0-9]/;
    
    if (!uppercasePattern.test(password) || !uniqueCharPattern.test(password)) {
        Swal.fire({
            title: "Error!",
            text: "Password must contain at least one uppercase letter and one unique/special character.",
            icon: "warning",
            confirmButtonText: "OK"
        });
        return;
    }

    Swal.fire({
        title: 'Please wait...',
        text: 'Creating your account and sending confirmation email...',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

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
            Swal.close();
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
    
    Swal.fire({
        title: 'Please wait...',
        text: 'Verifying your credentials...',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: '../controllers/UserController.php', 
        type: 'POST',
        data: { 
            lEmail: loginEmail,
            lPassword: loginPassword
        },
        success: function(returnedData){
            // 1. Check if the returned data is "admin"
            if (returnedData.trim() === "admin") {
                Swal.fire({
                    title: "Welcome Admin!",
                    text: "Logging into the Admin Dashboard...",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    redirectFunc(2); // 2 goes to Dashboard.php
                });
            } 
            // 2. Check if the returned data is "customer"
            else if (returnedData.trim() === "customer") {
                Swal.fire({
                    title: "Success!",
                    text: "User logged in successfully!",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    redirectFunc(4); // 4 goes to HomePage.php
                });
            } 
            // 3. Handle incorrect logins
            else {
                Swal.fire({
                    title: "Error!",
                    text: "User not found or incorrect password. Please try again.",
                    icon: "error"
                });
            }}
        }
    );}
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

function togglePasswordVisibility(inputId, iconId) {
    var input = document.getElementById(inputId);
    var icon = document.getElementById(iconId);
    if (input.type === "password") {
        input.type = "text";
        icon.textContent = "visibility";
    } else {
        input.type = "password";
        icon.textContent = "visibility_off";
    }
}

function allowOnlyLetters(element) {
    element.value = element.value.replace(/[^A-Za-z]/g, "");
}

function allowSuffixInput(element) {
    element.value = element.value.replace(/[^A-Za-z.]/g, "");
}

$(document).ready( function () {
    // for calendar, restrict date selection to today and past dates only
    $('.datepicker').datepicker({
        autoClose: true,
        format: 'yyyy-mm-dd',
        maxDate: new Date(),
        yearRange: [1900, new Date().getFullYear()]
    });

    if ($('#myTable').length) {
        $('#myTable').DataTable();
    }
});