<?php

namespace Tracket\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function getValue()
    {
        return $this->getAttribute('value');
    }

    public function getType(): string
    {
        return $this->getAttribute('type');
    }

    public function getDescription(): string
    {
        return $this->getAttribute('description');
    }
}
