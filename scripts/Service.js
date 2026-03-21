// Service.js
// This file contains the JavaScript functions that handle AJAX requests for user management operations such as adding, updating, deleting, and logging in users. It also includes a function for redirecting to different pages based on user actions.

function addFunc() {
    var firstName = document.getElementById("txtFirstname").value;
    var lastName = document.getElementById("txtLastname").value;
    $.ajax({
        url: '../controllers/UserController.php', 
        type: 'POST',
        data: { 
            fname: firstName,
            lName: lastName
        },
        success: function(returnedData){
        
            Swal.fire({
            title: "Success!",
            text: "User added successfully!",
            icon: "success",
            confirmButtonText: "Click to Reload"
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload(true);
                }
        });

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
