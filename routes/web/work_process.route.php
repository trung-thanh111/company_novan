<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\V1\WorkProcess\WorkProcessController;

Route::group(['middleware' => ['locale', 'admin', 'backend_default_locale']], function () {
    Route::get('work-process/index', [WorkProcessController::class, 'index'])->name('work_process.index');
    Route::get('work-process/create', [WorkProcessController::class, 'create'])->name('work_process.create');
    Route::post('work-process/store', [WorkProcessController::class, 'store'])->name('work_process.store');
    Route::get('work-process/{id}/edit', [WorkProcessController::class, 'edit'])->where(['id' => '[0-9]+'])->name('work_process.edit');
    Route::put('work-process/{id}/update', [WorkProcessController::class, 'update'])->where(['id' => '[0-9]+'])->name('work_process.update');
    Route::get('work-process/{id}/delete', [WorkProcessController::class, 'delete'])->where(['id' => '[0-9]+'])->name('work_process.delete');
    Route::delete('work-process/{id}/destroy', [WorkProcessController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('work_process.destroy');
});
