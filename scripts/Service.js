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

    if (firstName === "" || lastName === "" || phoneNumber === "" || email === "" || password === "" || street === "" || barangay === "" || city === "" || province === "" || zipCode === "") {
            Swal.fire({
                title: "Missing Information!",
                text: "Please fill out all required fields.",
                icon: "warning",
                confirmButtonText: "OK"
            });
            return; 
        }

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
            if (returnedData.trim() === "User is added successfully.") {
                Swal.fire({
                title: "Success!",
                text: "User registered successfully!",
                icon: "success",
                confirmButtonText: "Click to Reload"
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload(true);
                    }
                });
            } else {
                Swal.fire({
                    title: "Database Error!",
                    text: returnedData,
                    icon: "error"
                });
            }
        },
        error: function(xhr){ // xhr = XMLHttpRequest
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
            if (returnedData.trim() === "User is updated successfully.") {
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
            } else {
                Swal.fire({
                    title: "Database Error!",
                    text: returnedData,
                    icon: "error"
                });
            }
        },
        error: function(xhr){ // xhr = 
            alert(xhr.status + " : " + xhr.responseText);
        }
    });
}

function deleteFunc(userID) {
    $.ajax({
        url: '../controllers/UserController.php', //
        type: 'POST',
        data: { 
            dID: userID
        },
        success: function(returnedData){
            if (returnedData.trim() === "User is deleted successfully.") {
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
            } else {
                Swal.fire({
                    title: "Database Error!",
                    text: returnedData,
                    icon: "error"
                });
            }
        },
        error: function(xhr){  
            alert(xhr.status + " : " + xhr.responseText);
        }
    });
}

function changeFirstName() {
    var firstNameValue = document.getElementById("txtFirstname").value;
    var LastnameValue = document.getElementById("txtLastname").value;
    $.ajax({
        url: '../controllers/UserController.php', 
        type: 'POST',
        data: { 
            fname: firstNameValue,
            lName: LastnameValue
            
        },
        success: function(returnedData){
            // You can handle the response from the server here if needed
            alert(returnedData);
            location.reload(true);
        },
        error: function(xhr){ // xhr = XMLHttpRequest
            alert("Status : " + xhr.status + "\n" +
                "Error Message : " + xhr.responseText);
        }
    })
}

function redirectFunc(redirectID) {
    if(redirectID == 1) {
        window.location.href = "../views/LoginPage.php";
    }
    else if(redirectID == 2) {
        window.location.href = "../views/Dasboard.php";
    }
    else if(redirectID == 3) {
        window.location.href = "../views/RegistrationPage.php";
    }
}

function loginFunc() {
    var loginFirstName = document.getElementById("login_fName").value;
    var loginLastName = document.getElementById("login_lName").value;
    $.ajax({
        url: '../controllers/UserController.php', 
        type: 'POST',
        data: { 
            lFName: loginFirstName,
            lLName: loginLastName
        },
        success: function(returnedData){
            if (returnedData.trim() === "true") {
                Swal.fire({
                    title: "Success!",
                    text: "User logged in successfully!",
                    icon: "success",
                    confirmButtonText: "OK"
                });
                
                // Display the logged-in user's first and last name on the page after successful login
                var userInfoDiv = document.getElementById("userInfo");
                if (userInfoDiv) {
                    userInfoDiv.innerHTML = "<h4>User Info</h4><p>First Name: " + loginFirstName + "</p><p>Last Name: " + loginLastName + "</p>";
                }

                redirectFunc(3); // Redirect to dashboard after successful login
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

    $(document).ready( function () {
        $('#myTable').DataTable();
    });