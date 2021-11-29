<?php


class Login extends Controller {

    function __construct() {
        parent::__construct();
         // Auth::handleLogin();   # Uncomment to secure.
    }

    function index() {
        session_destroy();
        $this->view->render('login/index' , '', false);
    }


    function register() {
        $this->view->render('login/register' , '', false);
    }


    function forgot() {
        $this->view->render('login/forgot' , '', false);
    }

}