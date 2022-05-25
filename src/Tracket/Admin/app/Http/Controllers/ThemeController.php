<?php

namespace Tracket\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Tracket\Admin\Http\Requests\Themes\StoreThemeRequest;
use Tracket\Theme\Services\ThemeService;

class ThemeController extends Controller
{
    protected ThemeService $themeService;

    public function __construct(ThemeService $themeService)
    {
        $this->themeService = $themeService;
    }

    public function index(Request $request)
    {
        $themes  = $this->themeService->getThemes();
        $current = $this->themeService->getCurrentThemeDirectory();
        return view('admin::themes.index', [
            'themes'  => $themes,
            'current' => $current
        ]);
    }

    public function create(Request $request)
    {
        return view('admin::themes.edit');
    }

    public function store(StoreThemeRequest $request)
    {
        $this->themeService->upload($request->file('theme'));

        return redirect(route('admin.themes.index'))->with('success-message', 'Theme uploaded successfully.');
    }

    public function update(Request $request, $theme)
    {
        $this->themeService->updateCurrent($theme);

        return redirect(route('admin.themes.index'))->with('success-message', 'Theme updates successfully.');
    }

    public function destroy(Request $request, $theme)
    {
        $this->themeService->delete($theme);

        return redirect(route('admin.themes.index'))->with('success-message', 'Theme deleted successfully.');
    }
}
