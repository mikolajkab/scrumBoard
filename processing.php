<?php
require_once('userManager.php');
require_once('dbManager.php');
require_once('dbConfig.php');
session_start();
echo $_POST["hiddenVal"];
$userManager = new UserManager($dbManager);
$logged_in = $userManager->checkIfUserLoggedIn(session_id());
$text = $_POST["hiddenVal"];
$userManager->writeTextField(1, $text);
?>