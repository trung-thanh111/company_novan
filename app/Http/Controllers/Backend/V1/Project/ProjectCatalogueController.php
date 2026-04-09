<?php

namespace App\Http\Controllers\Backend\V1\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\V2\Interfaces\Project\ProjectCatalogueServiceInterface as ProjectCatalogueService;
use App\Http\Requests\Project\StoreProjectCatalogueRequest;
use App\Http\Requests\Project\UpdateProjectCatalogueRequest;
use App\Repositories\Interfaces\ProjectCatalogueRepositoryInterface as ProjectCatalogueRepository;
use App\Classes\Nestedsetbie;
use App\Models\Language;

class ProjectCatalogueController extends Controller
{
    protected $projectCatalogueService;
    protected $projectCatalogueRepository;
    protected $language;

    public function __construct(
        ProjectCatalogueService $projectCatalogueService,
        ProjectCatalogueRepository $projectCatalogueRepository
    ) {
        $this->projectCatalogueService = $projectCatalogueService;
        $this->projectCatalogueRepository = $projectCatalogueRepository;
        $this->language = $this->currentLanguage();
    }

    public function index(Request $request)
    {
        $projectCatalogues = $this->projectCatalogueService->pagination($request);
        $config = $this->configData('index');
        $config['title'] = 'Quản lý nhóm dự án';
        $template = 'backend.project.catalogue.index';
        return view('backend.dashboard.layout', compact('projectCatalogues', 'config', 'template'));
    }

    public function create()
    {
        $config = $this->configData('create');
        $config['title'] = 'Thêm mới nhóm dự án';
        $dropdown = $this->nestedset()->Dropdown();
        $template = 'backend.project.catalogue.store';
        return view('backend.dashboard.layout', compact('config', 'dropdown', 'template'));
    }

    public function store(StoreProjectCatalogueRequest $request)
    {
        if ($this->projectCatalogueService->create($request, $this->language)) {
            return redirect()->route('project.catalogue.index')->with('success', 'Thêm mới bản ghi thành công');
        }
        return redirect()->route('project.catalogue.index')->with('error', 'Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id)
    {
        $projectCatalogue = $this->projectCatalogueService->findById($id);
        $config = $this->configData('edit');
        $config['title'] = 'Cập nhật nhóm dự án';
        $dropdown = $this->nestedset()->Dropdown();
        $template = 'backend.project.catalogue.store';
        return view('backend.dashboard.layout', compact('config', 'projectCatalogue', 'dropdown', 'template'));
    }

    public function update($id, UpdateProjectCatalogueRequest $request)
    {
        if ($this->projectCatalogueService->update($id, $request, $this->language)) {
            return redirect()->route('project.catalogue.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->route('project.catalogue.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id)
    {
        $projectCatalogue = $this->projectCatalogueService->findById($id);
        $config = $this->configData('delete');
        $config['title'] = 'Xóa nhóm dự án';
        $template = 'backend.project.catalogue.delete';
        return view('backend.dashboard.layout', compact('projectCatalogue', 'config', 'template'));
    }

    public function destroy($id)
    {
        if ($this->projectCatalogueService->destroy($id)) {
            return redirect()->route('project.catalogue.index')->with('success', 'Xóa bản ghi thành công');
        }
        return redirect()->route('project.catalogue.index')->with('error', 'Xóa bản ghi không thành công. Hãy thử lại');
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
            'model' => 'ProjectCatalogue',
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
