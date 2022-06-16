<?php
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


    // login to DataBase credentials
    $mysqlserver = "localhost";
    $mysqldb = "teliki_ergasia";
    $mysqluser = "webapp";
    $mysqlpwd = "123456";

    // if called with other verb than post we dont accept the request
    if( $_SERVER['REQUEST_METHOD'] != 'POST') {
        // build the sign-up.html url
        $url = "$baseurl/sign-up.html";
        // redirect back to sign-up.html
        header("Location: $url");
        // exit without any other for not to break the redirection
        die();
    }


    // form url encoded data post =  usr=....&psw=....
    $fusr = $_POST["usr"];
    $fpsw = $_POST["psw"];

    
    // Create connection
    $conn = new mysqli($mysqlserver, $mysqluser, $mysqlpwd, $mysqldb);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    



    $sql ="select count(*) as ISVALID from `users` where ( `password`='$psw' or `username`='$usr') ;";

    $validregistration = true;

    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        if( $row["ISVALID"] > 0 ) $validregistration=false;
    }
    }else{
    // this shouldnt happen
    echo "ERROR:: 2 or more users with the same credentials found" ;
    }


    if($validregistration==false)
    {
        echo "        
            <script type=\"text/javascript\"> 
                alert(\"Λανθασμένο όνομα χρήστη ή κωδικός\");
            </script>";

        $url = "$baseurl/sign-up.html?error=username_or_email_exists";
        // redirect back to sign-up.html
        header("Location: $url");
        // exit without any other for not to break the redirection
        die();
    }

?>