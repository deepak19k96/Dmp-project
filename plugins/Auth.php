<?php
class Auth {

	public static function externalAccess(){
        $headers = apache_request_headers();

        if($headers['X-Authorization'] == AUTHORIZATION) {
            $db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);  // Initiate database
            $Result = $db->select("select * from webform where formkey='123456'");
            print_array($Result);
        }

	}
	
    public static function handleLogin() {
        $logged = $_SESSION['User'];

        if ($logged == false) {
            session_destroy();
            header('location: ' . DASHBOARD . '/login');
            exit;
        }
		
		$Return = $logged;
		
		return $Return;
	}


    /*
     * This make no fuckn sense
     */
    public static function deniedAction($permission, $controller) {
		$controller = strtolower($controller);
        foreach($permission as $permContrller => $PerMethod) {
			if($permContrller == $controller) {
				$AllowAccess = 1;
				break;
			}
		}
		
		if($AllowAccess == 1) {
			return true;
		} else {
			print_array('Deny Access ' . $controller);
		}
        
    }

    /*
      This manages Access Level at a method level.
      If the user has a restriction in the database they will be denied access to this method.
     */

    #TODO: I'm debating whether i should have Die or just have it return a false. Having false will leave flexbilities in jquery / json call to the method.
    #TODO: Actually i could have a json error Access Denied with a Error Code with 0 hmmm.....  

    public static function AccessGranted($permission, $method) {

        if (in_array($method, $permission)) {
            print_array('allow access');  // true
        } else {
            die('Access Denied');
        }
    }

}