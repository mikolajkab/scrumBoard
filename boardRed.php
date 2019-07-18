<!DOCTYPE html>
<html lang="en">
<title>Cool scrum board</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-book,.fa-bolt,.fa-car,.fa-diamond,.fa-bicycle,.fa-adjust {font-size:120px}
.w3-bar .w3-button {height:135px;}
body, html {background-color: whitesmoke}
</style>

<head>

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
}

$text1 = $userManager->readTextField(21);
$text2 = $userManager->readTextField(22);
$text3 = $userManager->readTextField(23);
$text4 = $userManager->readTextField(24);
$text5 = $userManager->readTextField(25);
$text6 = $userManager->readTextField(26);
$text7 = $userManager->readTextField(27);
$text8 = $userManager->readTextField(28);
$text9 = $userManager->readTextField(29);
$text10 = $userManager->readTextField(30);
$text11 = $userManager->readTextField(11);
$text12 = $userManager->readTextField(12);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $userManager->writeTextField(21, $_POST['textVal1']);
  $userManager->writeTextField(22, $_POST['textVal2']);
  $userManager->writeTextField(23, $_POST['textVal3']);
  $userManager->writeTextField(24, $_POST['textVal4']);
  $userManager->writeTextField(25, $_POST['textVal5']);
  $userManager->writeTextField(26, $_POST['textVal6']);
  $userManager->writeTextField(27, $_POST['textVal7']);
  $userManager->writeTextField(28, $_POST['textVal8']);
  $userManager->writeTextField(29, $_POST['textVal9']);
  $userManager->writeTextField(20, $_POST['textVal10']);
  $userManager->writeTextField(31, $_POST['textVal11']);
  $userManager->writeTextField(32, $_POST['textVal12']);
  header("Refresh:0");
}
?>

<script type="text/javascript">

function saveEdits() {
  document.getElementById("textVal1").value = document.getElementById("tf1").innerHTML;
  document.getElementById("textVal2").value = document.getElementById("tf2").innerHTML;
  document.getElementById("textVal3").value = document.getElementById("tf3").innerHTML;
  document.getElementById("textVal4").value = document.getElementById("tf4").innerHTML;
  document.getElementById("textVal5").value = document.getElementById("tf5").innerHTML;
  document.getElementById("textVal6").value = document.getElementById("tf6").innerHTML;
  document.getElementById("textVal7").value = document.getElementById("tf7").innerHTML;
  document.getElementById("textVal8").value = document.getElementById("tf8").innerHTML;
  document.getElementById("textVal9").value = document.getElementById("tf9").innerHTML;
  document.getElementById("textVal10").value = document.getElementById("tf10").innerHTML;
  document.getElementById("textVal11").value = document.getElementById("tf11").innerHTML;
  document.getElementById("textVal12").value = document.getElementById("tf12").innerHTML;
}


function checkEdits() {
  document.getElementById("tf1").innerHTML = "<?php echo $text1; ?>";
  document.getElementById("tf2").innerHTML = "<?php echo $text2; ?>";
  document.getElementById("tf3").innerHTML = "<?php echo $text3; ?>";
  document.getElementById("tf4").innerHTML = "<?php echo $text4; ?>";
  document.getElementById("tf5").innerHTML = "<?php echo $text5; ?>";
  document.getElementById("tf6").innerHTML = "<?php echo $text6; ?>";
  document.getElementById("tf7").innerHTML = "<?php echo $text7; ?>";
  document.getElementById("tf8").innerHTML = "<?php echo $text8; ?>";
  document.getElementById("tf9").innerHTML = "<?php echo $text9; ?>";
  document.getElementById("tf10").innerHTML = "<?php echo $text10; ?>";
  document.getElementById("tf11").innerHTML = "<?php echo $text11; ?>";
  document.getElementById("tf12").innerHTML = "<?php echo $text12; ?>";
  saveEdits();
}
</script>

</head>

<body onload="checkEdits()">

