<?php
declare(strict_types=1);

namespace Shorty\Application\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use RandomLib\Generator;

/**
 * Class ShortUrlsEntityListener
 *
 * @author Dennis Wandke <dennis.wandke@mainz-allstars.de>
 */
class ShortUrlsEntityListener
{
    private const ALLOWED_SHORT_CHARS = '023456789abcdefghkmnorstuvwxyz';
    private const SHORT_LENGTH = 5;
    private const HASH_GENERATION_MAX_TRIES = 6;

    /**
     * @var EntityManager
     */
    private EntityManager $entityManager;
    /**
     * @var Generator
     */
    private Generator $hashGenerator;

    /**
     * ShortUrlsEntityListener constructor.
     *
     * @param EntityManager $entityManager
     * @param Generator     $hashGenerator
     */
    public function __construct(EntityManager $entityManager, Generator $hashGenerator)
    {
        $this->entityManager = $entityManager;
        $this->hashGenerator = $hashGenerator;
    }

    public function prePersist(ShortUrl $shortUrl, LifecycleEventArgs $event): void
    {
        $try = 0;
        do {
            $hash = $this->hashGenerator->generateString(self::SHORT_LENGTH, self::ALLOWED_SHORT_CHARS);
            $occur = $this->entityManager->getRepository(ShortUrl::class)->count(['hash' => $hash]);
            $try++;
        } while ($occur > 0 && $try < self::HASH_GENERATION_MAX_TRIES);

        if ($occur > 0) {
            throw new \DomainException('Failed to generate short url hash');
        }

        $shortUrl->applyHash($hash);
    }
}