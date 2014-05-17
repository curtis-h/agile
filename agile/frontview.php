<?PHP

/*
 * frontview.php
 *
 * A class used to show the actual HTML templates. Will [probably]
 * be calling in events etc
*/

class FrontSiteController extends BaseController {
	
	
	public function showIndex() {		
		if (Auth::check()) {			
			//-- User is logged in - show controls
			return Redirect::to('controls');		
		} else {			
    		//-- Show the Login Page
    		return View::make('login');    		
		}    	
    }
    
    public function showController() {
    
    	//-- Need to decide what controls we are using
    	$ss = new ServerController();
    	$array = $ss->createUserControls(Auth::user()->id);
    	
    	//-- Get the current Base health
    	$health = $ss->getGame();   	
    	
    	//-- Show Page
    	return View::make('controller', array('user' => Auth::user(), 'base_health' => $health, 'controls' => $array));
    }
    
    public function showUI() {
    	
    	return View::make('ui');
    }
    
}