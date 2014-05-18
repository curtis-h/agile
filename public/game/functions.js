/*
 * updateStatus
 * 
 * control -> The controller ID, given by the server
 * value   -> What value we are passing the system
* 371f816f72fd31135e71dee1a1eb8ab0
*/
function updateStatus(control, value) {

	var url = "http://37.139.5.63/api/update/" + UserId + "/" + control + "/" + value;
	
	$.ajax({
	    url: url,
	    jsonp: "callback",
	    dataType: "jsonp",
	    // work with the response
	    success: function( response ) {
	        console.log( response ); // server response
	    }
	});

	console.log(url);
	
}

/*
 * createStatus
 * 
 * message -> The message to display to the user
*/
function createStatus(message) {
	
	//-- Change Text
	$('#mm').html(message);
	//-- Full screen
	$('#messageHero').fadeIn();
	$('#mm').slabText();
	
}
