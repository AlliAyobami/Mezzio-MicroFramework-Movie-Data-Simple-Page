<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use App\UpperClasses\PostTOHtmlValueConverter;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Template\TemplateRendererInterface;

class Newsletter implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */

    private $renderer;

    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $post = $request->getParsedBody();
        // $postToHtmlValueConverter = new PostTOHtmlValueConverter();
        // $posts = $postToHtmlValueConverter->convert($request->getParsedBody());
        // foreach ($posts as $post);
        // $decode = json_decode($post);
        // return new JsonResponse(var_dump($decode));
        return new HtmlResponse($this->renderer->render(
            'app::newsletter'
           
        ));
    }
}