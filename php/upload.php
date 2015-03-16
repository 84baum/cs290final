<?php
    session_start();
    include_once('dbConnect.php');
    if ($_POST['type'] == 'new') {
        echo '<h2>Enter the Following To Get Started</h2>';
        echo '<p><form class="formText" action="mainUpload.php" method="post">
          Maker: 
          <input type="text" name="maker" id="maker"><p>
          Model: 
          <input type="text" name="model" id="model"><p>
          Year: 
          <input type="number" name="yearMade" id="yearMade"><p>
          Serial: 
          <input type="text" name="serial" id="serial"><p>
          Strings Used: 
          <input type="text" name="strings" id="strings"><p>
          Embed Audio: 
          <input type="text" name="audio" id="audio"><p>
          <button type="submit" class="sub" id="addNew" name="addNew">Add to Collection</button>
        </form></div>';
    }
    else if ($_POST['type'] == 'update') {
        $sql = 'SELECT DISTINCT guitarMake, guitarModel, serialNum, guitarYear FROM toneBoxSound WHERE username = ?';
        $stmt = $mysqliConn->prepare($sql);
        if($stmt === false) {
           trigger_error('Sorry we had a problem. Please try again.');
        }
        $stmt->bind_param('s', $_SESSION['user']);
        $stmt->execute();
        $results = $stmt->get_result();
        echo '<form action="mainUpload.php" method="post">';
        echo '<p><h2>Instrument Inventory</h2> <p> <table>'; 
        echo '<thead><tr><th> Year <th> Make <th> Model <th> Serial Number <th> Update Instrument</thead>';
        while ($row = $results->fetch_assoc()) {
            echo '<tr><td>' . $row['guitarYear'] . '<td>' . $row['guitarMake'] . '<td>' . $row['guitarModel']
               . '<td>' . $row['serialNum'] . 
               '<td><button name="remove" class="sub" type="submit" id="updateInstrument" value=' . $row['serialNum'] . '>Update
               </button>';
        }
        echo '</table>';
        $stmt->close();
    }
    else if ($_POST['type'] == 'addNew') {
        $sql = 'INSERT INTO toneBoxSound (username, guitarMake, guitarModel,
            guitarYear, serialNum, guitarStrings, guitarMP3, dateUploaded) VALUES (?,?,?,?,?,?,?,?)';
        $username = $_SESSION['user'];
        $make = $_POST['maker'];
        $model = $_POST['model'];
        $year = $_POST['yearMade'];
        $serial = $_POST['serial'];
        $strings = $_POST['strings'];
        $audio = $_POST['audio'];

        $date = date('Y-m-d');
        $stmt = $mysqliConn->prepare($sql);
        if ($stmt === false) {
            trigger_error("Sorry, please try adding your information again.");
        }
        $stmt->bind_param('sssiisss', $username, $make, $model, $year, $serial, $strings, $audio, $date);
        $stmt->execute();
        $stmt->close();
        echo $make . ' ' . $model . ' has been added';   
    }
    else if ($_POST['type'] == 'updateInstrument') {
        $serial = $_POST['serial'];
        $username = $_SESSION['user'];
        $sql = 'SELECT DISTINCT guitarMake, guitarModel, serialNum, guitarYear FROM toneBoxSound WHERE serialNum = ? AND username = ?';
        $stmt = $mysqliConn->prepare($sql);
        if($stmt === false) {
           trigger_error('Sorry we had a problem. Please try again.');
        }
        $stmt->bind_param('ss', $serial, $username);
        $stmt->execute();
        $results = $stmt->get_result();
        $row = $results->fetch_assoc();
        $make = $row['guitarMake'];
        $model = $row['guitarModel'];
        $year = $row['guitarYear'];
        $stmt->close();
        
        echo '<p><h2>Add A Recording To Your ' . $year . ' ' . $make . ' ' . $model . '.</h2>
          <form class="formText">
          Strings Used:
          <input type="text" name="strings" id="strings"><p>
          Embed Audio:
          <input type="text" name="audio" id="audio"><p>
          <button type="submit" class="sub" id="addUpdated" value=' . $serial . '>Add to Collection</button>
          </form>';   
    }
    else if ($_POST['type'] == 'addUpdated') {
        $serial = $_POST['serial'];
        $strings = $_POST['strings'];
        $audio = $_POST['audio'];
        $username = $_SESSION['user'];         
        $sql = 'SELECT DISTINCT guitarMake, guitarModel, serialNum, guitarYear FROM toneBoxSound WHERE serialNum = ? AND username = ?';
        $stmt = $mysqliConn->prepare($sql);
        if($stmt === false) {
           trigger_error('Sorry we had a problem. Please try again.');
        }
        $stmt->bind_param('ss', $serial, $username);
        $stmt->execute();
        $results = $stmt->get_result();
        $row = $results->fetch_assoc();
        $make = $row['guitarMake'];
        $model = $row['guitarModel'];
        $year = $row['guitarYear'];
        $date = date('Y-m-d');
        $stmt->close();
        
        $sql = 'INSERT INTO toneBoxSound (username, guitarMake, guitarModel,
            guitarYear, serialNum, guitarStrings, guitarMP3, dateUploaded) VALUES (?,?,?,?,?,?,?,?)';
        $stmt = $mysqliConn->prepare($sql);
        if ($stmt === false) {
            trigger_error("Sorry, please try adding your information again.");
        }
        $stmt->bind_param('sssiisss', $username, $make, $model, $year, $serial, $strings, $audio, $date);
        $stmt->execute();
        $stmt->close();
        
        echo $year . ' ' . $maker . ' ' . $model . ' has been updated'; 
    }
    
?>