<?php

use App\Http\Controllers\Backend\V1\Achievement\AchievementController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['admin', 'locale']], function () {

    Route::group(['prefix' => 'achievement'], function () {
        Route::get('index', [AchievementController::class, 'index'])->name('achievement.index');
        Route::get('create', [AchievementController::class, 'create'])->name('achievement.create');
        Route::post('store', [AchievementController::class, 'store'])->name('achievement.store');
        Route::get('{id}/edit', [AchievementController::class, 'edit'])->where(['id' => '[0-9]+'])->name('achievement.edit');
        Route::post('{id}/update', [AchievementController::class, 'update'])->where(['id' => '[0-9]+'])->name('achievement.update');
        Route::get('{id}/delete', [AchievementController::class, 'delete'])->where(['id' => '[0-9]+'])->name('achievement.delete');
        Route::delete('{id}/destroy', [AchievementController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('achievement.destroy');
    });

});
