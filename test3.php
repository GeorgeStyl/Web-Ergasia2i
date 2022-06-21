<?php
if(isset($_SESSION["username"]) && $_SESSION["username"] != "") {


    // Create connection
    $conn = new mysqli($mysqlserver, $mysqluser, $mysqlpwd, $mysqldb);
    // Check connection
    if ($conn->connect_error) {
        $hasError = true;
        $errormessage="Connection Error";
    }
    else {
        if( $_SERVER['REQUEST_METHOD'] == 'POST') {
            // user posted an update of user settings ...
            // update mysql , n otify user succes or failed, load new updated settings

        }
        else if( $_SERVER['REQUEST_METHOD'] == 'GET')  {
            // user just access this page, load user settings into form


            $result = $conn->query($sql);
            if ($result->num_rows == 1) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    if( $row["ISVALID"] > 0 ) $validregistration=true;
                    $FirstName =  $row["FirstName"];
                    $LastName =  $row["LastName"];
                    $Gender =  $row["Gender"];
                    $DateOfBirth =  $row["DateOfBirth"];
                    $username =  $row["username"];
                    $email =  $row["email"];
                    $hasError = false;
                    $errormessage="OK"; 
                    break;
                    
                }
            }
            else {
                $hasError = true;
                $errormessage="User not found";              
            }

        }
        else {
            $hasError = true;
            $errormessage="Bad http method"; 
        }
    }

}
else {
    $hasError = true;
    $errormessage="Session Error";
}
    ?>