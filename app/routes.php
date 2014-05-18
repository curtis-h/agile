<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//-- Login Page
Route::get('/',         'FrontSiteController@showIndex');

//-- Creates user controls
Route::get('start', 'ServerController@createGame');

//-- Stops the game
Route::get('stop', 'ServerController@stopGame');

//-- Restart the game
Route::get('restart', 'ServerController@restartGame');

//-- Main UI
Route::any('front',     'FrontSiteController@showUI');

// Misc
Route::any('api/createEvent', 'ServerController@createEvent');

//* TESTING
 
Route::any('checkUserControls/{user_id}', 'ServerController@createUserControls');
Route::any('checkEvents', 'ServerController@createEvent');

Route::any('checkUpdate/{user_id}/{control_id}/{$value}', 'ServerController@checkEvent');
//*/

Route::group(array('before' => 'auth'), function() {
    
    //-- API Routes
    Route::any('api/update/{user_id}/{control_id}/{value}/{cid}', 'ServerController@checkEvent');
    Route::any('api/fail/{event_id}', 'ServerController@failEvent');
    
    //-- Viewing Routes
    Route::get('controls',      'FrontSiteController@showController');
    
});

Route::get('api/users/{id?}', 'ApiUsersController@get_index');

Route::get('/profile', array('before' => 'auth', function()
{
	//@TODO: Jake to create awesome page here :)
	$user = Auth::user();
	
	echo 'Name: '.$user->firstname.' '.$user->lastname.'<br><br>';
	echo 'Achievements:<br>';
	
	foreach ($user->achievements as $achievement)
		echo $achievement->name.'<br>';
	
	echo 'Stats:<br>';
	
	foreach ($user->stats as $stat)
		echo $stat->name.' - '.$stat->value.'<br>';
}));

Route::get('/leaders', array('as' => 'leaders', function()
{
	$users = User::all();
	
	$sort = array();
	$asdf = array();
	$user_list = array();
	
	foreach($users as $user){
		$completed = 0;
		foreach($user->stats as $stat){
			if($stat->name = "Completed Events")
				$completed = $stat->value;	
		}
		$sort[] = $completed;
		$asdf[$user->id] = $completed;
		$user_list[] = $user;
	}
	
	array_multisort($sort, SORT_DESC, $user_list);
	
	echo '<h2>Leader Board</h2>';
	
	foreach ($user_list as $user)
		echo $user->firstname.' '.$user->lastname.' - '.$asdf[$user->id].'<br>';
	
}));

Route::get('social/{action?}', array("as" => "hybridauth", function($action = "")
{
    // check URL segment
    if ($action == "auth") {
        // process authentication
        try {
            Hybrid_Endpoint::process();
        }

        catch (Exception $e) {
            // redirect back to http://URL/social/
            return Redirect::route('hybridauth');
        }
        return;
    }

    try {
        // create a HybridAuth object
        $socialAuth = new Hybrid_Auth(app_path() . '/config/hybridauth.php');
        // authenticate with Facebook
        $provider = $socialAuth->authenticate("Facebook");
        // fetch user profile
        $userProfile = $provider->getUserProfile();
       
		//Check if user has record already
        $user = User::where('email', '=', $userProfile->email)->first();
        //print_R($user);
        if ($user)
		{		    
			//Update user details
				$user->firstname = $userProfile->firstName;
				$user->lastname = $userProfile->lastName;
				$user->picture = $userProfile->photoURL;
				$user->twofac = true;
				$user->phone = '12';
				$user->save();
		}else{			
			$details = array(
				'email' => $userProfile->emailVerified,	
				'firstname' => $userProfile->firstName,	
				'lastname' => $userProfile->lastName,	
				'fb_id' => $userProfile->identifier,	
				'picture' => $userProfile->photoURL,	
			    'phone' => '12',
			    'twofac' => true,
			);
			
			$user = User::create($details);
			//echo 'User Created';
			
		}
		
		Auth::login($user, true);
		
    }

    catch(Exception $e) {
        // exception codes can be found on HybBridAuth's web site
        return $e->getMessage();
    }

    // access user profile data
    //echo "Connected with: <b>{$provider->id}</b><br />";
    //echo "As: <b>{$userProfile->displayName}</b><br />";
    //echo "<pre>" . print_r( $userProfile, true ) . "</pre><br />";
    //-- return Redirect::to('/game');
    return Redirect::to('/controls');
}));

Route::get('getphone/{action?}', array("as" => "getphone", "before" => "auth", function($action = "")
{
    // check URL segment
    if ($action == "add") {
        if($_REQUEST['number'] != ''){
			$user = Auth::user();

			$user->phone = $_REQUEST['number'];

			$user->save();
			
			return Redirect::to('/controls');
        }
    }


    echo 'Add Phone form goes here';
}));

Route::get('twofactor/{action?}', array("as" => "twofactor", "before" => "auth", function($action = "")
{
    
	$user = Auth::user();
	
    if ($action == "check") {
    	if($user->twofac_compare == $_REQUEST['code']){
    		$user->twofac = true;
			$user->save();
			return Redirect::to('/controls');
    	}else{
    		//@TODO: Jake make pretty
    		echo 'wrong code';	
    	}
    }else{
		$digits = 4;
		$code = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
		$to = $user->phone;
		$user->twofac_compare = $code;
		
		// Assign credentials
		//$this->AccountSid = Config::get('twilio_accountsid');
		//$this->AuthToken  = Config::get('twilio_authtoken');

		// Client
		$client = new Services_Twilio('AC6ecab69649ef42b88af8e3a992e9f325', '35683cc660e4c130852323de811801ff');
		
		$body = "Your verification code is: $code";
		$client->account->sms_messages->create('+441133201223', $to, $body);
		
		$user->save();
	}

    //@TODO: Jake do designer shit
    echo 'Enter code';
}));

Route::any('xeedata', array("as" => "xeedata", function()
{
	$name = $_REQUEST['name'];
	$value = $_REQUEST['value'];
	
	$xee = XeeData::where('name', '=', $name)->first();
	
	if(!$xee){
		$xee = new XeeData();
	}
	
	$xee->name = $name;
	$xee->value = $value;
	
	$xee->save();
}));
