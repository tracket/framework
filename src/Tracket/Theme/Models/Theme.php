<?php

namespace Tracket\Theme\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $table = 'theme';

    protected $fillable = [
        'type',
        'current'
    ];

    public function getCurrent(): string
    {
        return $this->getAttribute('current');
    }
}
