$('document').ready(function(){
	 	

$('#submit').click(function(){
	 
	var question  = $('#s_question').val();
	var answer    = $('#s_answer').val();
    var error_box = $('#security_error');
    var end_error = $("#end_error");

	if(question == "" || answer == "")
     {
       error_box.show();
       error_box.html("Please fill all the fields of security.");
       return false;
     }
	 else
	 {
	 	$("#black").show();
        $("#loading").show();
	 	error_box.hide();
	 	end_error.hide();
	 }
});

});

