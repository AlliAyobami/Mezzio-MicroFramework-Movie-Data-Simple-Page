<?php

declare(strict_types=1);

namespace App\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class NewsletterFactory
{
    public function __invoke(ContainerInterface $container) : Newsletter
    {
        return new Newsletter($container->get(TemplateRendererInterface::class));
    }
}
