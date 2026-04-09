<?php   
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\V1\Company\ServiceCatalogueController;
use App\Http\Controllers\Backend\V1\Company\ServiceController;

Route::group(['middleware' => ['admin','locale','backend_default_locale']], function () {

    Route::group(['prefix' => 'service/catalogue'], function () {
        Route::get('index', [ServiceCatalogueController::class, 'index'])->name('service.catalogue.index');
        Route::get('create', [ServiceCatalogueController::class, 'create'])->name('service.catalogue.create');
        Route::post('store', [ServiceCatalogueController::class, 'store'])->name('service.catalogue.store');
        Route::get('{id}/edit', [ServiceCatalogueController::class, 'edit'])->where(['id' => '[0-9]+'])->name('service.catalogue.edit');
        Route::post('{id}/update', [ServiceCatalogueController::class, 'update'])->where(['id' => '[0-9]+'])->name('service.catalogue.update');
        Route::get('{id}/delete', [ServiceCatalogueController::class, 'delete'])->where(['id' => '[0-9]+'])->name('service.catalogue.delete');
        Route::delete('{id}/destroy', [ServiceCatalogueController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('service.catalogue.destroy');
    });

    Route::group(['prefix' => 'service'], function () {
        Route::get('index', [ServiceController::class, 'index'])->name('service.index');
        Route::get('create', [ServiceController::class, 'create'])->name('service.create');
        Route::post('store', [ServiceController::class, 'store'])->name('service.store');
        Route::get('{id}/edit', [ServiceController::class, 'edit'])->where(['id' => '[0-9]+'])->name('service.edit');
        Route::post('{id}/update', [ServiceController::class, 'update'])->where(['id' => '[0-9]+'])->name('service.update');
        Route::get('{id}/delete', [ServiceController::class, 'delete'])->where(['id' => '[0-9]+'])->name('service.delete');
        Route::delete('{id}/destroy', [ServiceController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('service.destroy');
    });

});
