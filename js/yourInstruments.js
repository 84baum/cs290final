$(document).ready(function(){
    /*
     * display table of all users instruments
     */
    $("#guitarTable").load("displayInstruments.php");
    
    /*
     * display all of the recordings of selected instrument
     */
    $("#guitarTable").on('click', '#displayAudio', function(){
        displayType = 'displayAudio';
        serial = $(this).prop("value");
        $.ajax({
            type: "POST",
            url: "audioList.php",
            dataType: "html",
            data: {type: displayType, serial: serial},
            success: function(successful) {
                $("#guitarTable").html(successful);
            }
        });
        return false;
    });
    /*
     * display table of all users instruments
     */
    $("#guitarTable").on('click', '#allInstruments', function(){
        $.ajax({
            type: "POST",
            url: "displayInstruments.php",
            dataType: "html",
            data: {type: displayType},
            success: function(successful) {
                $("#guitarTable").html(successful);
            }
        });
        return false;
    });
    /*
     * open a dialog box of selected recording
     */
    $(function() {
        $("#dialog").dialog({
            dialogClass: "audio-ui",
            autoOpen: false,
            modal: true,
            width: 600,
            height: 300,
            buttons: {
                "Close": {
                    click: function() {
                        $(this).dialog("close");
                    },
                    text : 'Close'
                }
            }    
        });
        $("#guitarTable").on('click', '#playAudio', function(box) {
            box.preventDefault();
            audio = $(this).attr("value");
            $("#dialog").dialog("open");
            $("#dialog").html(audio);
        });
    });
});