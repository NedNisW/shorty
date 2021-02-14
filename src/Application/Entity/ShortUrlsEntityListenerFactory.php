<?php
declare(strict_types=1);

namespace Shorty\Application\Entity;

use Doctrine\ORM\EntityManager;
use RandomLib\Factory;

/**
 * Class ShortUrlsEntityListenerFactory
 *
 * @author Dennis Wandke <dennis.wandke@mainz-allstars.de>
 */
class ShortUrlsEntityListenerFactory
{
    public function __invoke(EntityManager $entityManager)
    {
        return new ShortUrlsEntityListener($entityManager, (new Factory())->getMediumStrengthGenerator());
    }
}