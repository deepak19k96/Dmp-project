<?php

class Router {
    public static function Routing() {
        $router = new AltoRouter();
         $router->setBasePath('');

        // Rules Set Here
        $router->map('GET|POST','/game/info/[i:id]',  array('c' => 'games', 'a' => 'index'));

        // Dashboard


        return $router->match();

    }
}