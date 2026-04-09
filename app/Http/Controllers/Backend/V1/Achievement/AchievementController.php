<?php

namespace App\Http\Controllers\Backend\V1\Achievement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Achievement\StoreAchievementRequest;
use App\Http\Requests\Achievement\UpdateAchievementRequest;
use App\Services\V2\Interfaces\Achievement\AchievementServiceInterface as AchievementService;
use App\Models\Language;

class AchievementController extends Controller
{
    private $service;
    protected $language;

    public function __construct(
        AchievementService $service
    ) {
        $this->service = $service;
        $this->language = $this->currentLanguage();
    }

    public function index(Request $request)
    {
        $this->authorize('modules', 'achievement.index');
        $records = $this->service->pagination($request);
        $thisLanguage = $this->language;
        $config = [
            ...$this->config(),
            'extendJs' => true
        ];
        $template = 'backend.achievement.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'records',
            'thisLanguage'
        ));
    }

    public function create()
    {
        $this->authorize('modules', 'achievement.create');
        $thisLanguage = $this->language;
        $config = [
            ...$this->config(),
            'method' => 'create',
            'extendJs' => true
        ];
        $template = 'backend.achievement.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'thisLanguage'
        ));
    }

    public function edit($id)
    {
        $this->authorize('modules', 'achievement.update');
        if (!$record = $this->service->findById($id)) {
            return redirect()->route('achievement.index')->with('error', 'Bản ghi không tồn tại');
        }
        $thisLanguage = $this->language;
        $config = [
            ...$this->config(),
            'method' => 'edit',
            'extendJs' => true
        ];
        $template = 'backend.achievement.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'record',
            'thisLanguage'
        ));
    }

    public function store(StoreAchievementRequest $request)
    {
        $this->authorize('modules', 'achievement.create');
        $response = $this->service->save($request, 'store');
        return $this->handleActionResponse($response, $request, redirectRoute: 'achievement.index');
    }

    public function update($id, UpdateAchievementRequest $request)
    {
        $this->authorize('modules', 'achievement.update');
        $response = $this->service->save($request, 'update', $id);
        return $this->handleActionResponse($response, $request, redirectRoute: 'achievement.index');
    }

    public function delete($id)
    {
        $this->authorize('modules', 'achievement.destroy');
        $record = $this->service->findById($id);
        $this->checkExists($record);
        $config = [
            ...$this->config(),
            'method' => 'delete'
        ];
        $template = 'backend.achievement.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'record'
        ));
    }

    public function destroy($id, Request $request)
    {
        $this->authorize('modules', 'achievement.destroy');
        $response = $this->service->destroy($id);
        return $this->handleActionResponse($response, $request, message: 'Xóa bản ghi thành công', redirectRoute: 'achievement.index');
    }

    private function config(): array
    {
        return [
            'model' => 'Achievement',
            'seo' => __('messages.achievement')
        ];
    }

    private function currentLanguage()
    {
        $locale = app()->getLocale();
        $language = Language::where('canonical', $locale)->first();
        return $language->id ?? 1;
    }
}
