<?php
declare(strict_types=1);

namespace Shorty\Application\Config;

use Doctrine\ORM\EntityManager;
use Mezzio\Helper\UrlHelper;
use Shorty\Application\Entity\ShortUrlsEntityListener;
use Shorty\Application\Entity\ShortUrlsEntityListenerFactory;
use Shorty\Application\Helper\UrlHelperFactory;
use Shorty\Application\Service\EntityManagerFactory;

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
                    ConfigService::class           => ConfigServiceFactory::class,
                    EntityManager::class           => EntityManagerFactory::class,
                    ShortUrlsEntityListener::class => ShortUrlsEntityListenerFactory::class,
                ]
            ]
        ];
    }
}