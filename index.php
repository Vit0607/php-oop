<?php

require_once 'Database.php';
require_once 'Config.php';

$GLOBALS['config'] = 
[
    'mysql' => [
        'host' => 'localhost',
        'database' => 'php-oop',
        'username' => 'root',
        'password' => '',
        'something' => [
            'no' => [
                'bar' => 'baz'
            ]
        ]
    ]
];

echo Config::get('mysql.something.no.bar');