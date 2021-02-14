<?php
declare(strict_types=1);

return [
    'database' => [
        'host'     => $_ENV['DB_HOST'],
        'port'     => $_ENV['DB_PORT'],
        'username' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASS'],
        'name'     => $_ENV['DB_NAME'],
        'charset'  => 'utf8'
    ]
];