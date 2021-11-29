<?php
@session_start();
error_reporting(1);
ini_set('display_errors', 1);

# You can create your own config file for the project folder but setting the path for the config.
require $_SERVER['DOCUMENT_ROOT'] . '/config.php';

# run the following command in linux -> composer dump-autoload
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';


$bootstrap = new Bootstrap();
$bootstrap->init();

