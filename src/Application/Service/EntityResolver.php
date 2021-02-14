<?php
declare(strict_types=1);

namespace Shorty\Application\Service;

use Doctrine\ORM\Mapping\EntityListenerResolver;
use Psr\Container\ContainerInterface;

/**
 * Class EntityResolver
 *
 * @author Dennis Wandke <dennis.wandke@mainz-allstars.de>
 */
class EntityResolver implements EntityListenerResolver
{
    /**
     * array
     */
    private $overrides = [];

    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    function clear($className = null)
    {
        unset($this->overrides[$className]);
        return;
    }

    function resolve($className)
    {
        return $this->container->get($className);
    }

    function register($object)
    {
        $this->overrides[get_class($object)] = $object;
    }

}