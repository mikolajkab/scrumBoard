<!DOCTYPE html>
<html lang="en">
<title>TEST page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
form {margin: 0 auto;}
.w3-bar .w3-button {height:135px;}
</style>
<body>

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

<header class="w3-container w3-blue w3-center" style="padding:128px 16px">

<?php  

require_once('userManager.php');
require_once('dbManager.php');
require_once('dbConfig.php');

session_start();

try  {
    $userManager = new UserManager($dbManager);
    $logged_in = $userManager->checkIfUserLoggedIn(session_id());
    if(!$logged_in)
        $error_message = "You are not logged in so you cannot log out.";
    else{
        $userManager->logout();
    }
}
catch(Exception $e){
    $error_message = "Error occured.<br>Error info:<br> ".$e>getMessage();
}

if(isset($error_message)){
      echo $error_message;
    }
else{
    echo "You are now logged out.";
} ?>

</header>

<script>
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

</body>
</html>