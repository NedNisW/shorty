<?php
declare(strict_types=1);

use Elie\PHPDI\Config\ConfigInterface;
use Shorty\Application\Config\EnvironmentsEnum;

return [
    'project'                     => [
        'base_url'      => $_ENV['BASE_URL']
    ],
    'environment'                 => new EnvironmentsEnum($_ENV['ENV'] ?? EnvironmentsEnum::DEVELOP),
    ConfigInterface::USE_AUTOWIRE => true,
];