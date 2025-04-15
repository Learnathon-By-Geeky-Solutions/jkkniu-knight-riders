<?php

use App\Http\Controllers\Backend\Admin\CMS\DepartmentController;
use App\Http\Controllers\Backend\Admin\CMS\SiteInfoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\CMSController;
use App\Http\Controllers\Backend\Admin\CMS\HomeBannerController;
use App\Http\Controllers\Backend\Admin\CMS\HomeBannerWhyChooseUsController;
use App\Http\Controllers\Backend\Admin\CMS\WhyChooseUsController;

Route::middleware(['auth', 'admin'])->controller(DepartmentController::class)->prefix('medical')->group(function () {
    Route::get('/departments','index')->name('medical.departments.index'); 
});


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

Route::middleware(['auth', 'admin'])->prefix('cms/home/banner/why-choose-us')->name('cms.home.banner.why-choose-us.')->controller(HomeBannerWhyChooseUsController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::put('/update', 'update')->name('update');
});


// kjhlkj
Route::middleware(['auth', 'admin'])->controller(WhyChooseUsController::class)->group(function () {
    Route::get('/cms/why-choose-us','whyChooseUs')->name('cms.whyChooseUs');
    Route::get('/cms/home-why-choose-us/create','create')->name('cms.home.why-choose-us.create');
    Route::post('/cms/home-why-choose-us/store','store')->name('cms.home.why-choose-us.store');
    Route::get('/cms/home-why-choose-us/edit/{id}','edit')->name('cms.home.why-choose-us.edit');
    Route::put('/cms/home-why-choose-us/update/{id}','update')->name('cms.home.why-choose-us.update');
    Route::delete('/cms/home-why-choose-us/destroy/{id}','destroy')->name('cms.home.why-choose-us.destroy');
    Route::get('/cms/home-why-choose-us/status/{id}','status')->name('cms.home.why-choose-us.status');
});