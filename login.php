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

// form url encoded data post =  usr=....&psw=....&
$_POST["usr"]
$_POST["psw"]
    

?>