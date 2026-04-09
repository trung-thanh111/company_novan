<?php

use App\Http\Controllers\Backend\V1\Partner\PartnerController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['admin', 'locale']], function () {

    Route::group(['prefix' => 'partner'], function () {
        Route::get('index', [PartnerController::class, 'index'])->name('partner.index');
        Route::get('create', [PartnerController::class, 'create'])->name('partner.create');
        Route::post('store', [PartnerController::class, 'store'])->name('partner.store');
        Route::get('{id}/edit', [PartnerController::class, 'edit'])->where(['id' => '[0-9]+'])->name('partner.edit');
        Route::post('{id}/update', [PartnerController::class, 'update'])->where(['id' => '[0-9]+'])->name('partner.update');
        Route::get('{id}/delete', [PartnerController::class, 'delete'])->where(['id' => '[0-9]+'])->name('partner.delete');
        Route::delete('{id}/destroy', [PartnerController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('partner.destroy');
    });

});
