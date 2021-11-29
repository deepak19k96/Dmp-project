<?php
class Helper {

    public static function print_array($f) {
        echo '<pre>';
            print_r($f);
        echo '</pre>';
    }

    public static function load($file) {
        include  $_SERVER['DOCUMENT_ROOT'] . ADMIN_BASE . '/controllers/' . $file . '.php';
    }

    public static function sendlog($string){
        error_log($string, 0);
    }

} // End Class