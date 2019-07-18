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
  <div id="navDemo" class="w3-bar w3-cyan w3-card w3-left-align w3-large w3-medium w3-small">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-hide-small w3-right w3-padding-large w3-hover-white w3-large w3-cyan" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-blue">Team Blue</a>
    <a href="boardRed.php" class="w3-bar-item w3-button w3-padding-large w3-red">Team Red</a>
    <a href="boardYellow.php" class="w3-bar-item w3-button w3-padding-large w3-yellow">Team Yellow</a>
    <a href="loginPage.html" class="w3-bar-item w3-button  w3-padding-large w3-cyan">Log In</a>
    <a href="processLogout.php" class="w3-bar-item w3-button  w3-padding-large w3-cyan">Log Out</a>
    <a href="registerPage.html" class="w3-bar-item w3-button  w3-padding-large w3-cyan">Create Account</a>
    <a href="processDeregister.php" class="w3-bar-item w3-button  w3-padding-large w3-cyan">Remove Account</a>
  </div>
</div>

<header class="w3-container w3-cyan w3-center" style="padding:400px 16px">

<?php
require_once('userManager.php');
require_once('dbManager.php');
require_once('dbConfig.php');

session_start();
try  {
    $userManager = new UserManager($dbManager);
    $logged_in = $userManager->checkIfUserLoggedIn(session_id());
    if(!$logged_in)
        $error_message = "You are not logged in so you cannot remove user account.";
    else{
        $user_name = $userManager->findUserName(session_id());
        $userManager->deleteAccount($user_name);
    }
}
catch(Exception $e){
    $error_message = "Error occured.<br>Error info:<br> ".$e->getMessage();
}

if(isset($error_message)){
    echo $error_message;
}
else{
    echo "User account removed.";
} ?>

</header>

</body>
</html>