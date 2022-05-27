<?php

namespace Tracket\Theme\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Tracket\Theme\Models\Theme;

class ThemeRepository
{
    private function query(): Builder
    {
        return Theme::query();
    }

    public function getCurrent(string $type): string
    {
        return $this->query()
            ->where('type', $type)
            ->first()
            ->getCurrent();
    }

    public function create($type, $current): Theme
    {
        $theme = new Theme();
        $theme->fill([
            'type'    => $type,
            'current' => $current
        ]);
        $theme->save();
        return $theme;
    }

    public function updateCurrent(string $theme): bool
    {
        return DB::table('theme')
            ->where('type', 'web')
            ->update(['current' => $theme]);
    }
}
