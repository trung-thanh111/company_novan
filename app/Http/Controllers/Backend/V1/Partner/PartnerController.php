<?php

namespace App\Http\Controllers\Backend\V1\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Partner\StorePartnerRequest;
use App\Http\Requests\Partner\UpdatePartnerRequest;
use App\Services\V2\Interfaces\Partner\PartnerServiceInterface as PartnerService;
use App\Models\Language;

class PartnerController extends Controller
{
    private $service;
    protected $language;

    public function __construct(
        PartnerService $service
    ) {
        $this->service = $service;
        $this->language = $this->currentLanguage();
    }

    public function index(Request $request)
    {
        $this->authorize('modules', 'partner.index');
        $records = $this->service->pagination($request);
        $thisLanguage = $this->language;
        $config = [
            ...$this->config(),
            'extendJs' => true
        ];
        $template = 'backend.partner.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'records',
            'thisLanguage'
        ));
    }

    public function create()
    {
        $this->authorize('modules', 'partner.create');
        $thisLanguage = $this->language;
        $config = [
            ...$this->config(),
            'method' => 'create',
            'extendJs' => true
        ];
        $template = 'backend.partner.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'thisLanguage'
        ));
    }

    public function edit($id)
    {
        $this->authorize('modules', 'partner.update');
        if (!$record = $this->service->findById($id)) {
            return redirect()->route('partner.index')->with('error', 'Bản ghi không tồn tại');
        }
        $thisLanguage = $this->language;
        $config = [
            ...$this->config(),
            'method' => 'edit',
            'extendJs' => true
        ];
        $template = 'backend.partner.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'record',
            'thisLanguage'
        ));
    }

    public function store(StorePartnerRequest $request)
    {
        $this->authorize('modules', 'partner.create');
        $response = $this->service->save($request, 'store');
        return $this->handleActionResponse($response, $request, redirectRoute: 'partner.index');
    }

    public function update($id, UpdatePartnerRequest $request)
    {
        $this->authorize('modules', 'partner.update');
        $response = $this->service->save($request, 'update', $id);
        return $this->handleActionResponse($response, $request, redirectRoute: 'partner.index');
    }

    public function delete($id)
    {
        $this->authorize('modules', 'partner.destroy');
        $record = $this->service->findById($id);
        $this->checkExists($record);
        $config = [
            ...$this->config(),
            'method' => 'delete'
        ];
        $template = 'backend.partner.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'record'
        ));
    }

    public function destroy($id, Request $request)
    {
        $this->authorize('modules', 'partner.destroy');
        $response = $this->service->destroy($id);
        return $this->handleActionResponse($response, $request, message: 'Xóa bản ghi thành công', redirectRoute: 'partner.index');
    }

    private function config(): array
    {
        return [
            'model' => 'Partner',
            'seo' => __('messages.partner')
        ];
    }

    private function currentLanguage()
    {
        $locale = app()->getLocale();
        $language = Language::where('canonical', $locale)->first();
        return $language->id ?? 1;
    }
}
