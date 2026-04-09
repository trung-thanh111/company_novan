<?php

namespace App\Http\Controllers\Backend\V1\CoreValue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CoreValue\StoreCoreValueRequest;
use App\Http\Requests\CoreValue\UpdateCoreValueRequest;
use App\Services\V1\Interfaces\CoreValue\CoreValueServiceInterface as CoreValueService;
use App\Models\Language;

class CoreValueController extends Controller
{
    private $service;
    protected $language;

    public function __construct(
        CoreValueService $service
    ) {
        $this->service = $service;
        $this->language = $this->currentLanguage();
    }

    public function index(Request $request)
    {
        // $this->authorize('modules', 'core_value.index');
        $thisLanguage = $this->language;
        $records = $this->service->paginate($request, $thisLanguage);
        $config = [
            ...$this->config(),
            'extendJs' => true
        ];
        $template = 'backend.core_value.core_value.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'records',
            'thisLanguage'
        ));
    }

    public function create()
    {
        // $this->authorize('modules', 'core_value.create');
        $thisLanguage = $this->language;
        $record = null;
        $config = [
            ...$this->config(),
            'method' => 'create',
            'extendJs' => true
        ];
        $template = 'backend.core_value.core_value.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'thisLanguage',
            'record'
        ));
    }

    public function edit($id)
    {
        // $this->authorize('modules', 'core_value.update');
        $thisLanguage = $this->language;
        
        // Find record via Repository or Service (We simplify here by just querying but ideally via repo)
        $record = \App\Models\CoreValue::with(['languages' => function($query) use ($thisLanguage){
            $query->where('language_id', $thisLanguage);
        }])->find($id);

        if (!$record) {
            return redirect()->route('core_value.index')->with('error', 'Bản ghi không tồn tại');
        }
        
        $config = [
            ...$this->config(),
            'method' => 'edit',
            'extendJs' => true
        ];
        $template = 'backend.core_value.core_value.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'record',
            'thisLanguage'
        ));
    }

    public function store(StoreCoreValueRequest $request)
    {
        // $this->authorize('modules', 'core_value.create');
        $thisLanguage = $this->language;
        if($this->service->create($request, $thisLanguage)){
            return redirect()->route('core_value.index')->with('success', 'Thêm bản ghi thành công');
        }
        return redirect()->route('core_value.index')->with('error', 'Thêm bản ghi không thành công');
    }

    public function update($id, UpdateCoreValueRequest $request)
    {
        // $this->authorize('modules', 'core_value.update');
        $thisLanguage = $this->language;
        if($this->service->update($id, $request, $thisLanguage)){
            return redirect()->route('core_value.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->route('core_value.index')->with('error', 'Cập nhật bản ghi không thành công');
    }

    public function delete($id)
    {
        // $this->authorize('modules', 'core_value.destroy');
        $thisLanguage = $this->language;
        $record = \App\Models\CoreValue::with(['languages' => function($query) use ($thisLanguage){
            $query->where('language_id', $thisLanguage);
        }])->find($id);

        if (!$record) {
            return redirect()->route('core_value.index')->with('error', 'Bản ghi không tồn tại');
        }
        
        $config = [
            ...$this->config(),
            'method' => 'delete'
        ];
        $template = 'backend.core_value.core_value.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'record'
        ));
    }

    public function destroy($id, Request $request)
    {
        // $this->authorize('modules', 'core_value.destroy');
        if($this->service->destroy($id)){
            return redirect()->route('core_value.index')->with('success', 'Xóa bản ghi thành công');
        }
        return redirect()->route('core_value.index')->with('error', 'Xóa bản ghi không thành công');
    }

    private function config(): array
    {
        return [
            'model' => 'CoreValue',
            'seo' => [
                'index' => [
                    'title' => 'Quản lý Giá trị cốt lõi',
                    'table' => 'Danh sách Giá trị cốt lõi'
                ],
                'create' => [
                    'title' => 'Thêm mới Giá trị cốt lõi'
                ],
                'edit' => [
                    'title' => 'Cập nhật Giá trị cốt lõi'
                ],
                'delete' => [
                    'title' => 'Xóa Giá trị cốt lõi'
                ]
            ]
        ];
    }

    private function currentLanguage()
    {
        $locale = app()->getLocale();
        $language = Language::where('canonical', $locale)->first();
        return $language->id ?? 1;
    }
}
