<?php

use Tracket\Admin\Http\Controllers\CompanyController;
use Tracket\Admin\Http\Controllers\DashboardController;
use Tracket\Admin\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use Tracket\Admin\Http\Controllers\PageController;
use Tracket\Admin\Http\Controllers\SettingsController;
use Tracket\Admin\Http\Controllers\ThemeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your package. These
| routes are loaded by the AdminServiceProvider.
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/companies/{externalId}', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/companies/{externalId}', [CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/companies/{externalId}', [CompanyController::class, 'destroy'])->name('companies.destroy');

    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{externalId}', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{externalId}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{externalId}', [JobController::class, 'destroy'])->name('jobs.destroy');

    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
    Route::get('/pages/{externalId}', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{externalId}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('/pages/{externalId}', [PageController::class, 'destroy'])->name('pages.destroy');

    Route::get('/themes', [ThemeController::class, 'index'])->name('themes.index');
    Route::get('/themes/create', [ThemeController::class, 'create'])->name('themes.create');
    Route::post('/themes', [ThemeController::class, 'store'])->name('themes.store');
    Route::put('/themes/{theme}', [ThemeController::class, 'update'])->name('themes.update');
    Route::delete('/themes/{theme}', [ThemeController::class, 'destroy'])->name('themes.destroy');

    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
});
