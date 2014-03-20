<?php
namespace Macosxvn\Backend;

use Phalcon\Loader,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Mvc\View,
    Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface  {
    public function registerAutoloaders() {
        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'Macosxvn\Backend\Controllers' => '../apps/backend/controllers/',
                'Macosxvn\Backend\Models'      => '../apps/backend/models/',
            )
        );

        $loader->register();
    }

    public function registerServices($di) {
        //Registering a dispatcher
        $di->set('dispatcher', function() {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace("Macosxvn\Backend\Controllers");
            return $dispatcher;
        });

        //Registering the view component
        $di->set('view', function() {
            $view = new View();
            $view->setViewsDir('../apps/backend/views/');
            $view->registerEngines(array(
                '.volt' => 'voteEngine',
                '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
            ));
            return $view;
        });
    }

}
