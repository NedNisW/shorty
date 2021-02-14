<?php
declare(strict_types=1);

namespace Shorty\Application\Config;

use Psr\Container\ContainerInterface;
use Shorty\Application\Config\ConfigService;

/**
 * Class ConfigServiceFactory
 *
 * @author Dennis Wandke <dennis.wandke@mainz-allstars.de>
 */
class ConfigServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ConfigService($container->get('config'));
    }
}