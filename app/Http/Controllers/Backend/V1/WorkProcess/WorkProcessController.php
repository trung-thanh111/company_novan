<?php

namespace App\Http\Controllers\Backend\V1\WorkProcess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\V1\Interfaces\WorkProcess\WorkProcessServiceInterface;
use App\Models\Language;
use App\Http\Requests\WorkProcess\StoreWorkProcessRequest;

/**
 * Class WorkProcessController
 * @package App\Http\Controllers\Backend\V1\WorkProcess
 */
class WorkProcessController extends Controller
{
    protected $service;
    protected $language;

    /**
     * WorkProcessController constructor.
     *
     * @param WorkProcessServiceInterface $service
     */
    public function __construct(
        WorkProcessServiceInterface $service
    ) {
        $this->service = $service;
        $this->middleware(function ($request, $next) {
            $this->language = $this->currentLanguage();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('modules', 'work_process.index');
        $thisLanguage = $this->language;
        $records = $this->service->pagination($request);

        $config = [
            ...$this->config(),
            'method' => 'index'
        ];
        $template = 'backend.work_process.work_process.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'records',
            'thisLanguage'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('modules', 'work_process.create');
        $thisLanguage = $this->language;
        $config = [
            ...$this->config(),
            'method' => 'create',
        ];
        $template = 'backend.work_process.work_process.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'thisLanguage'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreWorkProcessRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkProcessRequest $request)
    {
        $this->authorize('modules', 'work_process.create');
        $response = $this->service->save($request, 'store');
        return $this->handleActionResponse($response, $request, message: 'Thêm bản ghi thành công', redirectRoute: 'work_process.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('modules', 'work_process.update');
        $record = $this->service->findById($id);
        
        if (!$record) {
            return redirect()->route('work_process.index')->with('error', 'Bản ghi không tồn tại');
        }

        $thisLanguage = $this->language;
        $config = [
            ...$this->config(),
            'method' => 'edit',
        ];
        $template = 'backend.work_process.work_process.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'record',
            'thisLanguage'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  StoreWorkProcessRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, StoreWorkProcessRequest $request)
    {
        $this->authorize('modules', 'work_process.update');
        $response = $this->service->save($request, 'update', $id);
        return $this->handleActionResponse($response, $request, message: 'Cập nhật bản ghi thành công', redirectRoute: 'work_process.index');
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->authorize('modules', 'work_process.destroy');
        $record = $this->service->findById($id);

        if (!$record) {
            return redirect()->route('work_process.index')->with('error', 'Bản ghi không tồn tại');
        }

        $config = [
            ...$this->config(),
            'method' => 'delete'
        ];
        $template = 'backend.work_process.work_process.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'record'
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $this->authorize('modules', 'work_process.destroy');
        $response = $this->service->destroy($id);
        return $this->handleActionResponse($response, $request, message: 'Xóa bản ghi thành công', redirectRoute: 'work_process.index');
    }

    /**
     * Get module configuration.
     *
     * @return array
     */
    private function config(): array
    {
        return [
            'model' => 'WorkProcess',
            'seo' => [
                'index' => [
                    'title' => 'Quản lý Quy trình làm việc',
                    'table' => 'Danh sách Quy trình làm việc'
                ],
                'create' => [
                    'title' => 'Thêm mới Quy trình làm việc'
                ],
                'edit' => [
                    'title' => 'Cập nhật Quy trình làm việc'
                ],
                'delete' => [
                    'title' => 'Xóa Quy trình làm việc'
                ]
            ]
        ];
    }

    /**
     * Get current language ID.
     *
     * @return int
     */
    private function currentLanguage()
    {
        $locale = app()->getLocale();
        $language = Language::where('canonical', $locale)->first();
        return $language->id ?? 1;
    }
}
