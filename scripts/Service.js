  const ctx = document.getElementById('barChart');
  const lineChart = document.getElementById('lineChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
        // The labels and data for the bar chart are dynamically generated from the PHP variables $labels and $data, which are passed to JavaScript using json_encode(). This allows us 
      labels: window.barData.labels,
      datasets: [{
        label: '# of Votes',
        data: window.barData.data,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  
    new Chart(lineChart, {
    type: 'line',
    data: {
        // The labels and data for the bar chart are dynamically generated from the PHP variables $labels and $data, which are passed to JavaScript using json_encode(). This allows us 
      labels: window.barData.labels,
      datasets: [{
        label: '# of Votes',
        data: [65, 59, 80, 81, 56, 55, 40],
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
    
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });


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