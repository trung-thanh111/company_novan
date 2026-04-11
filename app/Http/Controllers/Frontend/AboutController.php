<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Services\V2\Interfaces\Project\ProjectServiceInterface as ProjectService;
use App\Services\V2\Impl\RealEstate\PropertyFacilityService;
use App\Services\V2\Impl\RealEstate\FloorplanService;
use App\Services\V2\Impl\RealEstate\GalleryService;
use App\Services\V2\Impl\RealEstate\LocationHighlightService;
use App\Services\V2\Interfaces\Team\TeamServiceInterface as TeamService;
use App\Services\V2\Interfaces\Company\ServiceServiceInterface as CompanyServiceService;
use App\Services\V1\Interfaces\WorkProcess\WorkProcessServiceInterface as WorkProcessService;
use App\Services\V1\Interfaces\CoreValue\CoreValueServiceInterface as CoreValueService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

class AboutController extends FrontendController
{
    protected $projectService;
    protected $teamService;
    protected $facilityService;
    protected $floorplanService;
    protected $locationHighlightService;
    protected $galleryService;
    protected $companyServiceService;
    protected $workProcessService;
    protected $coreValueService;

    public function __construct(
        ProjectService $projectService,
        TeamService $teamService,
        PropertyFacilityService $facilityService,
        FloorplanService $floorplanService,
        LocationHighlightService $locationHighlightService,
        GalleryService $galleryService,
        CompanyServiceService $companyServiceService,
        WorkProcessService $workProcessService,
        CoreValueService $coreValueService
    ) {
        $this->projectService = $projectService;
        $this->teamService = $teamService;
        $this->facilityService = $facilityService;
        $this->floorplanService = $floorplanService;
        $this->locationHighlightService = $locationHighlightService;
        $this->galleryService = $galleryService;
        $this->companyServiceService = $companyServiceService;
        $this->workProcessService = $workProcessService;
        $this->coreValueService = $coreValueService;
        parent::__construct();
    }

    /**
     * About page
     */
    public function index()
    {
        $projects = Schema::hasTable('projects') ? $this->projectService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true,
            relation: ['languages', 'project_catalogue.languages'],
            orderBy: ['is_featured', 'desc'],
            param: ['limit' => 8]
        ) : collect();

        $project = $projects->first();

        $teams = $this->teamService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true,
            orderBy: ['id', 'desc']
        );

        $facilities = $this->facilityService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true,
            orderBy: ['id', 'desc']
        );

        // Count total projects for statistics
        $projectCount = Schema::hasTable('projects') ? \App\Models\Project::where('publish', 2)->count() : 0;

        $floorplans = $this->floorplanService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true,
            relation: ['rooms'],
            orderBy: ['floor_number', 'asc']
        );

        $locationHighlights = $this->locationHighlightService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true,
            orderBy: ['id', 'desc']
        );

        $galleries = $this->galleryService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true,
            orderBy: ['id', 'desc']
        );

        $primaryAgent = $this->teamService->findByCondition(
            condition: [['is_primary', '=', true], ['publish', '=', 2]]
        );

        $companyServices = Schema::hasTable('services') ? $this->companyServiceService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true,
            orderBy: ['order', 'asc']
        )?->take(6) : collect();

        $workProcesses = Schema::hasTable('work_processes') ? $this->workProcessService->findByCondition(
            condition: [
                ['publish', '=', 2],
                ['language_id', '=', $this->language]
            ],
            flag: true,
            orderBy: ['order', 'asc']
        ) : collect();

        $coreValues = Schema::hasTable('core_values') ? $this->coreValueService->findByCondition(
            condition: [
                ['publish', '=', 2],
                ['language_id', '=', $this->language]
            ],
            flag: true,
            orderBy: ['order', 'asc']
        ) : collect();

        $heroGallery = \App\Models\Gallery::whereHas('gallery_catalogues', function ($q) {
            $q->whereHas('languages', function ($q2) {
                $q2->where('gallery_catalogue_language.canonical', 'cong-ty');
            });
        })->where('publish', 2)->first();

        // Fetch Album ID 1 for CTA section
        $ctaGallery = \App\Models\Gallery::find(1);

        $system = $this->system;
        $seo = $this->buildSeo('Giới Thiệu — ' . ($system['homepage_company'] ?? 'Novan Vietnam'));
        $schema = $this->schema($seo);
        $config = $this->config();

        return view('frontend.about.index', compact(
            'config',
            'seo',
            'system',
            'schema',
            'projects',
            'project',
            'projectCount',
            'teams',
            'facilities',
            'floorplans',
            'locationHighlights',
            'galleries',
            'primaryAgent',
            'companyServices',
            'workProcesses',
            'coreValues',
            'heroGallery',
            'ctaGallery',
        ));
    }

    // ------ Helpers ------

    private function buildSeo($title = null)
    {
        return [
            'meta_title' => $title ?? ($this->system['seo_meta_title'] ?? 'Novan Vietnam'),
            'meta_keyword' => $this->system['seo_meta_keyword'] ?? '',
            'meta_description' => $this->system['seo_meta_description'] ?? '',
            'meta_image' => $this->system['seo_meta_images'] ?? '',
            'canonical' => config('app.url'),
        ];
    }

    public function schema(array $seo = []): string
    {
        return "<script type='application/ld+json'>
            {
                \"@context\": \"https://schema.org\",
                \"@type\": \"WebSite\",
                \"name\": \"" . ($seo['meta_title'] ?? '') . "\",
                \"url\": \"" . ($seo['canonical'] ?? '') . "\",
                \"description\": \"" . ($seo['meta_description'] ?? '') . "\"
            }
        </script>";
    }

    private function config()
    {
        return [
            'language' => $this->language,
            'css' => [],
            'js' => []
        ];
    }
}
