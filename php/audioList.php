<?php
    include_once('dbConnect.php');
    session_start();
    if(!isset($_SESSION['valid'])) {
        $_SESSION = array();
        session_destroy();
        header('Location: http://web.engr.oregonstate.edu/~picottes/final/login.html');
        die();
    }
    if ($_POST['type'] == 'displayAudio') {
        $serial = $_POST['serial'];
        $username = $_SESSION['user'];
        $sql = 'SELECT guitarMP3, dateUploaded FROM toneBoxSound WHERE username = ? AND serialNum = ?';
        $stmt = $mysqliConn->prepare($sql);
        if($stmt === false) {
           trigger_error('Sorry we had a problem. Please try again.');
        }
        $stmt->bind_param('ss', $username, $serial);
        $stmt->execute();
        $results = $stmt->get_result();
        echo '<p><h2>Audio Recordings</h2> <p> <table>'; 
        echo '<thead><tr><th> Date <th> Audio </thead>';
        while ($row = $results->fetch_assoc()) {
            $audio = htmlspecialchars($row['guitarMP3']);
            echo "<tr><td>" . $row['dateUploaded'] . 
               "<td><button name='playAudio' class='sub' type='submit' id='playAudio' value='" . $audio . "'>Play Audio
                </button>";
        }
        echo '</table>';
        echo '<button class="sub" id="allInstruments" name="allInstruments">View All Instruments</button>';
        $stmt->close();
    }
?>