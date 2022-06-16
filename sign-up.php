
<?php

  // if(session_id() != '' || isset($_SESSION) || session_status() === PHP_SESSION_ACTIVE) {
  //  // session isn't started
  //  session_destroy();
  // }
  session_destroy();

  if(isset($_SERVER['HTTPS'])) $https = $_SERVER['HTTPS'];
  $serverport = $_SERVER['SERVER_PORT']; 
  $servname = $_SERVER['SERVER_NAME'];  
    // If the script is running on a virtual host, this will be the value defined for that virtual host.
  $servaddr = $_SERVER['SERVER_ADDR']; 
  if($https == "") $https = "http://" ;  // alloiws https://
  $baseurl = $https . $servname . ":" . $serverport ; // build the base url, example http://localhost:80
  $self    = $_SERVER['PHP_SELF'] ;        // in a php script at the address http://example.com/foo/bar.php would be /foo/bar.php
  $webpath = dirname($_SERVER['PHP_SELF']); // in a php script at the address http://example.com/foo/bar.php would be /foo
  $fullwebpath = $baseurl . $webpath ;      // for this page would be http://localhost:80/webergasia1



    // if called with other verb than post we dont accept the request
    if( $_SERVER['REQUEST_METHOD'] != 'POST') {
        // build the sign-up.html url
        $url = "$baseurl/sign-up.html";
        // redirect back to sign-up.html
        header("Location: $url");
        // exit without any other for not to break the redirection
        die();
    }

    // it is posted ...




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
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql="select count(*) as CNTUSRS from `users` where ( `email`='$email' or `username`='$usr') ;";

    $validregistration = true;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        if( $row["CNTUSRS"] > 0 ) $validregistration=false;
      }
    } else {
    //  
    }

    if($validregistration==false)
    {
        $url = "$baseurl/sign-up.html?error=username_or_email_exists";
        // redirect back to sign-up.html
        header("Location: $url");
        // exit without any other for not to break the redirection
        die();
    }




  //    $sql = "INSERT INTO `users`(`FirstName`, `LastName`, `DateOfBirth`, `Gender`, `username`, `password`, `email`, `DateSigned`, `DateUpdated`, `IsActive` ,`sessionID`, `sessionDT`) VALUES (". 
  //    " '$fname', '$lname', '$DOB', '$Gender', '$usr', '$psw', '$email' , now() , now() , 1, '" . SID . "', now() ) ;";
  // sessionID 
  // sessionDT

  $sql = "INSERT INTO `users`(`FirstName`, `LastName`, `DateOfBirth`, `Gender`, `username`, `password`, `email`, `DateSigned`, `DateUpdated`, `IsActive` ) VALUES (". 
  " '$fname', '$lname', '$DOB', '$Gender', '$usr', '$psw', '$email' , now() , now() , 1 ) ;";

  if ($conn->query($sql) === TRUE) {

        // TODO:: if remember me == yes , loginn in backgorund here, redirect to to quiz
        if($remember=="on") {
          session_start();    // global $_SESSION created here  
          $_SESSION["username"] = $usr;     
          $_SESSION["firstname"]= $fname;     
          $_SESSION["lastname"] = $lname;    
          $_SESSION["email"]    = $email;    
          $url = "$baseurl/quiz.php";
        }
        else {
          // else if not remember me then redirect to login
          $url = "$baseurl/login.html";
        }
        // redirect back to sign-up.html
        header("Location: $url");
        // exit without any other for not to break the redirection
        die();

    } else {
        $url = "$baseurl/sign-up.html?error=registration_failed";
        // redirect back to sign-up.html
        header("Location: $url");
        // exit without any other for not to break the redirection
        die();
    }

  $conn->close();

  //    echo $sql;



?>