<?php
@session_start();
error_reporting(1);
ini_set('display_errors', 1);

$appDir = '../dashboard';
require '../config.php';
require '../vendor/autoload.php';


$bootstrap = new Bootstrap();

// Optional Path Settings
$bootstrap->setControllerPath(CONTROLLERS_PATH);
$bootstrap->setModelPath(MODELS_PATH);

$bootstrap->init();

