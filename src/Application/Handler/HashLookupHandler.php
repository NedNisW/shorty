<?php
declare(strict_types=1);

namespace Shorty\Application\Handler;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Shorty\Application\Service\ShortUrlService;

/**
 * Class HashLookupHandler
 *
 * @author Dennis Wandke <dennis.wandke@mainz-allstars.de>
 */
class HashLookupHandler implements RequestHandlerInterface
{
    /**
     * @var ShortUrlService
     */
    private ShortUrlService $shortUrlService;

    /**
     * HashLookupHandler constructor.
     *
     * @param ShortUrlService $shortUrlService
     */
    public function __construct(ShortUrlService $shortUrlService)
    {
        $this->shortUrlService = $shortUrlService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $hash = $request->getAttribute('hash');
        $shortUrl = $this->shortUrlService->findByHash($hash);
        if ($shortUrl === null) {
            return new Response('NOT FOUND', 404);
        }

        $this->shortUrlService->increaseRequests($shortUrl);

        return new Response\RedirectResponse($shortUrl->getTarget());
    }


}