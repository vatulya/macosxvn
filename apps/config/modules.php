<?php

//Specify routes for modules
$di->set('router', function () {

    $router = new Phalcon\Mvc\Router();

    $router->setDefaultModule("frontend");
    $router->setDefaultNamespace('Macosxvn\Frontend\Controllers');
    
    /**
     * Define route for user login
     */
    $router->add("/{local:(vn|en|fr)}/:action.html", array(
        'controller'    => 'index',
        'action'        => 2,
    ))->setName('base-url-local');
    
    $router->add("/:action.html", array(
        'controller'    => 'index',
        'action'        => 1,
    ))->setName('base-url');
    return $router;
});