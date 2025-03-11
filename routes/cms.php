<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\CMSController;

Route::middleware(['auth', 'admin'])->controller(CMSController::class)->prefix('cms')->group(function () {
    Route::get('/site-info','siteInfo')->name('cms.site-info');
    Route::get('/home-banner','homeBanner')->name('cms.home.banner');
});