<?php
session_start();
if((isset($_GET['action']) && $_GET['action'] == 'end') || !isset($_SESSION['valid'])) {
    $_SESSION = array();
    session_destroy();
    header('Location: http://web.engr.oregonstate.edu/~picottes/final/login.html');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset = "UTF-8">
    <title>toneBox</title>
    <link rel="stylesheet" type="text/css" href="blog.css"></link>
  </head>
  <body>
    <img src="toneLogo.jpg" alt="toneBox">
	<div class="nav">
	<ul>
      <li><a>HOME</a></li>
      <li><a href="http://web.engr.oregonstate.edu/~picottes/final/php/mainUpload.php">UPLOAD</a></li>
      <li><a href="http://web.engr.oregonstate.edu/~picottes/final/php/yourInstruments.php">YOUR INSTRUMENTS</a></li>
      <li><a href="http://web.engr.oregonstate.edu/~picottes/final/home.php?action=end">LOG OUT</a></li>
    </ul>
    </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://web.engr.oregonstate.edu/~picottes/final/js/logCheck.js"></script>
  </body>
</html>
