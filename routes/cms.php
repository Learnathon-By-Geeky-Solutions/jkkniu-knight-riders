<?php

use App\Http\Controllers\Backend\Admin\CMS\SiteInfoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\CMSController;

Route::middleware(['auth', 'admin'])->controller(CMSController::class)->prefix('cms')->group(function () {
    Route::get('/site-info','siteInfo')->name('cms.site-info');
    Route::get('/home-banner','homeBanner')->name('cms.home.banner');
});

Route::middleware(['auth', 'admin'])->controller(SiteInfoController::class)->prefix('cms')->group(function () {
    Route::post('/site-info','update')->name('cms.site-info.update');
});