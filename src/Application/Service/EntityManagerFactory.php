<?php
declare(strict_types=1);

namespace Shorty\Application\Service;

use Cake\Core\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\ORM\Tools\Setup;
use Shorty\Application\Config\ConfigService;

/**
 * Class EntityManagerFactory
 *
 * @author Dennis Wandke <dennis.wandke@mainz-allstars.de>
 */
class EntityManagerFactory
{
    public function __invoke(ConfigService $configService, EntityResolver $entityResolver)
    {
        $db = $configService->getByPath('database');

        $connection = [
            'driver'   => 'pdo_mysql',
            'host'     => $db['host'],
            'port'     => $db['port'],
            'user'     => $db['username'],
            'password' => $db['password'],
            'dbname'   => $db['name']
        ];

        $config = Setup::createAnnotationMetadataConfiguration(
            [realpath(__DIR__ . '/../Entity')],
            $configService->isDevelop()
        );

        $config->setEntityListenerResolver($entityResolver);

        return EntityManager::create($connection, $config);
    }
}