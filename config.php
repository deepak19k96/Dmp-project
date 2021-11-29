<?php
ini_set('error_reporting', 1);  // Don't show any fuckn errors.
error_reporting(E_ALL & ~E_NOTICE);

define('URL', 'https://www.seedproject.com/');
define('SITE_BASE', '/');
define('ASSETS', '/assets');
define('COMPANY', 'DMPFile');

define('DASHBOARD', '/dashboard');
define('DASHBOARD_ASSETS', '/dashboard/assets');
define('DASHBOARD_TITLE', 'DMPFile - Dashboard');
define('DASHBOARD_LOGO_TEXT', 'DMPFile');


/*
 *  Email Settings
 */

define('EMAILUSER', 'ADDEMAILUSER');
define('EMAILPASSWORD', 'ADDEMAILPASSWORD');
define('EMAILHOST', 'ADDEMAILHOST');


if(!$appDir) {
    define('CONTROLLERS_PATH', 'public/controllers/');
    define('MODELS_PATH', 'public/models/');
    define('VIEWS_PATH', 'public/views/');
} else {
    define('CONTROLLERS_PATH', './controllers/');
    define('MODELS_PATH', './models/');
    define('VIEWS_PATH', './views/');

}
/*
* Database Configurations
*/

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'seedproject_seedproject');
define('DB_USER', 'root');
define('DB_PASS', '');


//define('DB_TYPE_REMOTE', 'mysql');
//define('DB_HOST_REMOTE', '149.28.110.58');
//define('DB_NAME_REMOTE', 'tstdmp_remote');
//define('DB_USER_REMOTE', 'tstdmp_test');
//define('DB_PASS_REMOTE', 'gekko-0-0');


// The sitewide hashkey, do not change this because its used for passwords!
define('HASH_GENERAL_KEY', 'He thought he saw an Elephant That practised on a fife:');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'tokyo 5 XBOX : QUEEN GOLF drip COFFEE skype 9 DRIP nut 2 APPLE NUT');
define('HASH_API_KEY', '$$TokyoP@palCasa!!^');
define('TIMESTAMP', date('Y-m-d H:i:s'));