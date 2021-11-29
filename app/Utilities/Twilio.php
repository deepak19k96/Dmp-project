<?php namespace App\Utilities;

use Model as Model;

class Twilio extends Model {

    function __construct() {
        parent::__construct();
		
		$this->sid = "ACdfa7dfd31412446596f0677fde49d579"; // Your Account SID from www.twilio.com/console
		$this->token = "7fdc4b48c2fe1d992c957db4aec3b96a"; // Your Auth Token from www.twilio.com/console

    }

    function index(){

        echo 'nothing to see ... nothing to see.. keepit moving. ';

    }


    function SendMessage($data=""){

        	$Phone = $data['phone'];
			$Message = $data['message'];

			$client = new \Twilio\Rest\Client($this->sid, $this->token);
		
			try {
				$message = $client->messages->create(
				  '+' . $Phone, // Text this number
				  [
					'from' => '5616233030', // From a valid Twilio number
					'body' => $Message
				  ]
				);
				
				# Friendly Message 
				$Response['Code'] = '1';
				$Response['Message'] = 'success';
			
			} catch ( \Twilio\Exceptions\RestException $e) {
				$Response['Code'] = $e->getCode();
				$Response['Message'] = $e->getMessage();
				
			}

		return $Response;

    }


} // end class