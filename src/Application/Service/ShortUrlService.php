<?php
declare(strict_types=1);

namespace Shorty\Application\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Mezzio\Helper\ServerUrlHelper;
use Mezzio\Helper\UrlHelper;
use Shorty\Application\Entity\ShortUrl;

/**
 * Class ShortUrlService
 *
 * @author Dennis Wandke <dennis.wandke@mainz-allstars.de>
 */
class ShortUrlService
{
    /**
     * @var EntityManager
     */
    private EntityManager $entityManager;

    private UrlHelper $urlHelper;
    /**
     * @var ServerUrlHelper
     */
    private ServerUrlHelper $serverUrlHelper;

    /**
     * ShortUrlService constructor.
     *
     * @param EntityManager   $entityManager
     * @param UrlHelper       $urlHelper
     * @param ServerUrlHelper $serverUrlHelper
     */
    public function __construct(EntityManager $entityManager, UrlHelper $urlHelper, ServerUrlHelper $serverUrlHelper)
    {
        $this->entityManager = $entityManager;
        $this->urlHelper = $urlHelper;
        $this->serverUrlHelper = $serverUrlHelper;
    }

    public function findByHash(string $hash): ?ShortUrl
    {
        /** @var ShortUrl $shortUrl */
        $shortUrl = $this->getRepository()->findOneBy([ShortUrl::COL_HASH => $hash]);

        return $shortUrl;
    }

    public function increaseRequests(ShortUrl $shortUrl): void
    {
        $shortUrl->setRequests($shortUrl->getRequests() + 1);
        $this->entityManager->flush($shortUrl);
    }

    public function receiveUri(ShortUrl $shortUrl): string
    {
        return $this->serverUrlHelper->generate(
            $this->urlHelper->generate('hash_lookup', ['hash' => $shortUrl->getHash()])
        );
    }

    private function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(ShortUrl::class);
    }
}