<?php

namespace App\Http\Controllers\Backend\V1\Faq;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Faq\StoreFaqRequest;
use App\Http\Requests\Faq\UpdateFaqRequest;
use App\Services\V2\Interfaces\Faq\FaqServiceInterface as FaqService;
use App\Repositories\Interfaces\FaqCatalogueRepositoryInterface as FaqCatalogueRepository;
use App\Models\Language;

class FaqController extends Controller
{
    private $service;
    private $faqCatalogueRepository;
    protected $language;

    public function __construct(
        FaqService $service,
        FaqCatalogueRepository $faqCatalogueRepository
    ) {
        $this->service = $service;
        $this->faqCatalogueRepository = $faqCatalogueRepository;
        $this->language = $this->currentLanguage();
    }

    public function index(Request $request)
    {
        $this->authorize('modules', 'faq.index');
        $records = $this->service->pagination($request);
        $thisLanguage = $this->language;
        $dropdown = $this->nestedset()->Dropdown();
        $config = [
            ...$this->config(),
            'extendJs' => true
        ];
        $template = 'backend.faq.faq.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'records',
            'thisLanguage',
            'dropdown'
        ));
    }

    public function create()
    {
        $this->authorize('modules', 'faq.create');
        $dropdown = $this->nestedset()->Dropdown();
        $thisLanguage = $this->language;
        $config = [
            ...$this->config(),
            'method' => 'create',
            'extendJs' => true
        ];
        $template = 'backend.faq.faq.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'dropdown',
            'thisLanguage'
        ));
    }

    public function edit($id)
    {
        $this->authorize('modules', 'faq.update');
        if (!$record = $this->service->findById($id)) {
            return redirect()->route('faq.index')->with('error', 'Bản ghi không tồn tại');
        }
        $dropdown = $this->nestedset()->Dropdown();
        $thisLanguage = $this->language;
        $config = [
            ...$this->config(),
            'method' => 'edit',
            'extendJs' => true
        ];
        $template = 'backend.faq.faq.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'record',
            'dropdown',
            'thisLanguage'
        ));
    }

    public function store(StoreFaqRequest $request)
    {
        $this->authorize('modules', 'faq.create');
        $response = $this->service->save($request, 'store');
        return $this->handleActionResponse($response, $request, redirectRoute: 'faq.index');
    }

    public function update($id, UpdateFaqRequest $request)
    {
        $this->authorize('modules', 'faq.update');
        $response = $this->service->save($request, 'update', $id);
        return $this->handleActionResponse($response, $request, redirectRoute: 'faq.index');
    }

    public function delete($id)
    {
        $this->authorize('modules', 'faq.destroy');
        $record = $this->service->findById($id);
        $this->checkExists($record);
        $config = [
            ...$this->config(),
            'method' => 'delete'
        ];
        $template = 'backend.faq.faq.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'record'
        ));
    }

    public function destroy($id, Request $request)
    {
        $this->authorize('modules', 'faq.destroy');
        $response = $this->service->destroy($id);
        return $this->handleActionResponse($response, $request, message: 'Xóa bản ghi thành công', redirectRoute: 'faq.index');
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
            'model' => 'Faq',
            'seo' => __('messages.faq')
        ];
    }
}
