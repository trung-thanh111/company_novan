<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Services\V2\Interfaces\Company\ServiceServiceInterface as CompanyService;
use App\Services\V2\Interfaces\Company\ServiceCatalogueServiceInterface as ServiceCatalogueService;
use App\Models\System;
use Illuminate\Http\Request;

class ServiceController extends FrontendController
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

    public function index($id, Request $request)
    {
        $post = $this->serviceService->findById($id);
        
        // Mock data if DB empty
        if (!$post) {
            $post = $this->getMockService($id);
        }

        $postCatalogue = null;
        if (isset($post->service_catalogues) && $post->service_catalogues->isNotEmpty()) {
            $postCatalogue = $post->service_catalogues->first();
        } else {
            $postCatalogue = $this->getMockCatalogue(1);
        }

        $breadcrumb = [
            (object)['languages' => collect([(object)['pivot' => (object)['name' => 'Trang chủ', 'canonical' => '']]])],
            (object)['languages' => collect([(object)['pivot' => (object)['name' => 'Dịch vụ', 'canonical' => 'dich-vu']]])],
            $postCatalogue,
            $post
        ];

        // Related services
        $relatedPosts = $this->serviceService->findByCondition(
            condition: [['publish', '=', 2], ['services.id', '!=', $id]],
            flag: true,
            relation: ['languages'],
            orderBy: ['id', 'desc']
        )->take(3);

        if ($relatedPosts->isEmpty()) {
            $relatedPosts = $this->getMockRelatedServices($id);
        }

        $system = $this->system;
        $seo = [
            'meta_title' => ($post->languages->first()->pivot->name ?? '') . ' — Novan Vietnam',
            'meta_keyword' => '',
            'meta_description' => $post->languages->first()->pivot->description ?? '',
            'meta_image' => $post->image ?? '',
            'canonical' => url($post->languages->first()->pivot->canonical ?? ''),
        ];

        $template = 'frontend.service.post.index';
        $config = $this->config();

        return view($template, compact(
            'config',
            'seo',
            'system',
            'breadcrumb',
            'postCatalogue',
            'post',
            'relatedPosts'
        ));
    }

    private function getMockService($id) {
        $id = ($id > 100) ? $id : 101;
        $obj = (object)[
            'id' => $id,
            'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=1200',
            'created_at' => now(),
        ];
        $langPiv = (object)[
            'name' => 'Dịch vụ Tư vấn Chuyển đổi số Pro',
            'description' => 'Giải pháp tối ưu hóa quy trình doanh nghiệp bằng công nghệ hiện đại nhất hiện nay.',
            'content' => '<h3>Tại sao chọn chúng tôi?</h3><p>Với hơn 10 năm kinh nghiệm trong lĩnh vực công nghệ thông tin, Novan tự hào mang đến những giải pháp thực chiến nhất cho doanh nghiệp của bạn.</p><ul><li>Đội ngũ chuyên gia giàu kinh nghiệm.</li><li>Hỗ trợ 24/7.</li><li>Cam kết hiệu quả tối thiểu 20% sau 6 tháng.</li></ul>',
            'canonical' => 'chi-tiet-dich-vu-' . $id
        ];
        $langObj = (object)['pivot' => $langPiv];
        $obj->languages = collect([$langObj]);
        return $obj;
    }

    private function getMockCatalogue($id) {
        $obj = (object)[
            'id' => $id,
        ];
        $langPiv = (object)[
            'name' => 'Giải pháp Phần mềm',
            'canonical' => 'danh-muc-1'
        ];
        $langObj = (object)['pivot' => $langPiv];
        $obj->languages = collect([$langObj]);
        return $obj;
    }

    private function getMockRelatedServices($currentId) {
        $data = [
            ['name' => 'Phát triển Mobile App', 'image' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?q=80&w=600'],
            ['name' => 'Hệ thống ERP Doanh nghiệp', 'image' => 'https://images.unsplash.com/photo-1551288049-bbbda5366a7a?q=80&w=600'],
            ['name' => 'Giải pháp Blockchain', 'image' => 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?q=80&w=600'],
        ];

        return collect($data)->map(function($item, $index) {
            $obj = (object)[
                'id' => $index + 200,
                'image' => $item['image'],
            ];
            $langPiv = (object)[
                'name' => $item['name'],
                'description' => 'Giải pháp công nghệ tiên tiến mang lại giá trị thực cho doanh nghiệp.',
                'canonical' => 'dich-vu-lien-quan-' . ($index + 200)
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