<!-- Navbar -->
<div class="w3-top">
  <div id="navDemo" class="w3-bar w3-red w3-card w3-left-align w3-large w3-medium w3-small">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-hide-small w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-blue">Team Blue</a>
    <a href="boardRed.php" class="w3-bar-item w3-button w3-padding-large w3-red">Team Red</a>
    <a href="boardYellow.php" class="w3-bar-item w3-button w3-padding-large w3-yellow">Team Yellow</a>
    <a href="loginPage.html" class="w3-bar-item w3-button  w3-padding-large w3-cyan">Log In</a>
    <a href="processLogout.php" class="w3-bar-item w3-button  w3-padding-large w3-cyan">Log Out</a>
    <a href="registerPage.html" class="w3-bar-item w3-button  w3-padding-large w3-cyan">Create Account</a>
    <a href="processDeregister.php" class="w3-bar-item w3-button  w3-padding-large w3-cyan">Remove Account</a>
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-red w3-center" style="padding:128px 16px">
<h1 class="w3-xxlarge">COOL SCRUM BOARD</h1>
<h2 class="w3-xxlarge">TEAM RED</h2>
  <br>
    <?php if($logged_in){ ?>
        <p class="w3-large w3-pale-red">You are logged in. You can edit this scrum board. Save canges by clicking the submit button on the bottom.</p>
    <?php }else{ ?>
        <p class="w3-large w3-pale-red">You are not logged in. You cannot edit this scrum board.</p>
    <?php } ?>
</header>

<!-- Task1 -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h2>Task 1</h2>
      <h5 class="w3-padding-8">Title</h5>
      <?php if($logged_in){ ?>
      <h5 class="w3-text-grey" id="tf1" contenteditable="true" onkeyup=saveEdits()>
      <?php }else{ ?>
      <h5 class="w3-text-grey" id="tf1" contenteditable="false">
      <?php } ?>
      This is place for you task name</h5>

      <h5 class="w3-padding-8">Summary</h5>
      <?php if($logged_in){ ?>
      <p class="w3-text-grey" id="tf2" contenteditable="true" onkeyup=saveEdits()>
      <?php }else{ ?>
      <p class="w3-text-grey" id="tf2" contenteditable="false">
      <?php } ?>
        This is place for your task summary. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
        laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>

    <div class="w3-third w3-center">
      <i class="fa fa-bolt w3-padding-64 w3-text-red"></i>
    </div>
  </div>
</div>

<!-- Task2 -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
      <i class="fa fa-bicycle w3-padding-64 w3-text-red w3-margin-right"></i>
    </div>

    <div class="w3-twothird">
      <h2>Task 2</h2>
      <h5 class="w3-padding-8">Title</h5>
      <?php if($logged_in){ ?>
      <h5 class="w3-text-grey" id="tf3" contenteditable="true" onkeyup=saveEdits()>
      <?php }else{ ?>
      <h5 class="w3-text-grey" id="tf3" contenteditable="false">
      <?php } ?>
      This is place for you task name</h5>

      <h5 class="w3-padding-8">Summary</h5>
      <?php if($logged_in){ ?>
      <p class="w3-text-grey" id="tf4" contenteditable="true" onkeyup=saveEdits()>
      <?php }else{ ?>
      <p class="w3-text-grey" id="tf4" contenteditable="false">
      <?php } ?>
        This is place for your task summary. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
        laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
  </div>
</div>

<!-- Task3 -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h2>Task 3</h2>
      <h5 class="w3-padding-8">Title</h5>
      <?php if($logged_in){ ?>
      <h5 class="w3-text-grey" id="tf5" contenteditable="true" onkeyup=saveEdits()>
      <?php }else{ ?>
      <h5 class="w3-text-grey" id="tf5" contenteditable="false">
      <?php } ?>
      This is place for you task name</h5>

      <h5 class="w3-padding-8">Summary</h5>
      <?php if($logged_in){ ?>
      <p class="w3-text-grey" id="tf6" contenteditable="true" onkeyup=saveEdits()>
      <?php }else{ ?>
      <p class="w3-text-grey" id="tf6" contenteditable="false">
      <?php } ?>
        This is place for your task summary. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
        laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>

    <div class="w3-third w3-center">
      <i class="fa fa-book w3-padding-64 w3-text-red"></i>
    </div>
  </div>
</div>

