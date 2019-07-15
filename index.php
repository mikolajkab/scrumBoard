<!DOCTYPE html>
<html lang="en">
<title>Zaawansowane aplikacje internetowe</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
.w3-bar .w3-button {height:135px;}
body, html {background-color: whitesmoke}
</style>

<head>
<script type="text/javascript">

// save changes
function saveEdits() {
var editElem = document.getElementById("edit");
var userVersion = editElem.innerHTML;
localStorage.userEdits = userVersion;
document.getElementById("update").innerHTML="Edits saved!";
}

//find out if the user has previously saved edits
function checkEdits() {
if(localStorage.userEdits!=null)
document.getElementById("edit").innerHTML = localStorage.userEdits;
}

// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

<?php
require_once('userManager.php');
require_once('dbManager.php');
require_once('dbConfig.php');
session_start();
try  {
    $userManager = new UserManager($dbManager);
    $logged_in = $userManager->checkIfUserLoggedIn(session_id());
}
catch(Exception $e){
    $error_message = "Error occured.<br>Error info:<br> ".$e->getMessage();
}?>

</head>

<body onload="checkEdits()">

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-blue w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-blue" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="loginPage.html" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Log In</a>
    <a href="processLogout.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Log Out</a>
    <a href="registerPage.html" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Create Account</a>
    <a href="processDeregister.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Remove Account</a>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large">Home</a>
    <a href="loginPage.html" class="w3-bar-item w3-button w3-padding-large">Log In</a>
    <a href="processLogout.php" class="w3-bar-item w3-button w3-padding-large">Log Out</a>
    <a href="registerPage.html" class="w3-bar-item w3-button w3-padding-large">Create Account</a>
    <a href="processDeregister.php" class="w3-bar-item w3-button w3-padding-large">Remove Account</a>
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-blue w3-center" style="padding:128px 16px">
  <p class="w3-xlarge">This website is a project for the course "Zaawansowane aplikacje internetowe"<br> at Warsaw University of Technology.</p>
  <br>
    <?php if($logged_in){ ?>
        <p class="w3-large w3-pale-blue">You are logged in. You can edit this website. Save canges by clicking the button on the bottom of the page.</p>
    <?php }else{ ?>
        <p class="w3-large w3-pale-blue">You are not logged in. You cannot edit this website.</p>
    <?php } ?>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <?php if($logged_in){ ?>
    <div class="w3-twothird" id="edit" contenteditable="true">
    <?php }else{ ?>
    <div class="w3-twothird" id="edit" contenteditable="false">
    <?php } ?>
      <h1>Lorem Ipsum</h1>
      <h5 class="w3-padding-32">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h5>

      <p class="w3-text-grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
        laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>

    <div class="w3-third w3-center">
      <i class="fa fa-anchor w3-padding-64 w3-text-blue"></i>
    </div>
  </div>
</div>

<!-- Second Grid -->
<div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
      <i class="fa fa-coffee w3-padding-64 w3-text-blue w3-margin-right"></i>
    </div>

    <?php if($logged_in){ ?>
    <div class="w3-twothird" id="edit" contenteditable="true">
    <?php }else{ ?>
    <div class="w3-twothird" id="edit" contenteditable="false">
    <?php } ?>
    <h1>Lorem Ipsum</h1>
      <h5 class="w3-padding-32">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h5>

      <p class="w3-text-grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
        laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
  </div>
</div>

<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <?php if($logged_in){ ?>
    <div id="update"> <h1 class="w3-margin w3-large">Edit the text and click to save for next time</h1></div>
    <input type="button" value="save my edits" onclick="saveEdits()"/>
    <?php } else{ ?>
        <h1 class="w3-margin w3-large">Have a nice day!</h1>
    <?php } ?>
</div>

</body>
</html>