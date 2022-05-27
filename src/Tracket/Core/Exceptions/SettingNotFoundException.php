<?php

namespace Tracket\Core\Exceptions;

use Throwable;

class SettingNotFoundException extends \Exception
{
    public function __construct(string $name)
    {
        parent::__construct("Setting with name '{$name}' does not exist.");
    }
}
