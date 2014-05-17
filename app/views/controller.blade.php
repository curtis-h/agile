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
				<div class="col-xs-8 user-person">{{ $user->firstname }}</div>
  				<div class="col-xs-4 team-health">{{ $base_health }}</div>
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
				<div id="control-dial" class="control-sep">
					<input type="text" value="75" class="dial" rel="1">
					<h2>Awesome Thermomenter V2</h2>
				</div>
				<div id="control-button" class="control-sep" style="display: block;">
					<div class="form-group">
						<input type="submit" class="btn btn-danger btn-block" rel="2" value="Fire Up" />
						<h2>The Furnace</h2>
					</div>
				</div>				
				<div id="control-radio" class="control-sep" style="display: block;">
					<div id="radios" rel="3" style="text-align: center;">
					    <input id="option1" name="options" type="radio" class="radios">
					    <label for="option1">1</label>					 
					    <input id="option2" name="options" type="radio" class="radios">
					    <label for="option2">2</label>					 
					    <input id="option3" name="options" type="radio" checked class="radios">
					    <label for="option3">3</label>					 
					    <input id="option4" name="options" type="radio" class="radios">
					    <label for="option4">4</label>					 
					    <input id="option5" name="options" type="radio" class="radios">
					    <label for="option5">5<label>					 
					</div>
					<h2>Potentiometer Array</h2>
				</div>
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
		var UserId = 1;
		
		$(function() {
			
			//-- On Update for the DIAL
		    $(".dial").knob({
		    	'release' : function() {
		    		updateStatus($('.dial').attr('rel'), $('.dial').val())
		    	}
		    });
		    
		    //-- On Update for the INPUT
		    $('.btn-danger').click(function() {
		    	updateStatus($(this).attr('rel'), 1)
		    });
		    
		    //-- On Update for thr RADIOS
		    $("#radios").radiosToSlider();
		    $('.slider-level').click(function() {
		    	updateStatus($('#radios').attr('rel'), $(this).attr('data-radio'))
		    });
		});
	</script>
	
</body>
</html>