<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Service;
use App\Models\ServiceCatalogue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('services')->truncate();
        DB::table('service_catalogues')->truncate();
        DB::table('service_language')->truncate();
        DB::table('service_catalogue_language')->truncate();
        DB::table('service_catalogue_service')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $languageId = 1; // vi

        $data = [
            [
                'name' => 'Giải pháp Phần mềm',
                'description' => 'Xây dựng hệ thống phần mềm tùy chỉnh, tối ưu hóa quy trình vận hành cho doanh nghiệp.',
                'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=600&auto=format&fit=crop',
                'services' => [
                    [
                        'name' => 'Thiết kế Website Doanh nghiệp',
                        'description' => 'Website chuẩn SEO, tốc độ cao, hỗ trợ đa nền tảng và tối ưu hóa chuyển đổi.',
                        'content' => '<h2>Dịch vụ Thiết kế Website</h2><p>Chúng tôi cung cấp giải pháp thiết kế website chuyên nghiệp, giúp doanh nghiệp khẳng định thương hiệu trên không gian số.</p><ul><li>Giao diện hiện đại, độc quyền.</li><li>Chuẩn SEO, tối ưu tốc độ tải trang.</li><li>Tương thích mọi thiết bị (Mobile Friendly).</li></ul>',
                        'image' => 'https://images.unsplash.com/photo-1547658719-da2b51169166?q=80&w=400&auto=format&fit=crop',
                    ],
                    [
                        'name' => 'Phát triển Mobile App (iOS & Android)',
                        'description' => 'Xây dựng ứng dụng di động mạnh mẽ, tích hợp các tính năng hiện đại như AI, thanh toán trực tuyến.',
                        'content' => '<h2>Phát triển Ứng dụng Di động</h2><p>Giải pháp Mobile App giúp doanh nghiệp kết nối trực tiếp với người dùng và tăng cường lòng trung thành của khách hàng.</p><ul><li>Native & Cross-platform (Flutter, React Native).</li><li>Bảo mật đa tầng.</li><li>Hỗ trợ đưa lên App Store & Play Store.</li></ul>',
                        'image' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?q=80&w=400&auto=format&fit=crop',
                    ],
                    [
                        'name' => 'Hệ thống Quản trị Doanh nghiệp (ERP)',
                        'description' => 'Số hóa toàn bộ quy trình từ quản lý nhân sự, kho bãi đến tài chính kế toán trên một nền tảng duy nhất.',
                        'content' => '<h2>Giải pháp ERP Tùy chỉnh</h2><p>Hệ thống ERP giúp doanh nghiệp vận hành trơn tru, giảm bớt các thao tác thủ công và sai sót dữ liệu.</p><ul><li>Tích hợp các phòng ban.</li><li>Báo cáo thời gian thực.</li><li>Phân quyền bảo mật chi tiết.</li></ul>',
                        'image' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?q=80&w=400&auto=format&fit=crop',
                    ],
                ],
            ],
            [
                'name' => 'Trí tuệ Nhân tạo (AI)',
                'description' => 'Tích hợp AI để tự động hóa, phân tích dữ liệu và nâng cao năng suất lao động.',
                'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?q=80&w=600&auto=format&fit=crop',
                'services' => [
                    [
                        'name' => 'Tích hợp Chatbot AI Thông minh',
                        'description' => 'Giải pháp CSKH tự động 24/7, hiểu ngôn ngữ tự nhiên và cá nhân hóa trải nghiệm.',
                        'content' => '<h2>Giải pháp Chatbot AI</h2><p>Chatbot thông minh giúp giảm thiểu chi phí vận hành và nâng cao tỷ lệ phản hồi khách hàng ngay lập tức.</p><ul><li>Tích hợp GPT-4, Gemini.</li><li>Kết nối đa kênh (Web, Facebook, Zalo).</li><li>Tự học thông qua dữ liệu doanh nghiệp.</li></ul>',
                        'image' => 'https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?q=80&w=400&auto=format&fit=crop',
                    ],
                    [
                        'name' => 'Phân tích Dữ liệu AI (Big Data)',
                        'description' => 'Khai phá giá trị từ kho dữ liệu lớn để dự báo xu hướng và hỗ trợ ra quyết định kinh doanh.',
                        'content' => '<h2>Big Data & AI Analytics</h2><p>Giải pháp giúp bạn hiểu sâu về khách hàng và tối ưu hóa chuỗi cung ứng dựa trên dữ liệu thực tế.</p><ul><li>Trực quan hóa dữ liệu (Dashboard).</li><li>Hệ thống gợi ý sản phẩm cá nhân hóa.</li><li>Dự báo doanh số và rủi ro.</li></ul>',
                        'image' => 'https://images.unsplash.com/photo-1551288049-bbbda536ad31?q=80&w=400&auto=format&fit=crop',
                    ],
                    [
                        'name' => 'Nhận diện Khuôn mặt & Hình ảnh',
                        'description' => 'Công nghệ Vision AI ứng dụng trong chấm công, bảo mật và kiểm soát ra vào tự động.',
                        'content' => '<h2>Computer Vision AI</h2><p>Tăng cường an ninh và tiện ích thông qua nhận diện hình ảnh chính xác cao.</p><ul><li>Độ chính xác > 99%.</li><li>Xử lý thời gian thực.</li><li>Tích hợp với hệ thống phần cứng sẵn có.</li></ul>',
                        'image' => 'https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?q=80&w=400&auto=format&fit=crop',
                    ],
                ],
            ],
            [
                'name' => 'Hạ tầng & Bảo mật',
                'description' => 'Cung cấp nền tảng vận hành an toàn, ổn định và có khả năng mở rộng không giới hạn.',
                'image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc4b?q=80&w=600&auto=format&fit=crop',
                'services' => [
                    [
                        'name' => 'Dịch vụ Thuê Cloud Server (VPC)',
                        'description' => 'Máy chủ ảo riêng tốc độ cao, băng thông rộng, đảm bảo website và ứng dụng luôn uptime 99.9%.',
                        'content' => '<h2>Hạ tầng Cloud Tin cậy</h2><p>Đưa doanh nghiệp của bạn lên mây với chi phí tối ưu và tính ổn định cao nhất.</p><ul><li>Lưu trữ SSD/NVMe tốc độ cao.</li><li>Backup dữ liệu hàng ngày.</li><li>Quản trị hạ tầng trọn gói.</li></ul>',
                        'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=400&auto=format&fit=crop',
                    ],
                    [
                        'name' => 'Bảo mật & Phòng chống tấn công',
                        'description' => 'Giải pháp bảo vệ hệ thống trước các mối đe dọa mạng như DDoS, SQL Injection, mã độc.',
                        'content' => '<h2>An ninh Mạng Toàn diện</h2><p>Bảo vệ tài sản số của doanh nghiệp là ưu tiên hàng đầu của chúng tôi.</p><ul><li>Quét lỗ hổng bảo mật định kỳ.</li><li>Thiết lập tường lửa đa lớp (WAF).</li><li>Ứng phó sự cố 24/7.</li></ul>',
                        'image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=400&auto=format&fit=crop',
                    ],
                    [
                        'name' => 'Quản trị Hệ thống CNTT (Managed Services)',
                        'description' => 'Chúng tôi thay bạn quản lý toàn bộ hạ tầng kỹ thuật để bạn tập trung hoàn toàn vào kinh doanh.',
                        'content' => '<h2>Dịch vụ Quản trị IT Outsourcing</h2><p>Giải pháp tiết kiệm chi phí nhân sự IT mà vẫn đảm bảo hệ thống luôn hiện đại và an toàn.</p><ul><li>Đội ngũ kỹ sư hỗ trợ trực tuyến & trực tiếp.</li><li>Đảm bảo tiêu chuẩn vận hành quốc tế.</li><li>Tư vấn nâng cấp công nghệ định kỳ.</li></ul>',
                        'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=400&auto=format&fit=crop',
                    ],
                ],
            ],
            [
                'name' => 'Chuyển đổi số (DX)',
                'description' => 'Tư vấn và thực thi chiến lược chuyển đổi số giúp doanh nghiệp bứt phá trong kỷ nguyên mới.',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=600&auto=format&fit=crop',
                'services' => [
                    [
                        'name' => 'Tư vấn Chiến lược Chuyển đổi số',
                        'description' => 'Đánh giá hiện trạng và xây dựng lộ trình số hóa phù hợp với đặc thù từng doanh nghiệp.',
                        'content' => '<h2>Chiến lược DX Toàn diện</h2><p>Chuyển đổi số không chỉ là công nghệ, mà là sự thay đổi tư duy và quy trình làm việc.</p><ul><li>Số hóa quy trình giấy tờ.</li><li>Xây dựng văn hóa số trong doanh nghiệp.</li><li>Đo lường hiệu quả bằng các chỉ số KPI số.</li></ul>',
                        'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=400&auto=format&fit=crop',
                    ],
                    [
                        'name' => 'Giải pháp Văn phòng Số (e-Office)',
                        'description' => 'Hệ thống quản lý công việc, ký duyệt điện tử và lưu trữ tài liệu tập trung không dùng giấy.',
                        'content' => '<h2>Văn phòng Số Hiện đại</h2><p>Tăng tốc độ xử lý công việc và tiết kiệm chi phí vận hành văn phòng tối đa.</p><ul><li>Ký duyệt online mọi lúc mọi nơi.</li><li>Quản lý dự án theo mô hình Agile/Scrum.</li><li>Kho lưu trữ dữ liệu dùng chung bảo mật.</li></ul>',
                        'image' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=400&auto=format&fit=crop',
                    ],
                    [
                        'name' => 'Đào tạo và Chuyển giao Công nghệ',
                        'description' => 'Nâng cao năng lực số cho đội ngũ nhân sự doanh nghiệp để thích ứng với hệ thống mới.',
                        'content' => '<h2>Đào tạo Năng lực Số</h2><p>Chúng tôi đồng hành cùng đội ngũ của bạn để đảm bảo việc ứng dụng công nghệ thành công bền vững.</p><ul><li>Hệ thống hóa kiến thức công nghệ.</li><li>Đào tạo thực chiến trên dự án thật.</li><li>Chứng nhận hoàn thành khóa đào tạo.</li></ul>',
                        'image' => 'https://images.unsplash.com/photo-1524178232363-1fb28f74b0cd?q=80&w=400&auto=format&fit=crop',
                    ],
                ],
            ],
            [
                'name' => 'Marketing & Thương hiệu',
                'description' => 'Chiến lược marketing tổng thể giúp doanh nghiệp tăng trưởng bứt phá doanh thu.',
                'image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=600&auto=format&fit=crop',
                'services' => [
                    [
                        'name' => 'Dịch vụ SEO Tổng thể',
                        'description' => 'Đưa website lên top Google bền vững, tăng lưu lượng truy cập tự nhiên chất lượng cao.',
                        'content' => '<h2>Dịch vụ SEO Chuyên nghiệp</h2><p>Chúng tôi tập trung vào bộ từ khóa chuyển đổi cao, giúp thu hút khách hàng tiềm năng thực sự quan tâm đến dịch vụ.</p><ul><li>Audit website chi tiết.</li><li>SEO Onpage & Offpage bền vững.</li><li>Báo cáo kết quả minh bạch hàng tháng.</li></ul>',
                        'image' => 'https://images.unsplash.com/photo-1562577309-4932fdd64cd1?q=80&w=400&auto=format&fit=crop',
                    ],
                    [
                        'name' => 'Quản trị Thương hiệu & Social Media',
                        'description' => 'Xây dựng hình ảnh chuyên nghiệp trên mạng xã hội và các kênh truyền thông số.',
                        'content' => '<h2>Social Brand Management</h2><p>Kể câu chuyện thương hiệu của bạn một cách hấp dẫn và nhất quán trên mọi nền tảng.</p><ul><li>Sáng tạo nội dung đa phương tiện.</li><li>Chạy quảng cáo mục tiêu (Ads).</li><li>Tương tác và xử lý khủng hoảng truyền thông.</li></ul>',
                        'image' => 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?q=80&w=400&auto=format&fit=crop',
                    ],
                    [
                        'name' => 'Sản xuất Nội dung Số & Video',
                        'description' => 'Dịch vụ quay phim, chụp ảnh và biên tập video giới thiệu doanh nghiệp/sản phẩm chuyên nghiệp.',
                        'content' => '<h2>Digital Content Production</h2><p>Hình ảnh và video chất lượng cao là chìa khóa để giữ chân khách hàng trong thời đại số.</p><ul><li>Quay phim TVC quảng cáo.</li><li>Livestream sự kiện chuyên nghiệp.</li><li>Thiết kế ấn phẩm đồ họa nhận diện.</li></ul>',
                        'image' => 'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?q=80&w=400&auto=format&fit=crop',
                    ],
                ],
            ],
        ];

        foreach ($data as $idx => $group) {
            $catalogue = ServiceCatalogue::create([
                'parent_id' => 0,
                'lft' => ($idx * 2) + 1,
                'rgt' => ($idx * 2) + 2,
                'level' => 1,
                'publish' => 2,
                'user_id' => 1,
                'order' => $idx + 1,
                'image' => $group['image'],
            ]);

            $catalogue->languages()->attach($languageId, [
                'name' => $group['name'],
                'canonical' => Str::slug($group['name']),
                'description' => $group['description'],
                'content' => '<p>' . e($group['description']) . '</p>',
            ]);

            foreach ($group['services'] as $order => $s) {
                $service = Service::create([
                    'publish' => 2,
                    'order' => $order + 1,
                    'user_id' => 1,
                    'image' => $s['image'],
                    'service_catalogue_id' => $catalogue->id,
                ]);

                $service->languages()->attach($languageId, [
                    'name' => $s['name'],
                    'canonical' => Str::slug($s['name']),
                    'description' => $s['description'],
                    'content' => $s['content'],
                ]);

                $service->service_catalogues()->attach($catalogue->id);
            }
        }
    }
}
