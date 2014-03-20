<?php
namespace Macosxvn\Frontend\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    /**
     * This function is called in all action.
     * See http://docs.phalconphp.com/en/latest/reference/controllers.html#initializing-controllers
     * We will use this to initialize the layout from config file
     */
    public function initialize() {
        $local = $this->dispatcher->getParam('local');
        if (is_null($local)) {
            $local = "en";
        }
        $this->view->translator = $this->_getTranslator($local);
        $this->view->controllerName = $this->dispatcher->getControllerName();
        $this->view->actionName = $this->dispatcher->getActionName();
    }
    
    protected function _getTranslator($local = "en") {
        $config = $this->di->get('config');
        if (!file_exists($config->application->translation . "$local.csv")) {
            $local = "en";
        }
        $translator = new \Phalcon\Translate\Adapter\Csv([
            'file' => $config->application->translation . "$local.csv", // required
            'delimiter' => ',', // optional, default - ;
            'length' => '4096', // optional, default - 0
            'enclosure' => '^', // optional, default - "
        ]);
        return $translator;
    }
}
