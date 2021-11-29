<?php
use App\Components\Items;


class Index extends Controller {

    function __construct() {
        parent::__construct();
         // ApiAuth::handleLogin();   # Uncomment to secure the api.
    }
    
    function index() {
        echo "Dashboard API controller";
    }

    function test($id='') {
        echo 'testing ' . $id;
    }
	
    

}