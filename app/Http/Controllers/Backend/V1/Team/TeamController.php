<?php

namespace App\Http\Controllers\Backend\V1\Team;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Team\StoreTeamRequest as StoreRequest;
use App\Http\Requests\Team\UpdateTeamRequest as UpdateRequest;
use App\Services\V2\Interfaces\Team\TeamServiceInterface as TeamService;
use App\Models\Language;

class TeamController extends Controller
{

    private $service;

    protected $language;

    public function __construct(
        TeamService $service
    ) {
        $this->service = $service;
        $this->middleware(function ($request, $next) {
            $locale = app()->getLocale();
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language->id;
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $this->authorize('modules', 'team.index');
        $records = $this->service->pagination($request);
        $config = [
            ...$this->config(),
            'extendJs' => true
        ];
        $template = 'backend.team.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'records'
        ));
    }

    public function create()
    {
        $this->authorize('modules', 'team.create');
        $config = [
            ...$this->config(),
            'method' => 'create',
            'extendJs' => true
        ];
        $template = 'backend.team.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config'
        ));
    }

    public function edit($id)
    {
        $this->authorize('modules', 'team.update');
        if (!$record = $this->service->findById($id)) {
            return redirect()->route('team.index')->with('error', 'Bản ghi không tồn tại');
        }
        $config = [
            ...$this->config(),
            'method' => 'edit',
            'extendJs' => true
        ];
        $template = 'backend.team.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'record'
        ));
    }

    public function store(StoreRequest $request)
    {
        $this->authorize('modules', 'team.create');
        $response = $this->service->save($request, 'store');
        return $this->handleActionResponse($response, $request, redirectRoute: 'team.index');
    }


    public function update($id, UpdateRequest $request)
    {
        $this->authorize('modules', 'team.update');
        $response = $this->service->save($request, 'update', $id);
        return $this->handleActionResponse($response, $request, redirectRoute: 'team.index');
    }

    public function delete($id)
    {
        $this->authorize('modules', 'team.destroy');
        $record = $this->service->findById($id);
        $this->checkExists($record);
        $config = [
            ...$this->config(),
            'method' => 'delete'
        ];
        $template = 'backend.team.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'record'
        ));
    }

    public function destroy($id, Request $request)
    {
        $this->authorize('modules', 'team.destroy');
        $response = $this->service->destroy($id);
        return $this->handleActionResponse($response, $request, message: 'Xóa bản ghi thành công', redirectRoute: 'team.index');
    }

    private function config(): array
    {
        return [
            'model' => 'Team',
            'seo' => __('messages.team')
        ];
    }
}
