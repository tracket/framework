<?php

namespace Tracket\Core\Exceptions;

use Throwable;

class ModelNotFoundException extends \Exception
{
    public function __construct(string $type, string $attribute, string $id)
    {
        parent::__construct("{$type} with {$attribute} '{$id}' does not exist.");
    }
}
