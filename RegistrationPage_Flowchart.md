Registration Page \(What the User Sees\) .shape_roundrectangle.color_blue
  Step 1\: PHP Setup .shape_rectangle.color_orange
    Starts the web session
    Loads the Brain \(UserManagement\) #ref_load_brain
    Gets the list of users #ref_get_users
      Saves the list to use in the table
  Step 2\: HTML Page \(Visuals\) .shape_rectangle.color_green
    Loads styling and scripts \(Materialize, jQuery\)
    Navigation Bar
      Login Button
        user clicks\: redirectFunc\(1\) #ref_cli_remd
    Registration Form
      Typing box\: First Name
      Typing box\: Last Name
      Add User Button
        user clicks\: addFunc\(\) #ref_cli_add
    User Data Table
      Fills table rows with saved users
      Row actions for each user
        Update Button
          user clicks\: updateFunc\(index\) #ref_cli_upd
        Delete Button
          user clicks\: deleteFunc\(index\) #ref_cli_del

Client Scripts \(Service\.js\) .shape_roundrectangle.color_yellow
  Setup when page loads
    Turns standard table into an interactive DataTable
  Function\: addFunc\(\) #addFunc .color_purple
    Grabs First Name and Last Name from typing boxes
    Sends AJAX POST Add Request #ref_ajax_add
      Shows Success Message and Reloads Page
      Or shows Error Alert
  Function\: updateFunc\(userID\) #updateFunc .color_purple
    Grabs updated names
    Sends AJAX POST Update Request #ref_ajax_upd
      Shows Success Message and Reloads Page
  Function\: deleteFunc\(userID\) #deleteFunc .color_purple
    Sends AJAX POST Delete Request #ref_ajax_del
      Shows Success Message and Reloads Page
  Function\: loginFunc\(\) #loginFunc .color_purple
    Grabs login names
    Sends AJAX POST Login Request #ref_ajax_log
      If correct\: Goes to Dashboard
      If wrong\: Shows Error
  Function\: redirectFunc\(target\) #redirectFunc .color_purple
    Checks target number
      Moves user to correct page

Traffic Cop \(UserController\.php\) .shape_roundrectangle.color_red
  Step 1\: Setup .shape_rectangle.color_orange
    Starts session
    Loads the Brain \(UserManagement\)
  Step 2\: Direct Traffic \(POST Router\) .shape_rectangle.color_green
    Checks what data was sent
      If it's an Add Request #route_add
        Tells the Brain to Add User #ref_t_add
      If it's an Update Request #route_update
        Tells the Brain to Update User #ref_t_upd
      If it's a Delete Request #route_delete
        Tells the Brain to Delete User #ref_t_del
      If it's a Login Request #route_login
        Tells the Brain to Verify Login #ref_t_log

The Brain \(UserManagement\.php\) .shape_roundrectangle.color_purple
  Step 1\: Load Dependencies .shape_rectangle.color_orange
    Loads Database connection file
    Loads SQL Queries \(registrationModel\)
  Class\: Operations .shape_rectangle.color_blue
    Wake up Connection \(__construct\) #bl_construct .color_green
      Connect to the Database #ref_conn_db
      Prepare SQL queries #ref_prep_db
    Add User to Database \(addUserFunc\) #bl_add .color_green
      Use SQL to Save User \(createRegistration\) #ref_save_user
        On success\: Tell user "Added successfully"
    Update User \(updateUserFunc\) #bl_update .color_green
      Finds user in the temporary session memory
      Changes their name
    Delete User \(deleteUserFunc\) #bl_delete .color_green
      Removes user from temporary session memory
    Get All Users \(getUser\) #bl_get .color_green
      Gives the current list of users back to the page
    Verify Login \(loginUserFunc\) #bl_login .color_green
      Checks if user's name is in the list
      Replies "true" or "false"

Database Connection \(database\.php\) .shape_roundrectangle.color_red
  Class Setup .shape_rectangle.color_blue
    Set login details \(Host\: 3307, User\: root\)
    Connect to Database #db_connect .color_green
      Opens secure connection \(PDO\)
      Catches errors if it fails

Database Queries \(registrationModel\.php\) .shape_roundrectangle.color_red
  SQL Operations .shape_rectangle.color_blue
    Setup Database Connection #model_construct .color_green
      Saves the active connection 
    Create Record \(createRegistration\) #model_create .color_green
      Prepares the INSERT INTO table command
      Safely inserts First Name, Last Name, and Time
      Runs the command and saves the data

// \=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\= CONNECTIONS \=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=\=

// \-\-\- 1\. ADD USER FLOW \-\-\-
(#ref_cli_add)
  triggers Javascript: (#addFunc)

(#ref_ajax_add)
  goes to Traffic Cop: (#route_add)

(#ref_t_add)  
  calls Brain Function: (#bl_add)

(#ref_save_user)
  runs Database query: (#model_create)


// \-\-\- 2\. UPDATE USER FLOW \-\-\-
(#ref_cli_upd)
  triggers Javascript: (#updateFunc)

(#ref_ajax_upd)
  goes to Traffic Cop: (#route_update)

(#ref_t_upd)
  calls Brain Function: (#bl_update)


// \-\-\- 3\. DELETE USER FLOW \-\-\-
(#ref_cli_del)
  triggers Javascript: (#deleteFunc)

(#ref_ajax_del)
  goes to Traffic Cop: (#route_delete)

(#ref_t_del)
  calls Brain Function: (#bl_delete)


// \-\-\- 4\. LOGIN / REDIRECT FLOW \-\-\-
(#ref_cli_remd)
  triggers Javascript: (#redirectFunc)

(#ref_ajax_log)
  goes to Traffic Cop: (#route_login)

(#ref_t_log)
  calls Brain Function: (#bl_login)


// \-\-\- 5\. PAGE SETUP / INITIALIZATION FLOW \-\-\-
(#ref_load_brain)
  wakes up connection: (#bl_construct)

(#ref_conn_db)
  runs database file: (#db_connect)
  
(#ref_prep_db)
  runs query setup: (#model_construct)

(#ref_get_users)
  calls Brain Function: (#bl_get)