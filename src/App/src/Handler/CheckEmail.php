<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

/**
 * Class CheckEmail
 * @package App\Handler
 */

class CheckEmail implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $post = $request->getParsedBody();
        $email = $this->objectManager->getRepository(Newsletter::class)->findOneBy(['email']);
        if(!$email){
            return $handler->handle($request->withAttribute(Newsletter::class, $email));
        }
        throw EmailException::existAlready();
    }
    }
}
