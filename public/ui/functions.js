/*
 * createEvent
 * 
 * name 	-> Name of the Event
 * timeout 	-> How long the event has until it is dead
 * id		-> system ID of the event
 *
*/
function createEvent(name, timeout, id, user_id) {
	
	var newHTML = '<div class="row event" id="event_' + id + '" rel="' + timeout + '" data-id="' + id + '" data-user="' + user_id + '"><div class="col-xs-2">' + name + '</div><div class="col-xs-10"><div class="progress progress-striped active"><div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="event-bar-' + id + '"><span class="sr-only">0% Complete</span></div></div></div></div';
	
	$('.ui-container').append(newHTML);
	
}

function runEvents() {
	
	$('.event').each(function() {
		var thisID = $(this).attr('data-id');
		var timeOut = $(this).attr('rel');
		
		//-- What is my amount
		var thisAmount = parseInt($('#event-bar-' + thisID).attr('aria-valuenow'));
		
		if (thisAmount < timeOut) {
			
			var newAmount = (thisAmount + 1) * timeOut;
			$('#event-bar-' + thisID).attr('aria-valuenow', thisAmount + 1);
			$('#event-bar-' + thisID).css('width', newAmount + "%");
			
			if (newAmount >= 100) {
				tellServerFail(thisID);
			}
			
		}
	});	
}

function tellServerFail(id, user_id) {
	
	console.log("Send Fail: " + id);
	updateBaseHealth(10);
	
	var url = "http://37.139.5.63/api/fail/1/1";

	$.ajax({
	    url: url,
	    jsonp: "callback",
	    dataType: "jsonp",
	    // work with the response
	    success: function( response ) {
	        console.log( response ); // server response
	    }
	});
}

function updateBaseHealth(amount) {
	
	var Basehealth = parseInt($('.base-health').html());
	Basehealth = Basehealth - amount;
	$('.base-health').html(Basehealth);
	
}
