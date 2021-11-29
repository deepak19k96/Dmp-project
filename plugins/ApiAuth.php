<?php

class ApiAuth {

    public static function handleLogin() {

		$ClientIPAddress = $_SERVER['REMOTE_ADDR'];

		#TODO: Need to check whether the client is over their quota, or exceeding calls per hour.
		#TODO: Basically check whether the client has access to process past this point.

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$APIKey = $_POST['apikey'];  // API Key from POST Request - Only thing we need to authenticate the user.
		} else {
			$APIKey = $_GET['apikey'];  // API Key from GET Request - Only thing we need to authenticate the user.
		}
		
		$db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);  // Initiate database
		// $Result = $db->select("select * from api_users where api_key= :apiKey and active='1'", array('apiKey' => $APIKey));
		$Result = $db->select("SELECT a.userid, a.username, b.apikey  FROM usergen  a JOIN usersapi b ON a.userid=b.userid  WHERE b.apikey='{$APIKey}' AND a.active='1' and b.active='1'");
		$ReturnedUsers = count($Result); 
		
		if($APIKey){
			if($ReturnedUsers < 1) { 
			http_response_code(401);
			$ReturnError['Code']='401';
			$ReturnError['Message']='Invalid API Key';
			$DieError = json_encode($ReturnError);
			die($DieError); }
		}
			if($Result[0]['userid']) {
				// Verified User ...  VIP 
				return $Result[0]['userid'];
			} else {
				// Free User Unregistered... Should pause every 5 seconds before allowing the next pull .
				// Add Throttle Script Here 
/*				
				$Result = $db->select("SELECT * FROM tmp_session where ip= :ipaddress", array('ipaddress' => $ClientIPAddress));
				if($Result){ 
					$LastCall = $Result[0]['lastcall'];
					$start_date = new DateTime($LastCall);  // From DB LASTCALL 
					$since_start = $start_date->diff(new DateTime(TIMESTAMP)); // NOW 

					if($since_start->s <= 2) {
						http_response_code(429);
						$ReturnError['Code']='429';
						$ReturnError['Message']='Rate Limit Exceeded';
						header('Content-Type: application/json');
						die (json_encode($ReturnError));        
					}
				
				// Update IP Address with Latest LASTCALL 
					$data['lastcall']=TIMESTAMP;
			        $Return = $db->update('tmp_session', $data, "ip='{$ClientIPAddress}'");
					//print_array($Return);

				} else {
					//Create New LastCall for the IP Address
				   $Response = $db->insert('tmp_session', array(
						'ip' => $ClientIPAddress,
						'lastcall' => TIMESTAMP,
					));
					return $Response;
				}// End Throttle Script Here 

*/

			}

	}


    /*
     * Access Level on a Controller Level .. I think. I Need SG to Explain this to me.
     */
    public static function deniedAction($permission, $controller) {
        $actionsdenied = array();
        for ($i = 0; $i < count($permission); $i++) {
            if ($permission[$i]['perm_controller'] == $controller) {
                array_push($actionsdenied, $permission[$i]['perm_action']);
            }
        }
        return $actionsdenied;
    }

    /*
      This manages Access Level at a method level.
      If the user has a restriction in the database they will be denied access to this method.
     */

    #TODO: I'm debating whether i should have Die or just have it return a false. Having false will leave flexbilities in jquery / json call to the method.
    #TODO: Actually i could have a json error Access Denied with a Error Code with 0 hmmm.....  

    public static function AccessGranted($method, $permission) {
        if (in_array($method, $permission)) {
            header('location: ' . URL . 'notauthorize');
        } else {
            return true;
        }
    }

}