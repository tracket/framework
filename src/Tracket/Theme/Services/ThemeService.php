<?php

namespace Tracket\Theme\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\View\View;
use Tracket\Core\Helpers\FileHelper;
use Tracket\Core\Services\SettingsService;
use Tracket\Theme\Exceptions\InvalidFileExtensionException;
use Tracket\Theme\Repositories\ThemeRepository;
use ZipArchive;

class ThemeService
{
    private ThemeRepository $themeRepository;
    private SettingsService $settingsService;

    public function __construct(ThemeRepository $themeRepository, SettingsService $settingsService)
    {
        $this->themeRepository = $themeRepository;
        $this->settingsService = $settingsService;
    }

    public function upload(UploadedFile $file): bool
    {
        if (!str_ends_with($file->getClientOriginalName(), '.zip')) {
            throw new InvalidFileExtensionException($file->getClientOriginalName());
        }

        $zip = new ZipArchive();
        $zip->open($file->getPathname());
        $zip->extractTo(base_path("themes/"));
        $zip->close();

        return true;
    }

    public function delete(string $theme): bool
    {
        return FileHelper::removeDirectory(base_path('themes' . DIRECTORY_SEPARATOR . $theme));
    }

    public function updateCurrent(string $theme): bool
    {
        FileHelper::removeSymlink(
            base_path('public' . DIRECTORY_SEPARATOR . $this->getCurrentThemeDirectory()),
        );
        FileHelper::createSymlink(
            base_path('themes' . DIRECTORY_SEPARATOR . $theme . DIRECTORY_SEPARATOR . 'public'),
            base_path('public' . DIRECTORY_SEPARATOR . $theme),
        );
        return $this->themeRepository->updateCurrent($theme);
    }

    public function getCurrentThemeDirectory(): string
    {
        return $this->themeRepository->getCurrent('web');
    }

    public function view(string $template, array $attributes = []): View
    {
        $templatePath = $this->getTemplatePath($template);

        // TODO: Check that theme directory exists, otherwise throw error

        $settings = $this->settingsService->getAll()->mapWithKeys(function ($item, $key) {
            return [$item['name'] => $item['value']];
        });

        $attributes = array_merge($attributes, [
            'settings' => $settings
        ]);

        return view($templatePath, $attributes);
    }

    private function getTemplatePath(string $template): string
    {
        return "theme::{$this->getCurrentThemeDirectory()}.{$template}";
    }

    public function getThemes(): array
    {
        $themeDirectories = collect(scandir(base_path('themes')));
        $themeDirectories = $themeDirectories->filter(function ($value, $key) {
            return !($value === '.' || $value === '..');
        });

        $themes = [];
        foreach ($themeDirectories as $themeDirectory) {
            $themes[] = json_decode(file_get_contents(base_path("themes/{$themeDirectory}/theme.json")), true);
        }

        return $themes;
    }
}
