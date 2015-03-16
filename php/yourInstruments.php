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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://web.engr.oregonstate.edu/~picottes/final/js/yourInstruments.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/overcast/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="/~picottes/final/css/blog.css"></link>
  </head>
  <body>
    <img src="/~picottes/final/images/toneLogo.jpg" alt="toneBox">
	<div class="nav">
	  <ul>
        <li><a href="http://web.engr.oregonstate.edu/~picottes/final/php/mainUpload.php">UPLOAD</a></li>
        <li><a>YOUR INSTRUMENTS</a></li>
        <li><a href="http://web.engr.oregonstate.edu/~picottes/final/php/yourInstruments.php?action=end">LOG OUT</a></li>
      </ul>
    </div>
    <div class="bodyText" id="guitarTable"></div>
    <div id="dialog"></div>
  </body>
</html>
