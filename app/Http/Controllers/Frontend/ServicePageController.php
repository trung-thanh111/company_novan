<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Services\V2\Interfaces\Company\ServiceServiceInterface as CompanyServiceService;
use App\Services\V2\Interfaces\Company\ServiceCatalogueServiceInterface as ServiceCatalogueService;
use App\Services\V2\Interfaces\Partner\PartnerServiceInterface as PartnerService;
use App\Models\Gallery;
use App\Models\Project;
use Illuminate\Http\Request;

class ServicePageController extends FrontendController
{
    protected $serviceService;
    protected $serviceCatalogueService;
    protected $partnerService;

    public function __construct(
        CompanyServiceService $serviceService,
        ServiceCatalogueService $serviceCatalogueService,
        PartnerService $partnerService
    ) {
        $this->serviceService = $serviceService;
        $this->serviceCatalogueService = $serviceCatalogueService;
        $this->partnerService = $partnerService;
        parent::__construct();
    }

    public function index()
    {
        $serviceCatalogues = $this->serviceCatalogueService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true,
            orderBy: ['order', 'asc']
        );

        if ($serviceCatalogues->isEmpty()) {
            $serviceCatalogues = $this->getMockCatalogues();
        }

        $services = $this->serviceService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true,
            relation: ['languages', 'service_catalogues.languages'],
            orderBy: ['order', 'asc']
        );

        if ($services->isEmpty()) {
            $services = $this->getMockServices($serviceCatalogues);
        }

        // Fetch Projects for the featured slider as requested
        $projects = Project::with(['languages'])
            ->where('publish', 2)
            ->orderBy('order', 'asc')
            ->get();

        if ($projects->isEmpty()) {
            $projects = $this->getMockProjects();
        }

        $featuredServices = $services->take(3);

        $partners = $this->partnerService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true,
            orderBy: ['order', 'asc']
        );

        if ($partners->isEmpty()) {
            $partners = $this->getMockPartners();
        }

        $heroGallery = Gallery::whereHas('gallery_catalogues', function ($q) {
            $q->whereHas('languages', function ($q2) {
                $q2->where('gallery_catalogue_language.canonical', 'cong-ty');
            });
        })->where('publish', 2)->first();

        $system = $this->system;
        $seo = $this->buildSeo('Giải Pháp Công Nghệ — ' . ($system['homepage_company'] ?? 'Novan Vietnam'));
        $schema = $this->schema($seo);
        $config = $this->config();

        return view('frontend.service.index', compact(
            'config',
            'seo',
            'system',
            'schema',
            'serviceCatalogues',
            'services',
            'projects',
            'featuredServices',
            'partners',
            'heroGallery'
        ));
    }

    private function getMockProjects()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Hệ thống Quản lý Năng lượng Thông minh',
                'desc' => 'Giải pháp tối ưu hóa tiêu thụ điện năng cho các khu công nghiệp bằng công nghệ IoT và AI, giúp tiết kiệm 30% chi phí vận hành.',
                'image' => 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?q=80&w=1200'
            ],
            [
                'id' => 2,
                'name' => 'Nền tảng Fintech Giao dịch Xuyên biên giới',
                'desc' => 'Xây dựng core-system cho ngân hàng số với độ bảo mật tuyệt đối, xử lý hàng triệu giao dịch mỗi giây bằng kiến trúc Microservices.',
                'image' => 'https://images.unsplash.com/photo-1551288049-bbbda5366a7a?q=80&w=1200'
            ],
            [
                'id' => 3,
                'name' => 'Số hóa Y tế - Hệ sinh thái MedTech',
                'desc' => 'Kết nối bệnh nhân và bác sĩ thông qua ứng dụng di động, quản lý hồ sơ sức khỏe điện tử tập trung trên Cloud.',
                'image' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?q=80&w=1200'
            ],
        ];

        return collect($data)->map(function($item) {
            $obj = (object)$item;
            $langPiv = (object)[
                'name' => $item['name'], 
                'description' => $item['desc'],
                'canonical' => 'du-an-' . $item['id']
            ];
            $langObj = (object)['pivot' => $langPiv];
            $obj->languages = collect([$langObj]);
            return $obj;
        });
    }

    private function getMockPartners()
    {
        $data = [
            ['id' => 1, 'name' => 'FPT Software', 'image' => 'https://fptsoftware.com/wp-content/uploads/2023/10/FPT_Software_Logo.png'],
            ['id' => 2, 'name' => 'Viettel Solutions', 'image' => 'https://viettel.com.vn/uploads/images/Logo-Viettel.png'],
            ['id' => 3, 'name' => 'Microsoft', 'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/microsoft/microsoft-original.svg'],
            ['id' => 4, 'name' => 'Google Cloud', 'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/google/google-original.svg'],
            ['id' => 5, 'name' => 'Amazon Web Services', 'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/amazonwebservices/amazonwebservices-original-wordmark.svg'],
            ['id' => 6, 'name' => 'Oracle', 'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/oracle/oracle-original.svg'],
            ['id' => 7, 'name' => 'VNG Cloud', 'image' => 'https://vngcloud.vn/logo.png'],
            ['id' => 8, 'name' => 'Base.vn', 'image' => 'https://base.vn/logo.png'],
        ];

        return collect($data)->map(function($item) {
            $obj = (object)$item;
            $langPiv = (object)['name' => $item['name']];
            $langObj = (object)['pivot' => $langPiv];
            $obj->languages = collect([$langObj]);
            return $obj;
        });
    }

    private function getMockCatalogues()
    {
        $data = [
            ['id' => 1, 'name' => 'Giải pháp Phần mềm'],
            ['id' => 2, 'name' => 'Trí tuệ Nhân tạo (AI)'],
            ['id' => 3, 'name' => 'Hạ tầng & Bảo mật'],
            ['id' => 4, 'name' => 'Chuyển đổi số (DX)'],
            ['id' => 5, 'name' => 'Digital Marketing'],
        ];

        return collect($data)->map(function($item) {
            $obj = (object)$item;
            $langPiv = (object)['name' => $item['name'], 'canonical' => 'danh-muc-' . $item['id']];
            $langObj = (object)['pivot' => $langPiv];
            $obj->languages = collect([$langObj]);
            return $obj;
        });
    }

    private function getMockServices($catalogues)
    {
        $data = [
            [
                'id' => 1,
                'cat_id' => 1,
                'name' => 'Phát triển Phần mềm theo yêu cầu',
                'desc' => 'Chúng tôi xây dựng các hệ thống ERP, CRM và phần mềm quản lý chuyên biệt, tối ưu cho từng quy trình nghiệp vụ của doanh nghiệp Việt.',
                'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=1200'
            ],
            [
                'id' => 2,
                'cat_id' => 2,
                'name' => 'Giải pháp Phân tích Dữ liệu & AI',
                'desc' => 'Khai phá giá trị từ dữ liệu với mô hình AI dự báo, thị giác máy tính và xử lý ngôn ngữ tự nhiên (NLP) để đưa ra quyết định kinh doanh chính xác.',
                'image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=1200'
            ],
            [
                'id' => 3,
                'cat_id' => 3,
                'name' => 'Hệ thống Hạ tầng Hybrid Cloud',
                'desc' => 'Thiết kế và vận hành hạ tầng điện toán đám mây an toàn, ổn định với các tiêu chuẩn bảo mật quốc tế, giảm thiểu rủi ro gián đoạn dịch vụ.',
                'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=1200'
            ],
            [
                'id' => 4,
                'cat_id' => 4,
                'name' => 'Số hóa Quy trình Doanh nghiệp',
                'desc' => 'Đồng hành cùng doanh nghiệp trong hành trình chuyển đổi số, từ tư vấn chiến lược đến thực thi công nghệ để tối ưu hóa chi phí vận hành.',
                'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=1200'
            ],
            [
                'id' => 5,
                'cat_id' => 5,
                'name' => 'Tư vấn Giải pháp Marketing Automation',
                'desc' => 'Tự động hóa phễu bán hàng, chăm sóc khách hàng đa kênh và cá nhân hóa trải nghiệm người dùng dựa trên hành vi thực tế.',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1200'
            ],
            [
                'id' => 6,
                'cat_id' => 1,
                'name' => 'Thiết kế Hệ thống Mobile App Doanh nghiệp',
                'desc' => 'Xây dựng ứng dụng di động hiệu năng cao trên cả iOS & Android, kết nối trực tiếp với hệ sinh thái dữ liệu của công ty.',
                'image' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?q=80&w=1200'
            ],
        ];

        return collect($data)->map(function($item) use ($catalogues) {
            $obj = (object)$item;
            $obj->created_at = now();
            $obj->album = json_encode([$item['image'], $item['image']]); // Mock album with duplicate main image
            
            $langPiv = (object)[
                'name' => $item['name'], 
                'description' => $item['desc'],
                'canonical' => 'dich-vu-' . $item['id']
            ];
            $langObj = (object)['pivot' => $langPiv];
            $obj->languages = collect([$langObj]);

            $catRepo = $catalogues->firstWhere('id', $item['cat_id']);
            $obj->service_catalogues = collect([$catRepo]);
            
            return $obj;
        });
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
