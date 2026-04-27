// Code below is for allowing only numbers in the input field with id "txtFirstName". It adds an event listener to the input field that triggers the allowOnlyNumber function whenever the user types something. The allowOnlyNumber function uses a regular expression to replace any non-numeric characters with an empty string, effectively allowing only numbers to be entered in the input field.
const inputNumber = document.getElementById("txtFirstName");

inputNumber.addEventListener("input", function() {
    allowOnlyNumber(this);
});

function allowOnlyNumber(element) {
    element.value = element.value.replace(/[^0-9]/g, "");
}

// Another input validation are in the Dashboard.php, the input fields have maxlength attribute, which limits the number of characters that can be entered in the input fields. For example, the input field with id "txtFirstName" has a maxlength of 50, which means that users can only enter up to 50 characters in that field. This helps to ensure that the data entered by users is within a reasonable length and prevents excessively long inputs that could potentially cause issues in the database or application.

function addFunc() {
    var firstName = document.getElementById("txtFirstName").value;
    var lastName = document.getElementById("txtLastName").value;
    var departmentValue = document.getElementById("departmentSelect").value;
    alert(departmentValue);

    if (firstName.length < 5) {
        return;
    }


    $.ajax({
        url: "../controllers/UserController.php",
        type: "POST",
        data: {
            fname: firstName,
            lName: lastName,
            dept: departmentValue
        },
        success: function(returnedData) {
            alert(returnedData);
        },

        error: function(xhr) {
            alert(xhr.status + " : " + xhr.responseText);
        }
    });
}

function updateFunc(userID) {
    var firstName = document.getElementById("txtFirstName").value;
    var lastName = document.getElementById("txtLastName").value;
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
    var firstNameValue = document.getElementById("txtFirstName").value;
    var LastnameValue = document.getElementById("txtLastName").value;
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

$(document).ready(function(){
    $('#myTable').DataTable();
    $('select').formSelect();
    $('.datepicker').datepicker({
        maxDate: new Date(),
        format: 'yyyy-mm-dd',
        autoClose: true
    });
});