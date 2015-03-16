$(document).ready(function() {
    /*
     * request form for new input of new instrument
     */
    $("#newInstrument").click(function(){
        $("#formError").empty();
        upType = 'new';
        $.ajax({
            type: "POST",
            url: "upload.php",
            dataType: "html",
            data: {type: upType},
            success: function(successful) {
                $("#uploadMessage").html(successful);
            }
        });
        return false;
    });
    /*
     * request form for update of existing instrument
     */
    $("#updateInstrument").click(function(){
        $("#formError").empty();
        upType = 'update';
        $.ajax({
            type: "POST",
            url: "upload.php",
            dataType: "html",
            data: {type: upType},
            success: function(successful) {
                $("#uploadMessage").html(successful);
            }
        });
        return false;
    });
    /*
     * input values from form for new instrument
     */
    $("#uploadMessage").on('click', '#addNew', function(){
        $("#formError").empty();
        upType = 'addNew';
	    maker = $("#maker").val();
	    model = $("#model").val();
		year = $("#yearMade").val();
	    serial = $("#serial").val();
 	    strings = $("#strings").val();
  	  	audio = $("#audio").val();

        if (maker == "" || model == "" || serial == "" || strings == "" || audio == "") {
            $("#formError").html("Please enter all form values<p>");
            return false;
        }
        if (!$.isNumeric(year)) {
            $("#formError").html("Please enter a numeric year");
            return false;
        }
	    $.ajax({
	        type: "POST",
	        url: "upload.php",
	        dataType: "html",
	        data: {type: upType, maker: maker, model: model, yearMade: year, serial: serial, strings: strings,
	            audio: audio},
	        success: function(successful) {
	            $("#uploadMessage").html(successful);
	        }
	    });
	    return false;
	});
	/*
     * select instrument from user database to be updated
     */
	$("#uploadMessage").on('click', '#updateInstrument', function(){
	    $("#formError").empty();
	    upType = 'updateInstrument';
	    serial = $(this).prop("value");
	    $.ajax({
	        type: "POST",
	        url: "upload.php",
	        dataType: "html",
	        data: {type: upType, serial: serial},
	        success: function(successful) {
	            $("#uploadMessage").html(successful);
	        }
	    });
	    return false;
	});
	/*
     * input form for update of existing instrument
     */
	$("#uploadMessage").on('click', '#addUpdated', function(){
	    $("#formError").empty();
	    upType = 'addUpdated';
	    serial = $(this).prop("value");
	    strings = $("#strings").val();
	    audio = $("#audio").val();
	    
	    if (serial == "" || strings == "" || audio == "") {
            $("#formError").html("Please enter all form values<p>");
            return false;
        }
        
	    $.ajax({
	        type: "POST",
	        url: "upload.php",
	        dataType: "html",
	        data: {type: upType, serial: serial, strings: strings, audio: audio},
	        success: function(successful) {
	            $("#uploadMessage").html(successful);
	        }
	    });
	    return false;
	});
});

