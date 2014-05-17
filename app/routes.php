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

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('start', 'ServerController@createGame');
Route::any('api/update/{user_id}/{control_id}/{value}', 'ServerController@checkEvent');
Route::any('api/fail/{user_id}/{control_id}', 'ServerController@failEvent');


Route::get('/game', array('before' => 'auth', function()
{
	echo 'a';
	exit();
}));

Route::get('/profile', array('before' => 'auth', function()
{
	//@TODO: Jake to create awesome page here :)
	$user = Auth::user();
	
	echo 'Name: '.$user->firstname.' '.$user->lastname.'<br><br>';
	echo 'Achievements:<br>';
	
	foreach ($user->achievements as $achievement)
		echo $achievement->name.'<br>';
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
			//echo 'User Logged In';
		}else{			
			$details = array(
				'email' => $userProfile->emailVerified,	
				'firstname' => $userProfile->firstName,	
				'lastname' => $userProfile->lastName,	
				'fb_id' => $userProfile->identifier,	
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
    return Redirect::to('/game');
}));
