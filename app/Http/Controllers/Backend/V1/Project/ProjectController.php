<?php

namespace App\Http\Controllers\Backend\V1\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\V2\Interfaces\Project\ProjectServiceInterface as ProjectService;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Repositories\Interfaces\ProjectRepositoryInterface as ProjectRepository;
use App\Classes\Nestedsetbie;
use App\Models\Language;

class ProjectController extends Controller
{
    protected $projectService;
    protected $projectRepository;
    protected $language;

    public function __construct(
        ProjectService $projectService,
        ProjectRepository $projectRepository
    ) {
        $this->projectService = $projectService;
        $this->projectRepository = $projectRepository;
        $this->language = $this->currentLanguage();
    }

    public function index(Request $request)
    {
        $projects = $this->projectService->pagination($request);
        $config = $this->configData('index');
        $config['title'] = 'Quản lý dự án';
        $dropdown = $this->nestedset()->Dropdown();
        $template = 'backend.project.project.index';
        return view('backend.dashboard.layout', compact('projects', 'config', 'dropdown', 'template'));
    }

    public function create()
    {
        $config = $this->configData('create');
        $config['title'] = 'Thêm mới dự án';
        $dropdown = $this->nestedset()->Dropdown();
        $template = 'backend.project.project.store';
        return view('backend.dashboard.layout', compact('config', 'dropdown', 'template'));
    }

    public function store(StoreProjectRequest $request)
    {
        if ($this->projectService->create($request, $this->language)) {
            return redirect()->route('project.index')->with('success', 'Thêm mới bản ghi thành công');
        }
        return redirect()->route('project.index')->with('error', 'Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id)
    {
        $project = $this->projectService->findById($id);
        $config = $this->configData('edit');
        $config['title'] = 'Cập nhật dự án';
        $dropdown = $this->nestedset()->Dropdown();
        $template = 'backend.project.project.store';
        return view('backend.dashboard.layout', compact('config', 'project', 'dropdown', 'template'));
    }

    public function update($id, UpdateProjectRequest $request)
    {
        if ($this->projectService->update($id, $request, $this->language)) {
            return redirect()->route('project.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->route('project.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id)
    {
        $project = $this->projectService->findById($id);
        $config = $this->configData('delete');
        $config['title'] = 'Xóa dự án';
        $template = 'backend.project.project.delete';
        return view('backend.dashboard.layout', compact('project', 'config', 'template'));
    }

    public function destroy($id)
    {
        if ($this->projectService->destroy($id)) {
            return redirect()->route('project.index')->with('success', 'Xóa bản ghi thành công');
        }
        return redirect()->route('project.index')->with('error', 'Xóa bản ghi không thành công. Hãy thử lại');
    }

    private function configData($method)
    {
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
            'model' => 'Project',
            'method' => $method,
        ];
    }

    private function nestedset() {
        return new Nestedsetbie([
            'table' => 'project_catalogues',
            'foreignkey' => 'project_catalogue_id',
            'language_id' => $this->language,
        ]);
    }

    private function currentLanguage() {
        $locale = app()->getLocale();
        $language = Language::where('canonical', $locale)->first();
        return $language->id ?? 1;
    }
}
