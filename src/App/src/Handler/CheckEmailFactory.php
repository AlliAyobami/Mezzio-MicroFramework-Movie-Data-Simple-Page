<?php

declare(strict_types=1);

namespace App\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class CheckEmailFactory
{
    public function __invoke(ContainerInterface $container) : CheckEmail
    {
        return new CheckEmail($container->get(TemplateRendererInterface::class));
    }
}
