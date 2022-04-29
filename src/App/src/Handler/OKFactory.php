<?php

declare(strict_types=1);

namespace App\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class OKFactory
{
    public function __invoke(ContainerInterface $container) : OK
    {
        return new OK($container->get(TemplateRendererInterface::class));
    }
}
