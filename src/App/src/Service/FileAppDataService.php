<?php
namespace App\Service;
class FileAppDataService
{
public function __invoke()
{
return include __DIR__ . '/../../../../data/MovieData.php';
}
}