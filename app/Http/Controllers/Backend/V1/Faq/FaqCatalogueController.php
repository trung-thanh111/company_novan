<?php

namespace App\Http\Controllers\Backend\V1\Faq;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Faq\StoreFaqCatalogueRequest;
use App\Http\Requests\Faq\UpdateFaqCatalogueRequest;
use App\Services\V2\Interfaces\Faq\FaqCatalogueServiceInterface as FaqCatalogueService;
use App\Models\Language;

class FaqCatalogueController extends Controller
{
    private $service;
    protected $language;

    public function __construct(
        FaqCatalogueService $service
    ) {
        $this->service = $service;
        $this->language = $this->currentLanguage();
    }

    public function index(Request $request)
    {
        $this->authorize('modules', 'faq.catalogue.index');
        $records = $this->service->pagination($request);
        $thisLanguage = $this->language;
        $config = [
            ...$this->config(),
            'extendJs' => true
        ];
        $template = 'backend.faq.catalogue.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'records',
            'thisLanguage'
        ));
    }

    public function create()
    {
        $this->authorize('modules', 'faq.catalogue.create');
        $dropdown = $this->nestedset()->Dropdown();
        $thisLanguage = $this->language;
        $config = [
            ...$this->config(),
            'method' => 'create',
            'extendJs' => true
        ];
        $template = 'backend.faq.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'dropdown',
            'thisLanguage'
        ));
    }

    public function edit($id)
    {
        $this->authorize('modules', 'faq.catalogue.update');
        if (!$record = $this->service->findById($id)) {
            return redirect()->route('faq.catalogue.index')->with('error', 'Bản ghi không tồn tại');
        }
        $dropdown = $this->nestedset()->Dropdown();
        $thisLanguage = $this->language;
        $config = [
            ...$this->config(),
            'method' => 'edit',
            'extendJs' => true
        ];
        $template = 'backend.faq.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'record',
            'dropdown',
            'thisLanguage'
        ));
    }

    public function store(StoreFaqCatalogueRequest $request)
    {
        $this->authorize('modules', 'faq.catalogue.create');
        $response = $this->service->save($request, 'store');
        return $this->handleActionResponse($response, $request, redirectRoute: 'faq.catalogue.index');
    }

    public function update($id, UpdateFaqCatalogueRequest $request)
    {
        $this->authorize('modules', 'faq.catalogue.update');
        $response = $this->service->save($request, 'update', $id);
        return $this->handleActionResponse($response, $request, redirectRoute: 'faq.catalogue.index');
    }

    public function delete($id)
    {
        $this->authorize('modules', 'faq.catalogue.destroy');
        $record = $this->service->findById($id);
        $this->checkExists($record);
        $config = [
            ...$this->config(),
            'method' => 'delete'
        ];
        $template = 'backend.faq.catalogue.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'record'
        ));
    }

    public function destroy($id, Request $request)
    {
        $this->authorize('modules', 'faq.catalogue.destroy');
        $response = $this->service->destroy($id);
        return $this->handleActionResponse($response, $request, message: 'Xóa bản ghi thành công', redirectRoute: 'faq.catalogue.index');
    }

    private function nestedset()
    {
        return new \App\Classes\Nestedsetbie([
            'table' => 'faq_catalogues',
            'foreignkey' => 'faq_catalogue_id',
            'language_id' => $this->language,
        ]);
    }

    private function currentLanguage()
    {
        $locale = app()->getLocale();
        $language = Language::where('canonical', $locale)->first();
        return $language->id ?? 1;
    }

    private function config(): array
    {
        return [
            'model' => 'FaqCatalogue',
            'seo' => __('messages.faqCatalogue')
        ];
    }
}
