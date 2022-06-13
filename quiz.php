<?php
session_start();

if(isset($_SERVER['HTTPS'])) $https = $_SERVER['HTTPS'];
$serverport = $_SERVER['SERVER_PORT']; 
$servname = $_SERVER['SERVER_NAME'];  
    // If the script is running on a virtual host, this will be the value defined for that virtual host.
$servaddr = $_SERVER['SERVER_ADDR']; 
if($https == "") $https = "http://" ;  // alloiws https://
$baseurl = $https . $servname . ":" . $serverport ; // build the base url, example http://localhost:80
$self    = $_SERVER['PHP_SELF'] ;        // in a php script at the address http://example.com/foo/bar.php would be /foo/bar.php
$webpath = dirname($_SERVER['PHP_SELF']); // in a php script at the address http://example.com/foo/bar.php would be /foo

if(isset($_SESSION["username"]) && $_SESSION["username"] != "") {
    // all aokey, user has session
}
else {

    $url = "$baseurl/index.html";
    // redirect back to sign-up.html
    header("Location: $url");
    die();
}

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="./styles/quiz_style.css" rel="stylesheet">
  <link href="./styles/navbar_style.css" rel="stylesheet">
  <title>Quiz Game</title>
  <style>
        body {
            margin: 0;  
            font-family: Arial, Helvetica, sans-serif;
        }
  </style>
</head>   

<body>

  <a href="/basics.html" > goto basics </a>
    <div class="logo">
      <img src="./media/Logo/logotop.svg" id="logo" alt="bitcoin-logo">
    </div>
    <nav class="navbar">
      <div class="navbar-links">
        <ul class="nav-menu">
          <li class="nav-item">
            <a href="index.html">
              <span class="icon"></span>
              <img src="./media/Icons/icon-home.png" />
              <span class="icon-text">Home</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="basics.html">
              <span class="icon"></span>
              <img src="./media/Icons/icon-basics.png" />
              <span class="icon-text">Basics</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="more.html">
              <span class="icon"></span>
              <img src="./media/Icons/icon-more.png" />
              <span class="icon-text">More</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="quiz.html">
              <span class="icon"></span>
              <img src="./media/Icons/icon-quiz.png" />
              <span class="icon-text">Quiz</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="sign-up.html">
              <span class="icon"></span>
              <img src="./media/Icons/icon-signup.png" />
              <span class="icon-text">Sign Up</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="login.html">
              <span class="icon"></span>
              <img src="./media/Icons/icon-login.png" />
              <span class="icon-text">Login</span>
            </a>
          </li>
        </ul>
        <a href="#" class="toggle-button">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </a>
      </div>
    </nav>
      
    <div class="container">
      <div id="question-container" class="hide">
        <div id="question">Question</div>
        <div id="answer-buttons" class="btn-grid">
          <button class="btn">Answer 1</button>
          <button class="btn">Answer 2</button>
          <button class="btn">Answer 3</button>
          <button class="btn">Answer 4</button>
        </div>
      </div>
      <div class="controls">
        <button id="start-btn" class="start-btn btn">Start</button>
        <button id="next-btn" class="next-btn btn hide">Next</button>
      </div>
    </div>
    <script src="./scripts/navbar.js"></script>
    <script src="./scripts/quiz.js"></script>
</body>
</html>