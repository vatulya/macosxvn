<?php
namespace Macosxvn\Frontend;

use Phalcon\Loader,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Mvc\View,
    Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface  {
    public function registerAutoloaders() {
        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'Macosxvn\Frontend\Controllers' => '../apps/frontend/controllers/',
                'Macosxvn\Frontend\Models'      => '../apps/frontend/models/',
            )
        );
        
//        $loader->registerDirs(array('../apps/libraries/'));

        $loader->register();
    }

    public function registerServices($di) {
        //Registering a dispatcher
        $di->set('dispatcher', function() {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace("Macosxvn\Frontend\Controllers");
            return $dispatcher;
        });

        $config = $di->get('config');
        //Registering the view component
        $di->set('view', function() use ($config) {
            $template = $config->application->template;
            $view = new View();
            $view->setViewsDir('../apps/frontend/views/' . $template . '/');
            $view->registerEngines(array(
                '.volt' => 'voltEngine',
                '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
            ));
            return $view;
        });
    }

}
