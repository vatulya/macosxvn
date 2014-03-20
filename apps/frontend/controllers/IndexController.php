<?php
namespace Macosxvn\Frontend\Controllers;

class IndexController extends ControllerBase {

    public function indexAction() {
        $this->view->title = "Welcome";
    }
}

