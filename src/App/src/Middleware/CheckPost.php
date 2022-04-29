<?php

declare(strict_types=1);

namespace App\Middleware;

use Laminas\Diactoros\Response\JsonResponse;
use Assert\Assertion;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Whoops\Handler\Handler;

class CheckPost implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $post = $request->getParsedBody();
        Assertion::notEmpty($post['firstName'],'First Name cannot be empty');
        Assertion::notEmpty($post['lastName'],'Last Name cannot be empty');

        return $handler->handle($request);
    }
}
