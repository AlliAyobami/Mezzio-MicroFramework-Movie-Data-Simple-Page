<?php

declare(strict_types=1);

namespace App\UpperClasses;

class PostTOHtmlValueConverter
{
    public function convert(array $values)
    {
        $results = [];
        foreach ($values as $value) {
            $results[] = htmlspecialchars($value, ENT_HTML5, 'UTF-8');
        }
        return $results;
    }
}
