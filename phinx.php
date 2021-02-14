<?php
declare(strict_types=1);

require realpath(__DIR__ . '/vendor/autoload.php');

use Shorty\Application\Config\ConfigService;

$rawConfig = require realpath(__DIR__ . '/config/config.php');
$configService = new ConfigService($rawConfig);
$db = $configService->getByPath('database');

return
    [
        'paths'         => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
            'seeds'      => '%%PHINX_CONFIG_DIR%%/db/seeds'
        ],
        'environments'  => [
            'default_migration_table' => 'phinxlog',
            'default_environment'     => 'default',
            'default'                 => [
                'adapter' => 'mysql',
                'host'    => $db['host'],
                'name'    => $db['name'],
                'user'    => $db['username'],
                'pass'    => $db['password'],
                'port'    => $db['port'],
                'charset' => $db['charset'],
            ]
        ],
        'version_order' => 'creation'
    ];
