<?php

namespace Tracket\Core\Repositories;

use Hamcrest\Core\Set;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Tracket\Company\Exceptions\CompanyNotFoundException;
use Tracket\Company\Exceptions\JobNotFoundException;
use Tracket\Company\Models\Company;
use Tracket\Core\Exceptions\SettingNotFoundException;
use Tracket\Core\Models\Setting;
use Tracket\Job\Models\Job;

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
            throw new SettingNotFoundException($name);
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
