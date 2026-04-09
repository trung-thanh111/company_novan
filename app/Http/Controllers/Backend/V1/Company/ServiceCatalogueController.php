<?php

namespace App\Http\Controllers\Backend\V1\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\V2\Interfaces\Company\ServiceCatalogueServiceInterface;
use App\Http\Requests\Company\StoreServiceCatalogueRequest;
use App\Http\Requests\Company\UpdateServiceCatalogueRequest;
use App\Models\Language;
use App\Classes\Nestedsetbie;

/**
 * Class ServiceCatalogueController
 * @package App\Http\Controllers\Backend\V1\Company
 */
class ServiceCatalogueController extends Controller
{
    protected $serviceCatalogue;
    protected $language;

    public function __construct(
        ServiceCatalogueServiceInterface $serviceCatalogue
    ) {
        $this->serviceCatalogue = $serviceCatalogue;
        $this->language = $this->currentLanguage();
    }

    public function index(Request $request) {
        $this->authorize('modules', 'service.catalogue.index');
        $serviceCatalogues = $this->serviceCatalogue->pagination($request);
        $thisLanguage = $this->language;
        $config = [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'model' => 'ServiceCatalogue',
            'seo' => __('messages.serviceCatalogue')
        ];
        $template = 'backend.company.catalogue.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'serviceCatalogues',
            'thisLanguage'
        ));
    }

    public function create() {
        $this->authorize('modules', 'service.catalogue.create');
        $config = $this->config();
        $dropdown = $this->nestedsetbie()->Dropdown();
        $template = 'backend.company.catalogue.store';
        $config['method'] = 'create';
        $thisLanguage = $this->language;
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'dropdown',
            'thisLanguage'
        ));
    }

    public function store(StoreServiceCatalogueRequest $request) {
        if ($this->serviceCatalogue->save($request, 'store')) {
            $this->nestedsetbie()->Get();
            return redirect()->route('service.catalogue.index')->with('success', 'Thêm mới bản ghi thành công');
        }
        return redirect()->route('service.catalogue.index')->with('error', 'Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id) {
        $this->authorize('modules', 'service.catalogue.update');
        $serviceCatalogue = $this->serviceCatalogue->findById($id);
        $config = $this->config();
        $dropdown = $this->nestedsetbie()->Dropdown();
        $template = 'backend.company.catalogue.store';
        $config['method'] = 'edit';
        $thisLanguage = $this->language;
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'serviceCatalogue',
            'dropdown',
            'thisLanguage'
        ));
    }

    public function update($id, UpdateServiceCatalogueRequest $request) {
        if ($this->serviceCatalogue->save($request, 'update', $id)) {
            $this->nestedsetbie()->Get();
            return redirect()->route('service.catalogue.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->route('service.catalogue.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id) {
        $this->authorize('modules', 'service.catalogue.delete');
        $serviceCatalogue = $this->serviceCatalogue->findById($id);
        $template = 'backend.company.catalogue.delete';
        $config['seo'] = __('messages.serviceCatalogue');
        $config['method'] = 'delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'serviceCatalogue',
            'config',
        ));
    }

    public function destroy($id) {
        if ($this->serviceCatalogue->destroy($id)) {
            $this->nestedsetbie()->Get();
            return redirect()->route('service.catalogue.index')->with('success', 'Xóa bản ghi thành công');
        }
        return redirect()->route('service.catalogue.index')->with('error', 'Xóa bản ghi không thành công. Hãy thử lại');
    }

    private function config() {
        return [
            'js' => [
                'backend/plugins/ckfinder/ckfinder.js',
                'backend/library/finder.js',
                'backend/library/seo.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ],
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'model' => 'ServiceCatalogue',
            'seo' => __('messages.serviceCatalogue'),
        ];
    }

    private function nestedsetbie() {
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
