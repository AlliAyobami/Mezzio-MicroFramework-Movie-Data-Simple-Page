<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\Staff;
use DomainException;
use Mezzio\ProblemDetails\Exception\CommonProblemDetailsExceptionTrait;
use Mezzio\ProblemDetails\Exception\ProblemDetailsExceptionInterface;
use Throwable;

class Emailexception extends DomainException{


    public static function existAlready(): self
    {
        $detail = sprintf(
            'Email already in database'
        );
        $e = new self($detail);
        $e->status = 404;
        $e->title  = 'Email Exists';
        $e->detail = $detail;

        return $e;
    }

}
