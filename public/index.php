<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use App\Handler\MoviesFactory;
use App\Handler\Movies;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/**
 * Self-called anonymous function that creates its own scope and keep the global namespace clean.
 */

(function () {
  /** @var \Psr\Container\ContainerInterface $container */
  $container = require 'config/container.php';

  /** @var \Mezzio\Application $app */
  $app = $container->get(
    Application::class
  );
  $factory = $container->get(
    MiddlewareFactory::class
  );
  (require 'config/pipeline.php')($app, $factory, $container);
  (require 'config/routes.php')($app, $factory, $container);
  $app->run();
})();
