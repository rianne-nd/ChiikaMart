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

if (inputPhone) {
    inputPhone.addEventListener("input", function() {
        allowOnlyNumber(this);
    });
}

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
            if (returnedData.trim() === "admin") {
                Swal.fire({
                    title: "Welcome Admin!",
                    text: "Logging into the Admin Dashboard...",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    redirectFunc(2); 
                });
            } 
            else if (returnedData.trim() === "customer") {
                Swal.fire({
                    title: "Success!",
                    text: "User logged in successfully!",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    redirectFunc(4); 
                });
            } 
            else {
                Swal.fire({
                    title: "Error!",
                    text: "User not found or incorrect password. Please try again.",
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
function updateFunc(button) {
    var data = button.dataset;
    var roleId = data.roleId || "2";
    var isActive = data.isActive || "1";

    Swal.fire({
        title: "Update User Details",
        width: '700px',
        customClass: {
            htmlContainer: 'text-left'
        },
        html:
            '<div class="text-xs text-gray-500 mb-4 px-1"><span class="text-red-500 font-bold">*</span> Indicates a required field</div>' +
            '<div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-3 font-sans p-1">' +
                
                '' +
                '<div class="flex flex-col">' +
                    '<label class="text-xs font-semibold text-gray-700 mb-1">First Name <span class="text-red-500">*</span></label>' +
                    '<input id="swalFirstName" maxlength="49" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="First Name">' +
                '</div>' +
                
                '' +
                '<div class="flex flex-col">' +
                    '<label class="text-xs font-semibold text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>' +
                    '<input id="swalLastName" maxlength="49" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="Last Name">' +
                '</div>' +
                
                '' +
                '<div class="flex flex-col">' +
                    '<label class="text-xs font-semibold text-gray-700 mb-1">Suffix <span class="text-gray-400 font-normal">(Optional)</span></label>' +
                    '<input id="swalSuffix" maxlength="9" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="e.g. Jr., III">' +
                '</div>' +
                
                '' +
                '<div class="flex flex-col">' +
                    '<label class="text-xs font-semibold text-gray-700 mb-1">Birthday <span class="text-red-500">*</span></label>' +
                    '<input id="swalBirthday" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm" type="date">' +
                '</div>' +
                
                '' +
                '<div class="flex flex-col">' +
                    '<label class="text-xs font-semibold text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>' +
                    '<input id="swalEmail" maxlength="99" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="email@example.com" type="email">' +
                '</div>' +
                
                '' +
                '<div class="flex flex-col">' +
                    '<label class="text-xs font-semibold text-gray-700 mb-1">Phone Number <span class="text-red-500">*</span></label>' +
                    '<input id="swalPhone" maxlength="11" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="09xxxxxxxxx" type="text">' +
                '</div>' +
                
                '' +
                '<div class="flex flex-col">' +
                    '<label class="text-xs font-semibold text-gray-700 mb-1">Street Address <span class="text-red-500">*</span></label>' +
                    '<input id="swalStreet" maxlength="149" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="House No. / Street">' +
                '</div>' +
                
                '' +
                '<div class="flex flex-col">' +
                    '<label class="text-xs font-semibold text-gray-700 mb-1">Barangay <span class="text-red-500">*</span></label>' +
                    '<input id="swalBarangay" maxlength="49" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="Barangay">' +
                '</div>' +
                
                '' +
                '<div class="flex flex-col">' +
                    '<label class="text-xs font-semibold text-gray-700 mb-1">City / Municipality <span class="text-red-500">*</span></label>' +
                    '<input id="swalCity" maxlength="49" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="City">' +
                '</div>' +
                
                '' +
                '<div class="flex flex-col">' +
                    '<label class="text-xs font-semibold text-gray-700 mb-1">Province <span class="text-red-500">*</span></label>' +
                    '<input id="swalProvince" maxlength="49" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="Province">' +
                '</div>' +
                
                '' +
                '<div class="flex flex-col">' +
                    '<label class="text-xs font-semibold text-gray-700 mb-1">Zip Code <span class="text-red-500">*</span></label>' +
                    '<input id="swalZipCode" maxlength="4" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="1000">' +
                '</div>' +

                '' +
                '<div class="flex flex-col">' +
                    '<label class="text-xs font-semibold text-gray-700 mb-1">Account Role <span class="text-red-500">*</span></label>' +
                    '<select id="swalRoleID" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm h-[38px]">' +
                        '<option value="1">Admin</option>' +
                        '<option value="2">Customer</option>' +
                    '</select>' +
                '</div>' +
                
                '' +
                '<div class="flex flex-col sm:col-span-2">' +
                    '<label class="text-xs font-semibold text-gray-700 mb-1">Account Status <span class="text-red-500">*</span></label>' +
                    '<select id="swalIsActive" class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm h-[38px]">' +
                        '<option value="1">Active</option>' +
                        '<option value="0">Inactive</option>' +
                    '</select>' +
                '</div>' +
            '</div>',
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: "Save Changes",
        confirmButtonColor: "#3B82F6",
        cancelButtonColor: "#6B7280",
        didOpen: () => {
            document.getElementById("swalFirstName").value = data.firstName || "";
            document.getElementById("swalLastName").value = data.lastName || "";
            document.getElementById("swalSuffix").value = data.suffix || "";
            document.getElementById("swalBirthday").value = data.birthday || "";
            document.getElementById("swalEmail").value = data.email || "";
            document.getElementById("swalPhone").value = data.phone || "";
            document.getElementById("swalStreet").value = data.street || "";
            document.getElementById("swalBarangay").value = data.barangay || "";
            document.getElementById("swalCity").value = data.city || "";
            document.getElementById("swalProvince").value = data.province || "";
            document.getElementById("swalZipCode").value = data.zipCode || "";
            document.getElementById("swalRoleID").value = roleId;
            document.getElementById("swalIsActive").value = isActive;

            document.getElementById("swalFirstName").addEventListener("input", function() {
                allowOnlyLetters(this);
            });
            document.getElementById("swalLastName").addEventListener("input", function() {
                allowOnlyLetters(this);
            });
            document.getElementById("swalSuffix").addEventListener("input", function() {
                allowSuffixInput(this);
            });
            document.getElementById("swalPhone").addEventListener("input", function() {
                allowOnlyNumber(this);
            });
            document.getElementById("swalZipCode").addEventListener("input", function() {
                allowOnlyNumber(this);
            });

            var bdayInput = document.getElementById("swalBirthday");
            
            var todayStr = new Date().toISOString().split('T')[0];
            bdayInput.setAttribute("max", todayStr);

            if (window.M && typeof M.Datepicker !== "undefined") {
                bdayInput.type = "text"; 
                bdayInput.classList.add("datepicker");
                
                M.Datepicker.init(bdayInput, {
                    autoClose: true,
                    format: 'yyyy-mm-dd',
                    maxDate: new Date(),
                    yearRange: [1900, new Date().getFullYear()],
                    container: 'body' 
                });
            }
        },
        preConfirm: () => {
            var firstName = document.getElementById("swalFirstName").value.trim();
            var lastName = document.getElementById("swalLastName").value.trim();
            var suffix = document.getElementById("swalSuffix").value.trim();
            var birthday = document.getElementById("swalBirthday").value.trim();
            var email = document.getElementById("swalEmail").value.trim();
            var phoneNumber = document.getElementById("swalPhone").value.trim();
            var street = document.getElementById("swalStreet").value.trim();
            var barangay = document.getElementById("swalBarangay").value.trim();
            var city = document.getElementById("swalCity").value.trim();
            var province = document.getElementById("swalProvince").value.trim();
            var zipCode = document.getElementById("swalZipCode").value.trim();
            var roleID = document.getElementById("swalRoleID").value;
            var isActiveValue = document.getElementById("swalIsActive").value;

            if (!firstName || !lastName || !birthday || !email || !phoneNumber || !street || !barangay || !city || !province || !zipCode) {
                Swal.showValidationMessage("Please fill out all required fields.");
                return false;
            }

            if (birthday !== "") {
                var selectedDate = new Date(birthday);
                var today = new Date();
                today.setHours(0, 0, 0, 0);

                if (selectedDate > today) {
                    Swal.showValidationMessage("Birthday cannot be a future date.");
                    return false;
                }
            }

            if (!phoneNumber.startsWith("09") || phoneNumber.length !== 11) {
                Swal.showValidationMessage("Please enter a valid 11-digit mobile number starting with 09.");
                return false;
            }

            return {
                uFName: firstName,
                uLName: lastName,
                uSuffix: suffix,
                uBirthday: birthday,
                uEmail: email,
                uPhoneNumber: phoneNumber,
                uStreet: street,
                uBarangay: barangay,
                uCity: city,
                uProvince: province,
                uZipCode: zipCode,
                uRoleID: roleID,
                uIsActive: isActiveValue
            };
        }
    }).then((result) => {
        if (!result.isConfirmed) {
            return;
        }

        var payload = result.value;
        payload.uID = data.userId;

        $.ajax({
            url: '../controllers/UserController.php',
            type: 'POST',
            data: payload,
            success: function(returnedData){
                if (returnedData.trim() == "true") {
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
                        text: "Failed to update user.",
                        icon: "error"
                    });
                }
            },
            error: function(xhr){ 
                alert(xhr.status + " : " + xhr.responseText);
            }
        });
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
    if (window.M && typeof M.Datepicker !== "undefined") {
        var datepickers = document.querySelectorAll('.datepicker');
        if (datepickers.length) {
            M.Datepicker.init(datepickers, {
                autoClose: true,
                format: 'yyyy-mm-dd',
                maxDate: new Date(),
                yearRange: [1900, new Date().getFullYear()]
            });
        }
    }

    if ($('#myTable').length) {
        $('#myTable').DataTable({
            order: [[6, 'desc']],
            ordering: true,
            orderMulti: true,
            searching: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            stateSave: true,
            scrollX: true,
            dom: 'lfrtip',
            columnDefs: [
                { targets: [8], orderable: false, searchable: false }
            ]
        });
    }
});