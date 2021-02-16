<?php
declare(strict_types=1);

namespace Shorty\Application\Handler;

use Laminas\Diactoros\Response;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class LandingPageHandler
 *
 * @author Dennis Wandke <dennis.wandke@mainz-allstars.de>
 */
class LandingPageHandler implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private TemplateRendererInterface $renderer;

    /**
     * LandingPageHandler constructor.
     *
     * @param TemplateRendererInterface $renderer
     */
    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response\HtmlResponse(
            $this->renderer->render('index.html.twig')
        );
    }

}