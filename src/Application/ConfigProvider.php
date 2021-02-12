<?php
declare(strict_types=1);

namespace Shorty\Application;

use Shorty\Application\Service\ConfigService;
use Shorty\Application\Service\ConfigServiceFactory;

/**
 * Class ConfigProvider
 *
 * @author Dennis Wandke <dennis.wandke@mainz-allstars.de>
 */
class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'factories' => [
                    ConfigService::class => ConfigServiceFactory::class,
                ]
            ]
        ];
    }
}