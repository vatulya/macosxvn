<?php

error_reporting(E_ALL);

(new \Phalcon\Debug())->listen();

try {

    /**
     * Read the configuration
     */
    $config = include __DIR__ . "/../apps/config/config.php";

    /**
     * Read auto-loader
     */
    include __DIR__ . "/../apps/config/libraries.php";

    /**
     * Read services
     */
    include __DIR__ . "/../apps/config/services.php";
    
    /**
     * Read modules
     */
    include __DIR__ . "/../apps/config/modules.php";

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);
    
    // Register the installed modules
    $application->registerModules(
        array(
            'frontend' => array(
                'className' => 'Macosxvn\Frontend\Module',
                'path'      => '../apps/frontend/Module.php',
            ),
            'backend'  => array(
                'className' => 'Macosxvn\Backend\Module',
                'path'      => '../apps/backend/Module.php',
            )
        )
    );

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage();
}
