<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Repositories\Interfaces\ProjectRepositoryInterface  as ProjectRepository;
use App\Repositories\Interfaces\ProjectCatalogueRepositoryInterface as ProjectCatalogueRepository;
use Illuminate\Http\Request;

class ProjectController extends FrontendController
{
    protected $language;
    protected $system;
    protected $projectRepository;
    protected $projectCatalogueRepository;

    public function __construct(
        ProjectRepository $projectRepository,
        ProjectCatalogueRepository $projectCatalogueRepository,
    ) {
        $this->projectRepository = $projectRepository;
        $this->projectCatalogueRepository = $projectCatalogueRepository;
        parent::__construct();
    }

    public function index($id, $request)
    {
        $project = $this->projectRepository->getProjectById($id, $this->language);
        if (is_null($project)) {
            abort(404);
        }

        $projectCatalogue = $this->projectCatalogueRepository->getProjectCatalogueById($project->project_catalogue_id, $this->language);
        $projectCatalogueCanonical = ($projectCatalogue) ? ($projectCatalogue->languages->first()->pivot->canonical ?? '#') : '#';
        $breadcrumb = ($projectCatalogue) ? $this->projectCatalogueRepository->breadcrumb($projectCatalogue, $this->language) : [];

        // Fetch related projects (3 items)
        $relatedProjects = \App\Models\Project::where('project_catalogue_id', $project->project_catalogue_id)
            ->where('id', '!=', $id)
            ->where('publish', 2)
            ->with(['languages' => function($q) {
                $q->where('language_id', $this->language);
            }])
            ->limit(3)
            ->get();

        // Mock Data for Layout Sections
        $mockData = [
            'work_process' => [
                [
                    'title' => 'Chuẩn bị Công việc & Phát triển Ý tưởng',
                    'desc' => 'Chúng tôi bắt đầu bằng việc tìm hiểu nhu cầu và sở thích riêng biệt của khách hàng, xác định mục tiêu dự án và phát triển các bản phác thảo để tạo ra một tầm nhìn gắn kết.'
                ],
                [
                    'title' => 'Thiết kế Kiến trúc & Lập kế hoạch Chi tiết',
                    'desc' => 'Chuyển đổi ý tưởng thành các bản thiết kế kiến trúc chi tiết giúp tối đa hóa không gian, kết hợp hiệu quả khí hậu và phản ánh tính thẩm mỹ cũng như công năng hiện đại.'
                ],
                [
                    'title' => 'Thi công & Tích hợp Hệ thống',
                    'desc' => 'Thực hiện xây dựng chất lượng cao đồng thời tích hợp liền mạch các hệ thống tự động hóa và giải pháp năng lượng, cân bằng giữa sự đổi mới và tay nghề thủ công.'
                ],
                [
                    'title' => 'Bàn giao & Hướng dẫn Sử dụng',
                    'desc' => 'Trước khi hoàn tất, chúng tôi hướng dẫn khách hàng mọi khía cạnh của công trình, cung cấp các buổi định hướng chi tiết về tất cả các hệ thống thông minh và hoàn thiện.'
                ]
            ],
            'testimonial' => [
                'content' => 'Làm việc với Bricknet là một trải nghiệm tuyệt vời. Từ khâu thiết kế đến khâu bàn giao cuối cùng, họ đã mang lại mọi thứ chúng tôi tưởng tượng, thậm chí còn hơn thế nữa. Các tính năng thông minh rất liền mạch và độ hoàn thiện cực kỳ tinh xảo. Đây thực sự là tổ ấm lý tưởng.',
                'author' => 'Kevin Luke',
                'position' => 'Chủ đầu tư'
            ]
        ];

        $seo = seo($project);
        $system = $this->system;
        $config = $this->config();

        return view('frontend.project.project.index', compact(
            'project',
            'projectCatalogue',
            'projectCatalogueCanonical',
            'breadcrumb',
            'relatedProjects',
            'mockData',
            'seo',
            'system',
            'config'
        ));
    }

    private function config()
    {
        return [
            'language' => $this->language,
            'js' => [
                'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css',
            ],
            'css' => [
                'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css',
            ]
        ];
    }
}
