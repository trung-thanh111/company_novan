<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\V1\Project\ProjectController;
use App\Http\Controllers\Backend\V1\Project\ProjectCatalogueController;

Route::group(['middleware' => ['admin', 'locale', 'backend_default_locale'], 'as' => 'project.'], function () {
    // Project
    Route::get('project/index', [ProjectController::class, 'index'])->name('index');
    Route::get('project/create', [ProjectController::class, 'create'])->name('create');
    Route::post('project/store', [ProjectController::class, 'store'])->name('store');
    Route::get('project/{id}/edit', [ProjectController::class, 'edit'])->where(['id' => '[0-9]+'])->name('edit');
    Route::post('project/{id}/update', [ProjectController::class, 'update'])->where(['id' => '[0-9]+'])->name('update');
    Route::get('project/{id}/delete', [ProjectController::class, 'delete'])->where(['id' => '[0-9]+'])->name('delete');
    Route::delete('project/{id}/destroy', [ProjectController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('destroy');

    // ProjectCatalogue
    Route::group(['prefix' => 'project/catalogue', 'as' => 'catalogue.'], function () {
        Route::get('index', [ProjectCatalogueController::class, 'index'])->name('index');
        Route::get('create', [ProjectCatalogueController::class, 'create'])->name('create');
        Route::post('store', [ProjectCatalogueController::class, 'store'])->name('store');
        Route::get('{id}/edit', [ProjectCatalogueController::class, 'edit'])->where(['id' => '[0-9]+'])->name('edit');
        Route::post('{id}/update', [ProjectCatalogueController::class, 'update'])->where(['id' => '[0-9]+'])->name('update');
        Route::get('{id}/delete', [ProjectCatalogueController::class, 'delete'])->where(['id' => '[0-9]+'])->name('delete');
        Route::delete('{id}/destroy', [ProjectCatalogueController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('destroy');
    });
});
