<?php
class TwilioEvent extends BaseEvent {
	
	/**
	 * Twilio Credentials
	 */
	protected $AccountSid;
	protected $AuthToken;
	protected $client;

	// Create the requested input
	abstract function create(){

		// Assign credentials
		$this->AccountSid = Config::get('twilio_accountsid');
		$this->AuthToken  = Config::get('twilio_authtoken');

		// Client
		$this->client = new Services_Twilio($this->AccountSid, $this->AuthToken);

	}

}