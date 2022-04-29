<?php

declare(strict_types=1);

namespace App\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ValidateEmailFactory
{
    public function __invoke(ContainerInterface $container) : ValidateEmail
    {
        return new ValidateEmail($container->get(TemplateRendererInterface::class));
    }
}
