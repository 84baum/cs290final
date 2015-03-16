<?php
    include_once('dbConnect.php');
    
    $username = $_POST["name"];
    $password = md5($_POST["pass"]);
    $successful = 'false';
    $sql = 'SELECT * FROM toneBoxUsers WHERE(username = ?)';
    $stmt = $mysqliConn->prepare($sql);
    if ($stmt === false) {
        trigger_error("Sorry we had a problem creating your account. Please try again.");
    }
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    $rowCount = $stmt->num_rows;
    if ($rowCount == 0) {
        $stmt->close();
        $sql = 'INSERT INTO toneBoxUsers (username, password) VALUES (?,?)';
        $stmt = $mysqliConn->prepare($sql);
        if ($stmt === false) {
            trigger_error("Sorry we had a problem creating your account. Please try again.");
        }
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $stmt->close();
        $successful = 'true';
        echo $successful;
    }
    else {
        echo $successful;
    }
    $mysqliConn->close();
    unset($mysqliConn);
?>