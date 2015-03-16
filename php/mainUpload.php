<?php
session_start();
if(!isset($_SESSION['valid'])) {
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
    <link rel="stylesheet" type="text/css" href="/~picottes/final/css/blog.css"></link>
  </head>
  <body>
    <img src="/~picottes/final/images/toneLogo.jpg" alt="toneBox">
	<div class="nav">
	  <ul>
        <li><a>UPLOAD</a></li>
        <li><a href="http://web.engr.oregonstate.edu/~picottes/final/php/yourInstruments.php">YOUR INSTRUMENTS</a></li>
        <li><a href="http://web.engr.oregonstate.edu/~picottes/final/php/yourInstruments.php?action=end">LOG OUT</a></li>
      </ul>
    </div>
    <p>
      <button class="sub" id="newInstrument" name="newInstrument">Add to New Instrument</button>
      <button class="sub" id="updateInstrument" name="updateInstrument">Update Existing Instrument</button>
    <p></p>
    <div class="bodyText" id="uploadMessage"></div>
    <div class="bodyText" id="formError"></div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://web.engr.oregonstate.edu/~picottes/final/js/upload.js"></script>
  </body>
</html>
