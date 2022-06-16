<?php

if(session_id() != '' || isset($_SESSION) || session_status() === PHP_SESSION_ACTIVE) {
    // start sess
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


    // login to DataBase credentials
    $mysqlserver = "localhost";
    $mysqldb = "teliki_ergasia";
    $mysqluser = "webapp";
    $mysqlpwd = "123456";


    $haserror = false;
    $errormessage="";

    // if called with other verb than post we dont accept the request
    if( $_SERVER['REQUEST_METHOD'] != 'POST') {
        // build the sign-up.html url
        $url = "$baseurl/login.html";
        // redirect back to sign-up.html
        header("Location: $url?loginerror=Bad_Method_Used");
        // exit without any other for not to break the redirection
        die();
    }

    // form url encoded data post =  usr=....&psw=....
    if(!isset($_POST["usr"])){
        $url = "$baseurl/login.html";
        header("Location: $url?loginerror=No_Username");
        die();
    }
    $usr = $_POST["usr"];
    if(!isset($_POST["psw"])){
        $url = "$baseurl/login.html";
        header("Location: $url?loginerror=No_Password");
        die();
    }
    $psw = $_POST["psw"];
    
    // Create connection
    $conn = new mysqli($mysqlserver, $mysqluser, $mysqlpwd, $mysqldb);

    // Check connection
    if ($conn->connect_error) {
        $url = "$baseurl/login.html";
        header("Location: $url?loginerror=Server_Error");
        die();
    }

    $sql ="select count(*) as ISVALID from `users` where ( `password`='$psw' or `username`='$usr') ;";

    $validregistration = false;

    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            if( $row["ISVALID"] > 0 ) $validregistration=true;
            break;
        }
    } else {
        // this shouldnt happen
        $url = "$baseurl/login.html";
        header("Location: $url?loginerror=Dublicate_User");
        die();
    }


    if($validregistration==false)
    {
        $url = "$baseurl/login.html?loginerror=Bad_Username_or_Email";
        // redirect back to sign-up.html
        // header("GS-Error: Login Error, Bad Username or Email");
        header("Location: $url");
        // exit without any other for not to break the redirection
        die();
    }

    // login is success goto basics.html
    $url = "$baseurl/basics.html?login=success";
    // redirect back to sign-up.html
    header("Location: $url");
    // exit without any other for not to break the redirection
    die();


?>