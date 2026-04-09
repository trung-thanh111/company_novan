<?php

use App\Http\Controllers\Backend\V1\Faq\FaqController;
use App\Http\Controllers\Backend\V1\Faq\FaqCatalogueController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['admin', 'locale']], function () {

    Route::group(['prefix' => 'faq/catalogue'], function () {
        Route::get('index', [FaqCatalogueController::class, 'index'])->name('faq.catalogue.index');
        Route::get('create', [FaqCatalogueController::class, 'create'])->name('faq.catalogue.create');
        Route::post('store', [FaqCatalogueController::class, 'store'])->name('faq.catalogue.store');
        Route::get('{id}/edit', [FaqCatalogueController::class, 'edit'])->where(['id' => '[0-9]+'])->name('faq.catalogue.edit');
        Route::post('{id}/update', [FaqCatalogueController::class, 'update'])->where(['id' => '[0-9]+'])->name('faq.catalogue.update');
        Route::get('{id}/delete', [FaqCatalogueController::class, 'delete'])->where(['id' => '[0-9]+'])->name('faq.catalogue.delete');
        Route::delete('{id}/destroy', [FaqCatalogueController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('faq.catalogue.destroy');
    });

    Route::group(['prefix' => 'faq'], function () {
        Route::get('index', [FaqController::class, 'index'])->name('faq.index');
        Route::get('create', [FaqController::class, 'create'])->name('faq.create');
        Route::post('store', [FaqController::class, 'store'])->name('faq.store');
        Route::get('{id}/edit', [FaqController::class, 'edit'])->where(['id' => '[0-9]+'])->name('faq.edit');
        Route::post('{id}/update', [FaqController::class, 'update'])->where(['id' => '[0-9]+'])->name('faq.update');
        Route::get('{id}/delete', [FaqController::class, 'delete'])->where(['id' => '[0-9]+'])->name('faq.delete');
        Route::delete('{id}/destroy', [FaqController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('faq.destroy');
    });

});
