<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Mobile</title>
	
	<!-- Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="//cdn.jsdelivr.net/bootflat/2.0.0/css/bootflat.css">
	
	<!-- System -->
	<link rel="stylesheet" href="<?php echo asset('game/main.css'); ?>">
	
	<!-- Controls -->
	<link rel="stylesheet" href="<?php echo asset('game/controllers/radio.css'); ?>">
	
</head>
<body>

	<div id="topBar">
		<div class="container">
			<div class="row">
				<div class="col-xs-6 user-person"><img style="height:60px; margin: -8px 15px 0 0;" src="{{ $user->picture }}">{{ $user->firstname }}</div>
  				<div class="col-xs-6 team-health">{{ $base_health }}</div>
			</div>
		</div>
	</div>
	
	<div id="messageHero">
		<div class="container">
			<div class="row">
				<!-- Someone has to send an email to test@sendgrid.com with a subject of Crapola -->
				<div id="mm">Someone has to send an email to test@sendgrid.com with a subject of Crapola</div>
			</div>
		</div>			
	</div>
	
	<div id="controller">
		<div class="container">
			<div class="row">
			<?php
			
			//dd($controls);
			
			?>
			<?php
			
			foreach($controls AS $n => $con) {
				
				switch($con['controlType']) {
					case 1:
						?>
						<div id="control-dial" class="control-sep">
							<input type="text" value="<?php echo rand(0, 100); ?>" class="dial" rel="1" data-id="{{ $con['id'] }}">
							<h2>{{ $con['name'] }}</h2>
						</div>
						<?php
					break;
					case 2:
						?>
						<div id="control-button" class="control-sep" style="display: block;">
							<div class="form-group">
								<input type="submit" class="btn btn-danger btn-block btn-lg" rel="2" value="Button" data-id="{{ $con['id'] }}" />
								<h2>{{ $con['name'] }}</h2>
							</div>
						</div>
						<?php
					break;
					case 3:
						?>
						<div id="control-radio" class="control-sep" style="display: block;">
							<div class="radios" rel="3" style="text-align: center;" data-id="{{ $con['id'] }}">
							    <input id="1" name="options" type="radio" class="radios">
							    <label for="option1">1</label>					 
							    <input id="2" name="options" type="radio" class="radios">
							    <label for="option2">2</label>					 
							    <input id="3" name="options" type="radio" checked class="radios">
							    <label for="option3">3</label>					 
							    <input id="4" name="options" type="radio" class="radios">
							    <label for="option4">4</label>					 
							    <input id="5" name="options" type="radio" class="radios">
							    <label for="option5">5<label>					 
							</div>
							<h2>{{ $con['name'] }}</h2>
						</div>
						<?php
					break;
				}
			}
			
			?>
								
				
			</div>
		</div>
	</div>
	
	<!-- Bootstrap JS -->
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script src="http://freqdec.github.io/slabText/js/jquery.slabtext.min.js"></script>
	
	<!-- Functions for the system -->
	<script src="<?php echo asset('game/functions.js'); ?>"></script>
	
	<!-- Controllers JS -->
	<script src="<?php echo asset('game/controllers/knob.js'); ?>"></script>
	<script src="<?php echo asset('game/controllers/radio.js'); ?>"></script>
	<script>
		var UserId = {{ $user->id }};
		
		$(function() {
			
			//-- On Update for the DIAL
		    $(".dial").knob({
		    	'release' : function() {
		    		updateStatus($('.dial').attr('rel'), $('.dial').val(), $('.dial').attr('data-id'))
		    	}
		    });
		    
		    //-- On Update for the INPUT
		    $('.btn-danger').click(function() {
		    	updateStatus($(this).attr('rel'), 1, $(this).attr('data-id'))
		    });
		    
		    //-- On Update for thr RADIOS
		    $(".radios").radiosToSlider();
		    $('.slider-level').click(function() {
		    	updateStatus($('.radios').attr('rel'), $(this).attr('data-radio'), $('.radios').attr('data-id'))
		    });
		    
		    $('#messageHero').click(function() {
		    	$('#messageHero').hide();	
		    });
		    
		});
	</script>
	
	<!-- Pusher -->
	<script src="http://js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>
	<script>
		var pusher = new Pusher('d87b2847c2e28a530cde');
    	var channel = pusher.subscribe('roboto_event');
    	//-- Event Created
    	channel.bind('event_create', function(data) {
    		
    		if (data.show_to == UserId) {
    			//-- Show to this user
    			createStatus(data.show_text);
    		}
    		
	    });

        channel.bind('event_clientEnd', function(data) {
            window.location = '/complete';
        });
	</script>
	
</body>
</html>