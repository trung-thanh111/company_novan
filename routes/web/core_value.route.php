<?php

use App\Http\Controllers\Backend\V1\CoreValue\CoreValueController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['admin', 'locale']], function () {

    Route::group(['prefix' => 'core-value'], function () {
        Route::get('index', [CoreValueController::class, 'index'])->name('core_value.index');
        Route::get('create', [CoreValueController::class, 'create'])->name('core_value.create');
        Route::post('store', [CoreValueController::class, 'store'])->name('core_value.store');
        Route::get('{id}/edit', [CoreValueController::class, 'edit'])->where(['id' => '[0-9]+'])->name('core_value.edit');
        Route::post('{id}/update', [CoreValueController::class, 'update'])->where(['id' => '[0-9]+'])->name('core_value.update');
        Route::get('{id}/delete', [CoreValueController::class, 'delete'])->where(['id' => '[0-9]+'])->name('core_value.delete');
        Route::delete('{id}/destroy', [CoreValueController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('core_value.destroy');
    });

});
