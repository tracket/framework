<?php

namespace Tracket\Core\Services;

use Illuminate\Support\Collection;
use Tracket\Core\Models\Setting;
use Tracket\Core\Repositories\SettingsRepository;

class SettingsService
{
    private SettingsRepository $settingsRepository;

    public function __construct(SettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    public function get(string $name)
    {
        return $this->settingsRepository->getByName($name)->getValue();
    }

    public function getAll(): Collection
    {
        return $this->settingsRepository->all();
    }

    public function create(array $attributes): Setting
    {
        return $this->settingsRepository->create($attributes);
    }

    public function update(string $name, $value): int
    {
        return $this->settingsRepository->update($name, $value);
    }

    public function bulkUpdate(array $settings): bool
    {
        foreach ($settings as $name => $value) {
            $this->settingsRepository->update($name, $value);
        }

        return true;
    }
}
