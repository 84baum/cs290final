/*
 * validate unique username
 */
$(document).ready(function() {
$("#signUp").click(function(){
    username = $("#uName").val();
    password = $("#pWord").val();
    if (username == "" || password == "") {
        $("#signUpMessage").html("Please enter both a username and password");
        return false;
    }
    $.ajax({
        type: "POST",
        url: "php/newUser.php",
        dataType: "text",
        data: {name: username, pass: password},
        success: function(successful) {
            if (successful == 'true') {
                $("#signUpMessage").html('Welcome to the community. Please click <a href="http://web.engr.oregonstate.edu/~picottes/final/login.html"> here </a>to login.');
            }
            else {
                console.log(successful);
                $("#signUpMessage").html("Username is already in use. Please select a new Username.");
            }
        }
    });
    return false;
});
});