<?php
    session_start();
    include_once('dbConnect.php');
    $sql = 'SELECT DISTINCT guitarMake, guitarModel, serialNum, guitarYear FROM toneBoxSound WHERE username = ?';
    $stmt = $mysqliConn->prepare($sql);
    if($stmt === false) {
       trigger_error('Sorry we had a problem. Please try again.');
    }
    $stmt->bind_param('s', $_SESSION['user']);
    $stmt->execute();
    $results = $stmt->get_result();
    echo '<form action="yourInstruments.php" method="post">';
    echo '<p><h2>Instrument Inventory</h2> <p> <table>'; 
    echo '<thead><tr><th> Year <th> Make <th> Model <th> Serial Number <th> Audio</thead>';
    while ($row = $results->fetch_assoc()) {
        echo '<tr><td>' . $row['guitarYear'] . '<td>' . $row['guitarMake'] . '<td>' . $row['guitarModel']
        . '<td>' . $row['serialNum'] . 
        '<td><button name="display" class="sub" type="submit" id="displayAudio" value=' . $row['serialNum'] . '>
         Display Recordings</button>';
    }
    echo '</table>';
    $stmt->close();
?>