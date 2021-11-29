<?php

class Games extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
        $Blog = json_decode($this->model->getBlogs());
       // \Helper::print_array($Blog);
        foreach ($Blog as $Bloggie) {
            if($Bloggie->tags) {
                $PostTags = str_replace(',', ' | ', $Bloggie->tags);
            }
            echo "{$Bloggie->post_date}, {$Bloggie->post_modified}, {$Bloggie->post_type}, {$Bloggie->name}, {$PostTags},{$Bloggie->post_status},{$Bloggie->post_title}, <a href='https://www.cresinsurance.com/{$Bloggie->post_name}'>https://www.cresinsurance.com/{$Bloggie->post_name}" . PHP_EOL;
        }
		// $this->view->render('games/index');
		
    }
    
}