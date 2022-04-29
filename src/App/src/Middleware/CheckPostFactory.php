<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;

class CheckPostFactory
{
    public function __invoke(ContainerInterface $container) : CheckPost
    {
        return new CheckPost();
    }
}
