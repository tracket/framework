<?php

namespace Tracket\Theme\Exceptions;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

class InvalidFileExtensionException extends \Exception
{
    public function __construct(string $filename)
    {
        parent::__construct($filename . ' is not a .zip file');
    }
}
