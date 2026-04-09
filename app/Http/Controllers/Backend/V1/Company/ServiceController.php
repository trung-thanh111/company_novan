<?php

namespace App\Http\Controllers\Backend\V1\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\V2\Interfaces\Company\ServiceServiceInterface;
use App\Http\Requests\Company\StoreServiceRequest;
use App\Http\Requests\Company\UpdateServiceRequest;
use App\Models\ServiceCatalogue;
use App\Models\Language;
use App\Classes\Nestedsetbie;

class ServiceController extends Controller
{
    protected $service;
    protected $language;

    public function __construct(
        ServiceServiceInterface $service
    ) {
        $this->service = $service;
        $this->language = $this->currentLanguage();
    }

    public function index(Request $request) {
        $this->authorize('modules', 'service.index');
        $services = $this->service->pagination($request);
        $thisLanguage = $this->language;
        $dropdown = $this->nestedset()->Dropdown();
        $config = [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'model' => 'Service',
            'seo' => __('messages.service')
        ];
        $template = 'backend.company.service.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'services',
            'thisLanguage',
            'dropdown'
        ));
    }

    public function create() {
        $this->authorize('modules', 'service.create');
        $config = $this->configData('create');
        $dropdown = $this->nestedset()->Dropdown();
        $template = 'backend.company.service.store';
        $thisLanguage = $this->language;
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'dropdown',
            'thisLanguage'
        ));
    }

    public function store(StoreServiceRequest $request) {
        $response = $this->service->save($request, 'store');
        return $this->handleActionResponse($response, $request, 'Thêm mới bản ghi thành công', 'service.index');
    }

    public function edit($id) {
        $this->authorize('modules', 'service.edit');
        $service = $this->service->findById($id);
        $config = $this->configData('edit');
        $dropdown = $this->nestedset()->Dropdown();
        $template = 'backend.company.service.store';
        $thisLanguage = $this->language;
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'dropdown',
            'service',
            'thisLanguage'
        ));
    }

    public function update($id, UpdateServiceRequest $request) {
        $response = $this->service->save($request, 'update', $id);
        return $this->handleActionResponse($response, $request, 'Cập nhật bản ghi thành công', 'service.index');
    }

    public function delete($id) {
        $this->authorize('modules', 'service.delete');
        $service = $this->service->findById($id);
        $config = [
            'model' => 'Service',
            'seo' => __('messages.service')
        ];
        $template = 'backend.company.service.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'service'
        ));
    }

    public function destroy($id, Request $request) {
        $response = $this->service->destroy($id);
        return $this->handleActionResponse($response, $request, 'Xóa bản ghi thành công', 'service.index');
    }

    private function configData($action) {
        return [
            'js' => [
                'backend/plugins/ckeditor/ckeditor.js',
                'backend/library/finder.js',
                'backend/library/seo.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ],
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'method' => $action,
            'model' => 'Service',
            'seo' => __('messages.service')
        ];
    }

    private function nestedset() {
        return new Nestedsetbie([
            'table' => 'service_catalogues',
            'foreignkey' => 'service_catalogue_id',
            'language_id' => $this->language,
        ]);
    }

    private function currentLanguage() {
        $locale = app()->getLocale();
        $language = Language::where('canonical', $locale)->first();
        return $language->id ?? 1;
    }
}
