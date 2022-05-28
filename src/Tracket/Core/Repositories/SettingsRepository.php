<?php

namespace Tracket\Core\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Tracket\Core\Exceptions\ModelNotFoundException;
use Tracket\Core\Models\Setting;

class SettingsRepository
{
    private function query(): Builder
    {
        return Setting::query();
    }

    public function all(): Collection
    {
        return $this->query()->orderBy('id', 'asc')->get();
    }

    public function getByName(string $name): Setting
    {
        $setting = $this->query()->where('name', $name)->get()->first();

        if (!$setting) {
            throw new ModelNotFoundException(Setting::class, 'name', $name);
        }

        return $setting;
    }

    public function create(array $attributes): Setting
    {
        $setting = new Setting();
        $setting->fill($attributes);
        $setting->save();
        return $setting;
    }

    public function update(string $name, $value): int
    {
        return $this->query()->where('name', $name)->update(['value' => $value]);
    }
}
