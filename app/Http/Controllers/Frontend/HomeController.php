<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Services\V2\Interfaces\Project\ProjectServiceInterface as ProjectService;
use App\Services\V2\Impl\RealEstate\PropertyFacilityService;
use App\Services\V2\Impl\RealEstate\FloorplanService;
use App\Services\V2\Impl\RealEstate\GalleryService as ProjectGalleryService;
use App\Services\V2\Impl\RealEstate\LocationHighlightService;
use App\Services\V2\Interfaces\Team\TeamServiceInterface as TeamService;
use App\Services\V2\Interfaces\Partner\PartnerServiceInterface as PartnerService;
use App\Services\V2\Interfaces\Company\ServiceServiceInterface as CompanyServiceService;
use App\Models\Review;
use App\Services\V1\Interfaces\CoreValue\CoreValueServiceInterface as CoreValueService;
use App\Services\V1\Interfaces\WorkProcess\WorkProcessServiceInterface as WorkProcessService;
use App\Services\V1\Core\SlideService;
use App\Repositories\Core\SystemRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

class HomeController extends FrontendController
{
    protected $systemRepository;
    protected $projectService;
    protected $facilityService;
    protected $floorplanService;
    protected $galleryService;
    protected $locationHighlightService;
    protected $teamService;
    protected $partnerService;
    protected $companyServiceService;
    protected $slideService;
    protected $coreValueService;
    protected $workProcessService;

    public function __construct(
        SystemRepository $systemRepository,
        ProjectService $projectService,
        PropertyFacilityService $facilityService,
        FloorplanService $floorplanService,
        ProjectGalleryService $galleryService,
        LocationHighlightService $locationHighlightService,
        TeamService $teamService,
        PartnerService $partnerService,
        CompanyServiceService $companyServiceService,
        SlideService $slideService,
        CoreValueService $coreValueService,
        WorkProcessService $workProcessService
    ) {
        $this->systemRepository = $systemRepository;
        $this->projectService = $projectService;
        $this->facilityService = $facilityService;
        $this->floorplanService = $floorplanService;
        $this->galleryService = $galleryService;
        $this->locationHighlightService = $locationHighlightService;
        $this->teamService = $teamService;
        $this->partnerService = $partnerService;
        $this->companyServiceService = $companyServiceService;
        $this->slideService = $slideService;
        $this->coreValueService = $coreValueService;
        $this->workProcessService = $workProcessService;
        parent::__construct();
    }

    /**
     * Homepage — 9 sections
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

        $facilities = Schema::hasTable('property_facilities') ? $this->facilityService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true,
            orderBy: ['sort_order', 'asc']
        ) : collect();

        $floorplans = Schema::hasTable('floorplans') ? $this->floorplanService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true,
            relation: ['rooms'],
            orderBy: ['floor_number', 'asc']
        ) : collect();

        $galleries = Schema::hasTable('galleries') ? $this->galleryService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true,
            orderBy: ['id', 'desc']
        ) : collect();

        $locationHighlights = Schema::hasTable('location_highlights') ? $this->locationHighlightService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true,
            orderBy: ['sort_order', 'asc']
        ) : collect();

        $primaryAgent = Schema::hasTable('teams') ? $this->teamService->findByCondition(
            condition: [['is_primary', '=', true], ['publish', '=', 2]]
        ) : null;

        $teams = Schema::hasTable('teams') ? $this->teamService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true
        ) : collect();

        $partners = Schema::hasTable('partners') ? $this->partnerService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true,
            orderBy: ['order', 'asc']
        ) : collect();

        $companyServices = Schema::hasTable('services') ? $this->companyServiceService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true,
            orderBy: ['order', 'asc']
        )?->take(6) : collect();

        $reviews = Schema::hasTable('reviews') ? Review::where('status', 1)->orderByDesc('id')->limit(10)->get() : collect();

        $coreValues = Schema::hasTable('core_values') ? $this->coreValueService->findByCondition(
            condition: [
                ['publish', '=', 2],
                ['language_id', '=', $this->language]
            ],
            flag: true,
            orderBy: ['order', 'asc']
        ) : collect();

        $workProcesses = Schema::hasTable('work_processes') ? $this->workProcessService->findByCondition(
            condition: [
                ['publish', '=', 2],
                ['language_id', '=', $this->language]
            ],
            flag: true,
            orderBy: ['order', 'asc']
        ) : collect();

        $slides = $this->slideService->getSlide(['main-slider']);
        $slides = $slides['main-slider'] ?? null;

        $heroGallery = \App\Models\Gallery::whereHas('gallery_catalogues', function ($q) {
            $q->whereHas('languages', function ($q2) {
                $q2->where('gallery_catalogue_language.canonical', 'cong-ty');
            });
        })->where('publish', 2)->first();

        $system = $this->system;
        $seo = $this->buildSeo();
        $schema = $this->schema($seo);
        $config = $this->config();

        $homePosts = \App\Models\Post::where('publish', 2)
            ->with(['languages' => function ($q) {
                $q->where('language_id', $this->language);
            }, 'post_catalogues' => function ($q) {
                $q->with(['languages' => function ($q2) {
                    $q2->where('language_id', $this->language);
                }]);
            }])
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();

        $template = 'frontend.homepage.home.index';
        return view($template, compact(
            'config',
            'seo',
            'system',
            'schema',
            'projects',
            'facilities',
            'floorplans',
            'galleries',
            'locationHighlights',
            'primaryAgent',
            'teams',
            'partners',
            'companyServices',
            'slides',
            'heroGallery',
            'reviews',
            'coreValues',
            'workProcesses',
            'homePosts',
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
