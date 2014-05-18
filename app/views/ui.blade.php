<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>UI</title>
	
	<!-- Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="//cdn.jsdelivr.net/bootflat/2.0.0/css/bootflat.css">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	
	<!-- System -->
	<link rel="stylesheet" href="<?php echo asset('ui/main.css'); ?>">
	
</head>
<body>
	
	<div id="topBar">
		<div class="container">
			<div class="row">
				<div class="col-xs-8 user-person">Base Health</div>
  				<div class="col-xs-4 base-health">100</div>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="row">
	    	<div class="col-sm-10">
	        
	            <div class="progress_areas">
	                <ul>
	                    
	                </ul>
	            </div>
	
	        </div>
	        
	        <div class="col-sm-2">
	        
	        	<div class="newc">
	           		<img src='<?php echo asset('ui/building.png'); ?>' width="100%">
	            </div>
	        
	        </div>
	    </div>
	</div>
	
	<!-- Bootstrap JS -->
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script src="<?php echo asset('ui/functions.js'); ?>"></script>
	<script>
		setInterval(function() {
				runEvents()
			}, 1000);
	</script>
	
	<!-- Pusher -->
	<script src="http://js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>
	<script>
		var pusher = new Pusher('d87b2847c2e28a530cde');
    	var channel = pusher.subscribe('roboto_event');
    	//-- Event Created
    	channel.bind('event_create', function(data) {
	    	createEvent(data.show_text + '> ' + data.cid, 10, data.event_id, data.user_id);
	    });
	    channel.bind('event_success', function(data) {
	    	successEvent(data);
	    });
	</script>
	
</body>
</html>
