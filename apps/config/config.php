<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'root',
        'password'    => '',
        'dbname'      => 'test',
    ),
    'application' => array(
        'libraries'     => __DIR__ . '/../../apps/libraries',
        'cacheDir'      => __DIR__ . '/../../apps/cache/',
        'baseUri'       => '/',
        'template'      => 'cellcv',
        'skin'          => 'cellcv',
        'translation'   => __DIR__ . '/../../apps/translation/',
    )
));
