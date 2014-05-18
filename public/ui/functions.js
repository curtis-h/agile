/*
 * createEvent
 * 
 * name 	-> Name of the Event
 * timeout 	-> How long the event has until it is dead
 * id		-> system ID of the event
 *
*/
function createEvent(name, timeout, id, user_id) {
	
	var newHTML = '<div class="row event" id="event_' + id + '" rel="' + timeout + '" data-id="' + id + '" data-user="' + user_id + '"><div class="col-xs-6">' + name + '</div><div class="col-xs-6"><div class="progress progress-striped active"><div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="event-bar-' + id + '"><span class="sr-only">0% Complete</span></div></div></div></div';
	
	var newHTML = '<li style="padding-left: 0%" data-valuenow="0" rel="' + timeout + '" id="event_' + id + '" data-id="' + id + '"><img src="http://agilehack.demonic.me/ui/runner.gif"></li>';
	
	$('.progress_areas ul').append(newHTML);
	
}

function successEvent(event_id) {
	$('#event_' + event_id).remove();
	console.log("SUCCESS > " + event_id );
}

function runEvents() {
	
	//getHealth();
	
	$('.progress_areas ul li').each(function() {
		
		if ( $(this).find('img').attr('src') == "http://agilehack.demonic.me/ui/explosion.gif") {
        	$(this).remove();
        } else {
        	
        }
		var thisID = $(this).attr('data-id');
		var timeOut = $(this).attr('rel');
		
		//-- What is my amount
		var thisAmount = parseInt($('#event_' + thisID).attr('data-valuenow'));
		
		if (thisAmount < timeOut) {
			
			var newAmount = (thisAmount + 1) * timeOut;
			$('#event_' + thisID).attr('data-valuenow', thisAmount + 1);
			$('#event_' + thisID).css('padding-left', newAmount + "%");
			
			if (newAmount >= 100) {
				tellServerFail(thisID);
			}
			
		}  else {
	         $(this).find('img').attr('src', 'http://agilehack.demonic.me/ui/explosion.gif');
	    }
          
	});	
}

function getHealth() {
	
	var url = "http://agilehack.demonic.me/api/health";

	$.ajax({
	    url: url,
	    jsonp: "callback",
	    dataType: "jsonp",
	    // work with the response
	    success: function( response ) {
	       console.log(response);
	    }
	});
	
}

function tellServerFail(id, user_id) {
	
	updateBaseHealth(10);
	
	var url = "http://agilehack.demonic.me/api/fail/" + id + "/" + user_id;

	$.ajax({
	    url: url,
	    jsonp: "callback",
	    dataType: "jsonp",
	    // work with the response
	    success: function( response ) {
	        //console.log( response ); // server response
	    }
	});
}

function updateBaseHealth(amount) {
	
	var Basehealth = parseInt($('.base-health').html());
	Basehealth = Basehealth - amount;
	$('.base-health').html(Basehealth);
	
	if (Basehealth < 5) {
	    $.ajax({
	        url:'http://agilehack.demonic.me/forceClientEnd',
	        datatype: 'jsonp',
	    });
	    
		window.location = "http://agilehack.demonic.me/gameover";
	}
}
