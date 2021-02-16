<?php
declare(strict_types=1);

namespace Shorty\Application\Handler;

use Doctrine\ORM\EntityManager;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Shorty\Application\Entity\ShortUrl;
use Shorty\Application\Service\ShortUrlService;

/**
 * Class NewUrlHandler
 *
 * @author Dennis Wandke <dennis.wandke@mainz-allstars.de>
 */
class NewUrlHandler implements RequestHandlerInterface
{
    /**
     * @var EntityManager
     */
    private EntityManager $entityManager;
    /**
     * @var TemplateRendererInterface
     */
    private TemplateRendererInterface $renderer;
    /**
     * @var ShortUrlService
     */
    private ShortUrlService $shortUrlService;

    /**
     * NewUrlHandler constructor.
     *
     * @param EntityManager             $entityManager
     * @param ShortUrlService           $shortUrlService
     * @param TemplateRendererInterface $renderer
     */
    public function __construct(
        EntityManager $entityManager,
        ShortUrlService $shortUrlService,
        TemplateRendererInterface $renderer
    ) {
        $this->entityManager = $entityManager;
        $this->renderer = $renderer;
        $this->shortUrlService = $shortUrlService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $target = $request->getParsedBody()['target'];
        if (empty($target) === true) {
            return new JsonResponse(['message' => 'Target must not be empty!'], 400);
        }

        $shortUrl = new ShortUrl();
        $shortUrl->setTarget($target);

        $this->entityManager->persist($shortUrl);
        $this->entityManager->flush();

        return new JsonResponse(
            [
                'target' => $target,
                'short' => $this->shortUrlService->receiveUri($shortUrl)
            ]
        );
    }

}