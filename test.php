<?php

    if(session_id() != '' || isset($_SESSION) || session_status() === PHP_SESSION_ACTIVE) 
    {
        
    session_destroy();
    }

    if(isset($_SERVER['HTTPS'])) $https = $_SERVER['HTTPS'];
    else $https="";
    $serverport = $_SERVER['SERVER_PORT']; 
    $servname = $_SERVER['SERVER_NAME'];  
        // If the script is running on a virtual host, this will be the value defined for that virtual host.
    $servaddr = $_SERVER['SERVER_ADDR']; 
    if($https == "") $https = "http://" ;  // alloiws https://
    $baseurl = $https . $servname . ":" . $serverport ; // build the base url, example http://localhost:80
    $self    = $_SERVER['PHP_SELF'] ;        // in a php script at the address http://example.com/foo/bar.php would be /foo/bar.php
    $webpath = dirname($_SERVER['PHP_SELF']); // in a php script at the address http://example.com/foo/bar.php would be /foo
    $fullwebpath = $baseurl . $webpath ;      // for this page would be http://localhost:80/webergasia1


    $haserror = false;
    $errormessage = "";
    // if called with other verb than post we dont accept the request
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) 
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $Day = $_POST['Day'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        $Gender = $_POST['Gender'];
        $usr = $_POST['usr'];
        $email = $_POST['email'];
        $psw = $_POST['psw'];
        $remember = "";
        if(isset($_POST['remember'])) $remember = $_POST['remember'];
        $DOB = "$year$month$Day";

        // login to DataBase credentials
        $mysqlserver = "localhost";
        $mysqldb = "teliki_ergasia";
        $mysqluser = "webapp";
        $mysqlpwd = "123456";


        // Create connection
        $conn = new mysqli($mysqlserver, $mysqluser, $mysqlpwd, $mysqldb);

        // Check connection
        if ($conn->connect_error) 
        {
            $haserror = true;
            $errormessage = "Connect Error";
        }
        else
        {

            $sql="select count(*) as CNTUSRS from `users` where ( `email`='$email' or `username`='$usr') ;";

            $validregistration = true;

            $result = $conn->query($sql);
            if ($result->num_rows > 0) 
            {
                // output data of each row
                while($row = $result->fetch_assoc()) 
                {
                    // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                    if( $row["CNTUSRS"] > 0 ) $validregistration=false;
                }
            } 
            if($validregistration==false)
            {
                $haserror=true;
                $errormessage="username or email exists";
            }
            else 
            {
                $sql = "INSERT INTO `users`(`FirstName`, `LastName`, `DateOfBirth`, `Gender`, `username`, `password`, `email`, `DateSigned`, `DateUpdated`, `IsActive` ) VALUES (". 
                " '$fname', '$lname', '$DOB', '$Gender', '$usr', '$psw', '$email' , now() , now() , 1 ) ;";

                if ($conn->query($sql) === TRUE) 
                {
                    // TODO:: if remember me == yes , loginn in backgorund here, redirect to to quiz
                    if($remember=="on") 
                    {
                        session_start();    // global $_SESSION created here  
                        $_SESSION["username"] = $usr;     
                        $_SESSION["firstname"]= $fname;     
                        $_SESSION["lastname"] = $lname;    
                        $_SESSION["email"]    = $email;    
                        $url = "$baseurl/quiz.php";
                    }
                    else 
                    {
                        // else if not remember me then redirect to login
                        $url = "$baseurl/login.html";
                    }
                    // redirect back to sign-up.html
                    header("Location: $url");
                    // exit without any other for not to break the redirection
                    die();
                }
            }
            $conn->close();
        }
    }
?>