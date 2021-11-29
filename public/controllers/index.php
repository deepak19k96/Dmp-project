<?php

use Snoopi as Snoopi;

class Index extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->Styles[] = '/public/assets/css/style.css';
		$this->view->Styles = $this->Styles;
		
        $this->view->title = 'Home' . COMPANY;
        $this->view->render('index/index');
    }
    
}