<?php
    include 'storedInfo.php';
    
    $mysqliConn = new mysqli("oniddb.cws.oregonstate.edu", "picottes-db", $password, "picottes-db");
    if ($mysqliConn->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqliConn->connect_errno . ")" . $mysqliConn->connect_error;
    } 
?>