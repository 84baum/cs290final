/*
 * validate username and password
 */
$(document).ready(function() {
$("#login").click(function(){
    username = $("#uName").val();
    password = $("#pWord").val();
    if (username == "" || password == "") {
        $("#logMessage").html("Please enter both a username and password");
        return false;
    }
    $.ajax({
        type: "POST",
        url: "php/logCheck.php",
        dataType: "text",
        data: {name: username, pass: password},
        success: function(successful){
            if (successful == 'true') {
                window.location="php/yourInstruments.php";
            }
            else {
                $("#logMessage").html("Wrong username or password");
            }
        }
    });
    return false;
});
});