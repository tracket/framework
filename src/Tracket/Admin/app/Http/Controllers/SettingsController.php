<?php

namespace Tracket\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Tracket\Admin\Http\Requests\Settings\UpdateSettingsRequest;
use Tracket\Core\Services\SettingsService;

class SettingsController extends Controller
{
    protected SettingsService $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    public function edit(Request $request)
    {
        $settings = $this->settingsService->getAll();

        return view('admin::settings.edit', [
            'settings' => $settings
        ]);
    }

    public function update(UpdateSettingsRequest $request)
    {
        $this->settingsService->bulkUpdate($request->validated());

        return redirect(route('admin.settings.edit'))->with('success-message', 'Settings updated successfully.');
    }
}
