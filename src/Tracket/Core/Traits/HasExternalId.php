<?php

namespace Tracket\Core\Traits;

use Illuminate\Support\Str;

trait HasExternalId
{
    private static int $externalIdLength = 8;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model)
        {
            if (!$model->hasExternalId()) {
                $model->setAttribute('external_id', Str::random(static::$externalIdLength));
            }
        });
    }

    public function getExternalId(): ?string
    {
        return $this->getAttribute('external_id');
    }

    public function hasExternalId(): bool
    {
        return $this->getExternalId() !== null;
    }
}