<!-- Task4 -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
      <i class="fa fa-adjust w3-padding-64 w3-text-red w3-margin-right"></i>
    </div>

    <div class="w3-twothird">
      <h2>Task 4</h2>
      <h5 class="w3-padding-8">Title</h5>
      <?php if($logged_in){ ?>
      <h5 class="w3-text-grey" id="tf7" contenteditable="true" onkeyup=saveEdits()>
      <?php }else{ ?>
      <h5 class="w3-text-grey" id="tf7" contenteditable="false">
      <?php } ?>
      This is place for you task name</h5>

      <h5 class="w3-padding-8">Summary</h5>
      <?php if($logged_in){ ?>
      <p class="w3-text-grey" id="tf8" contenteditable="true" onkeyup=saveEdits()>
      <?php }else{ ?>
      <p class="w3-text-grey" id="tf8" contenteditable="false">
      <?php } ?>
        This is place for your task summary. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
        laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
  </div>
</div>

<!-- Task5 -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h2>Task 5</h2>
      <h5 class="w3-padding-8">Title</h5>
      <?php if($logged_in){ ?>
      <h5 class="w3-text-grey" id="tf9" contenteditable="true" onkeyup=saveEdits()>
      <?php }else{ ?>
      <h5 class="w3-text-grey" id="tf9" contenteditable="false">
      <?php } ?>
      This is place for you task name</h5>

      <h5 class="w3-padding-8">Summary</h5>
      <?php if($logged_in){ ?>
      <p class="w3-text-grey" id="tf10" contenteditable="true" onkeyup=saveEdits()>
      <?php }else{ ?>
      <p class="w3-text-grey" id="tf10" contenteditable="false">
      <?php } ?>
        This is place for your task summary. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
        laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>

    <div class="w3-third w3-center">
      <i class="fa fa-car w3-padding-64 w3-text-red"></i>
    </div>
  </div>
</div>

<!-- Task6 -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
      <i class="fa fa-diamond w3-padding-64 w3-text-red w3-margin-right"></i>
    </div>

    <div class="w3-twothird">
      <h2>Task 6</h2>
      <h5 class="w3-padding-8">Title</h5>
      <?php if($logged_in){ ?>
      <h5 class="w3-text-grey" id="tf11" contenteditable="true" onkeyup=saveEdits()>
      <?php }else{ ?>
      <h5 class="w3-text-grey" id="tf11" contenteditable="false">
      <?php } ?>
      This is place for you task name</h5>

      <h5 class="w3-padding-8">Summary</h5>
      <?php if($logged_in){ ?>
      <p class="w3-text-grey" id="tf12" contenteditable="true" onkeyup=saveEdits()>
      <?php }else{ ?>
      <p class="w3-text-grey" id="tf12" contenteditable="false">
      <?php } ?>
        This is place for your task summary. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
        laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
  </div>
</div>

<div class="w3-container w3-red w3-center w3-padding-64">
    <?php if($logged_in){ ?>
    <div id="update"> <h1 class="w3-margin w3-large">Edit the text and click to save for next time</h1></div>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <input type="text" style="display:none" id="textVal1" name="textVal1"/>
    <input type="text" style="display:none" id="textVal2" name="textVal2"/>
    <input type="text" style="display:none" id="textVal3" name="textVal3"/>
    <input type="text" style="display:none" id="textVal4" name="textVal4"/>
    <input type="text" style="display:none" id="textVal5" name="textVal5"/>
    <input type="text" style="display:none" id="textVal6" name="textVal6"/>
    <input type="text" style="display:none" id="textVal7" name="textVal7"/>
    <input type="text" style="display:none" id="textVal8" name="textVal8"/>
    <input type="text" style="display:none" id="textVal9" name="textVal9"/>
    <input type="text" style="display:none" id="textVal10" name="textVal10"/>
    <input type="text" style="display:none" id="textVal11" name="textVal11"/>
    <input type="text" style="display:none" id="textVal12" name="textVal12"/>
    <input type="submit"/>
    </form>
    <?php } else{ ?>
        <h1 class="w3-margin w3-large">Have a nice day!</h1>
    <?php } ?>
</div>

</body>
</html>