<?php

declare(strict_types=1);

namespace App\Handler;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Laminas\Validator;

class ValidateEmail extends Newsletter implements RequestHandlerInterface
{
    // /**
    //  * @var TemplateRendererInterface
    //  */
  private $post;

    public function __construct()
    {
    }

    public function isValid(Newsletter $post){
        $this->post=$post;  
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    { 
        $post = $this->Newsletter->getParsedBody(newsletter::class)->$post;
        if (filter_var($post, FILTER_VALIDATE_EMAIL)) {
            return $handler->handle($request->withAttribute(newsletter::class, $post));
          }
            // 'app::validate-email',
            // [] // parameters to pass to template
    }
}
