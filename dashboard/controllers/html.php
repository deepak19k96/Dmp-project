<?php


class Html extends Controller {

    function __construct() {
        parent::__construct();
         // Auth::handleLogin();   # Uncomment to secure.
        $this->view->Menu = $this->view->PartialView('menu');
    }

    function index() {
        $this->view->render('index/html' , '', false);
    }
	
    

}