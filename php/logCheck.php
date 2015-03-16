<?php
    include_once('dbConnect.php');
    
    $username = $_POST["name"];
    $password = md5($_POST["pass"]);
    $successful = 'false';
    $sql = 'SELECT * FROM toneBoxUsers WHERE(username = ? AND password = ?)';
    $stmt = $mysqliConn->prepare($sql);
    if ($stmt === false) {
        trigger_error("Sorry, we had problem logging you in. Please try again.");
    }
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $stmt->store_result();
    $rowCount = $stmt->num_rows;
    $results = $stmt->get_result();
    if ($rowCount == 1) {
        session_start();
        $_SESSION['user'] = $username;
        $_SESSION['valid'] = 1;
        $successful = 'true';
        echo $successful;
    }
    $stmt->close();
    $mysqliConn->close();
    unset($mysqliConn);
?>