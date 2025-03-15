<?php

use App\Http\Controllers\Backend\Admin\CMS\SiteInfoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\CMSController;
use App\Http\Controllers\Backend\Admin\CMS\HomeBannerController;

Route::middleware(['auth', 'admin'])->controller(CMSController::class)->prefix('cms')->group(function () {
    Route::get('/site-info','siteInfo')->name('cms.site-info');
});

Route::middleware(['auth', 'admin'])->controller(SiteInfoController::class)->prefix('cms')->group(function () {
    Route::post('/site-info','update')->name('cms.site-info.update');
});

Route::middleware(['auth', 'admin'])->prefix('cms/home/banner')->name('cms.home.banner.')->controller(HomeBannerController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::put('/update', 'update')->name('update');
});