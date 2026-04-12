<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Services\V2\Interfaces\Company\ServiceServiceInterface as CompanyService;
use App\Services\V2\Interfaces\Company\ServiceCatalogueServiceInterface as ServiceCatalogueService;
use App\Models\System;
use Illuminate\Http\Request;

class ServiceCatalogueController extends FrontendController
{
    protected $serviceService;
    protected $serviceCatalogueService;

    public function __construct(
        CompanyService $serviceService,
        ServiceCatalogueService $serviceCatalogueService
    ) {
        $this->serviceService = $serviceService;
        $this->serviceCatalogueService = $serviceCatalogueService;
        parent::__construct();
    }

    public function index($id, Request $request, $page = 1)
    {
        $postCatalogue = $this->serviceCatalogueService->findById($id);
        
        // Mock data if DB empty
        if (!$postCatalogue) {
            $postCatalogue = $this->getMockCatalogue($id);
        }

        $breadcrumb = [
            (object)['languages' => collect([(object)['pivot' => (object)['name' => 'Trang chủ', 'canonical' => '']]])],
            (object)['languages' => collect([(object)['pivot' => (object)['name' => 'Dịch vụ', 'canonical' => 'dich-vu']]])],
            $postCatalogue
        ];

        // Fetch services in this catalogue
        $posts = $this->serviceService->findByCondition(
            condition: [['publish', '=', 2]],
            flag: true,
            relation: ['languages'],
            orderBy: ['order', 'asc']
        )->where('service_catalogue_id', $id);

        if ($posts->isEmpty()) {
            $posts = $this->getMockServices($id);
        }

        $system = $this->system;
        $seo = [
            'meta_title' => ($postCatalogue->languages->first()->pivot->name ?? '') . ' — Novan Vietnam',
            'meta_keyword' => '',
            'meta_description' => $postCatalogue->languages->first()->pivot->description ?? '',
            'meta_image' => $postCatalogue->image ?? '',
            'canonical' => url($postCatalogue->languages->first()->pivot->canonical ?? ''),
        ];

        $template = 'frontend.service.catalogue.index';
        $config = $this->config();

        return view($template, compact(
            'config',
            'seo',
            'system',
            'breadcrumb',
            'postCatalogue',
            'posts'
        ));
    }

    private function getMockCatalogue($id) {
        $catalogues = [
            1 => 'Giải pháp Phần mềm',
            2 => 'Trí tuệ Nhân tạo (AI)',
            3 => 'Hạ tầng & Bảo mật',
            4 => 'Chuyển đổi số (DX)',
            5 => 'Digital Marketing',
        ];
        $name = $catalogues[$id] ?? 'Dịch vụ';
        
        $obj = (object)[
            'id' => $id,
            'image' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1200',
        ];
        $langPiv = (object)[
            'name' => $name,
            'description' => 'Chúng tôi cung cấp các giải pháp ' . $name . ' toàn diện, giúp doanh nghiệp bứt phá trong kỷ nguyên số.',
            'canonical' => 'danh-muc-' . $id
        ];
        $langObj = (object)['pivot' => $langPiv];
        $obj->languages = collect([$langObj]);
        return $obj;
    }

    private function getMockServices($catId) {
        $data = [
            ['name' => 'Tư vấn chiến lược ' . $catId, 'desc' => 'Định hướng lộ trình phát triển tối ưu.'],
            ['name' => 'Triển khai hệ thống ' . $catId, 'desc' => 'Giải pháp thực thi chuyên nghiệp, hiệu quả.'],
            ['name' => 'Bảo trì & Vận hành ' . $catId, 'desc' => 'Đảm bảo hệ thống hoạt động 24/7 ổn định.'],
        ];

        return collect($data)->map(function($item, $index) use ($catId) {
            $obj = (object)[
                'id' => $index + 100,
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=600',
            ];
            $langPiv = (object)[
                'name' => $item['name'],
                'description' => $item['desc'],
                'canonical' => 'dich-vu-' . ($index + 100)
            ];
            $langObj = (object)['pivot' => $langPiv];
            $obj->languages = collect([$langObj]);
            return $obj;
        });
    }

    private function config() {
        return ['language' => $this->language];
    }
}
