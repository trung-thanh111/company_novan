<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Faq;
use App\Models\FaqCatalogue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('faqs')->truncate();
        DB::table('faq_catalogues')->truncate();
        DB::table('faq_language')->truncate();
        DB::table('faq_catalogue_language')->truncate();
        DB::table('faq_catalogue_faq')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $languageId = 1; // vi

        $data = [
            [
                'name' => 'Quy trình & Hợp tác',
                'description' => 'Giải đáp thắc mắc về cách thức bắt đầu dự án và quy trình làm việc.',
                'faqs' => [
                    [
                        'name' => 'Làm thế nào để bắt đầu một dự án mới với công ty?',
                        'content' => '<p>Để bắt đầu, quý khách có thể liên hệ qua hotline hoặc để lại thông tin tại form "Liên hệ". Đội ngũ tư vấn sẽ phản hồi trong vòng 24h để lấy yêu cầu chi tiết và gửi báo giá sơ bộ.</p>',
                    ],
                    [
                        'name' => 'Thời gian trung bình để hoàn thành một website là bao lâu?',
                        'content' => '<p>Thời gian phụ thuộc vào quy mô dự án. Thông thường, một website giới thiệu doanh nghiệp mất từ 2-4 tuần, trong khi các hệ thống phức tạp hơn có thể mất 3-6 tháng.</p>',
                    ],
                    [
                        'name' => 'Công ty có nhận các dự án ở nước ngoài không?',
                        'content' => '<p>Có, chúng tôi có đội ngũ sử dụng thông thạo tiếng Anh và đã từng triển khai thành công nhiều dự án cho khách hàng tại Nhật Bản, Úc và Châu Âu thông qua hình thức làm việc từ xa.</p>',
                    ],
                ],
            ],
            [
                'name' => 'Bảo trì & Hỗ trợ',
                'description' => 'Các thông tin về chính sách bảo hành, cập nhật phần mềm.',
                'faqs' => [
                    [
                        'name' => 'Chế độ bảo hành và bảo trì phần mềm như thế nào?',
                        'content' => '<p>Chúng tôi cam kết bảo trì miễn phí lỗi kỹ thuật trong vòng 12 tháng đầu tiên. Sau đó, quý khách có thể gia hạn gói hỗ trợ định kỳ để đảm bảo hệ thống luôn hoạt động ổn định.</p>',
                    ],
                    [
                        'name' => 'Công ty có hỗ trợ hướng dẫn sử dụng không?',
                        'content' => '<p>Có, sau khi bàn giao, chúng tôi sẽ cung cấp tài liệu hướng dẫn và tổ chức một buổi training để đảm bảo nhân sự của quý khách làm chủ được hệ thống.</p>',
                    ],
                    [
                        'name' => 'Làm thế nào để yêu cầu hỗ trợ kỹ thuật khẩn cấp?',
                        'content' => '<p>Quý khách có thể gọi đến hotline hỗ trợ 24/7 dành riêng cho khách hàng VIP hoặc gửi ticket qua hệ thống quản lý dự án của chúng tôi để được xử lý trong vòng 1-2h.</p>',
                    ],
                ],
            ],
            [
                'name' => 'Chi phí & Thanh toán',
                'description' => 'Thông tin về giá cả và các hình thức giao dịch.',
                'faqs' => [
                    [
                        'name' => 'Chi phí triển khai được tính như thế nào?',
                        'content' => '<p>Chi phí thường bao gồm: phí phát triển (một lần), phí hạ tầng vận hành (hàng năm) và phí bảo trì (tùy chọn). Chúng tôi sẽ gửi bảng kê chi tiết cho từng hạng mục.</p>',
                    ],
                    [
                        'name' => 'Phương thức thanh toán linh hoạt như thế nào?',
                        'content' => '<p>Chúng tôi chia làm nhiều đợt thanh toán theo tiến độ dự án (ví dụ: 30% khi ký hợp đồng, 40% khi hoàn thành mẫu thiết kế, 30% khi nghiệm thu bàn giao) để giảm áp lực tài chính cho đối tác.</p>',
                    ],
                ],
            ],
            [
                'name' => 'Công nghệ & Bảo mật',
                'description' => 'Các thắc mắc liên quan đến nền tảng kỹ thuật và an toàn dữ liệu.',
                'faqs' => [
                    [
                        'name' => 'Công ty sử dụng nền tảng công nghệ gì?',
                        'content' => '<p>Chúng tôi sử dụng các công nghệ hiện đại nhất như Laravel (PHP), React/NextJS, Flutter cho ứng dụng di động và Google Cloud/AWS cho hạ tầng lưu trữ.</p>',
                    ],
                    [
                        'name' => 'Dữ liệu của khách hàng có được bảo mật tuyệt đối không?',
                        'content' => '<p>Chúng tôi áp dụng quy chuẩn bảo mật ISO 27001, mọi dữ liệu đều được mã hóa và có quy trình sao lưu định kỳ, cam kết không tiết lộ thông tin dự án cho bên thứ ba.</p>',
                    ],
                    [
                        'name' => 'Hệ thống có khả năng mở rộng trong tương lai không?',
                        'content' => '<p>Hoàn toàn có thể. Chúng tôi thiết kế kiến trúc phần mềm theo dạng module và microservices, cho phép dễ dàng tích hợp thêm các tính năng mới khi quy mô kinh doanh của bạn tăng trưởng.</p>',
                    ],
                    [
                        'name' => 'Công ty có hỗ trợ chuyển đổi dữ liệu từ hệ thống cũ không?',
                        'content' => '<p>Chúng tôi có đội ngũ chuyên gia về Migration dữ liệu, đảm bảo việc chuyển đổi từ hệ thống cũ sang nền tảng mới diễn ra an toàn, không làm mất mát thông tin quan trọng.</p>',
                    ],
                ],
            ],
            [
                'name' => 'Nhân sự & Văn hóa',
                'description' => 'Tìm hiểu thêm về con người và môi trường làm việc.',
                'faqs' => [
                    [
                        'name' => 'Trình độ chuyên môn của đội ngũ kỹ thuật như thế nào?',
                        'content' => '<p>Đội ngũ của chúng tôi 100% là các kỹ sư tốt nghiệp các trường đại học hàng đầu về CNTT, sở hữu các chứng chỉ quốc tế và có ít nhất 3-5 năm kinh nghiệm thực chiến.</p>',
                    ],
                    [
                        'name' => 'Công ty có nhận thực tập sinh hoặc đào tạo nội bộ không?',
                        'content' => '<p>Chúng tôi có chương trình "Tech Talent" hàng năm để tìm kiếm và đào tạo các tài năng trẻ, đóng góp cho cộng đồng lập trình viên Việt Nam.</p>',
                    ],
                    [
                        'name' => 'Văn hóa làm việc tại công ty có gì khác biệt?',
                        'content' => '<p>Chúng tôi đề cao tính minh bạch, sáng tạo và lấy khách hàng làm trọng tâm. Mọi thành viên đều được khuyến khích đưa ra các giải pháp đột phá thay vì chỉ làm theo yêu cầu.</p>',
                    ],
                ],
            ],
        ];

        foreach ($data as $idx => $group) {
            $catalogue = FaqCatalogue::create([
                'parent_id' => 0,
                'lft' => ($idx * 2) + 1,
                'rgt' => ($idx * 2) + 2,
                'level' => 1,
                'publish' => 2,
                'user_id' => 1,
                'order' => $idx + 1,
            ]);

            $catalogue->languages()->attach($languageId, [
                'name' => $group['name'],
                'canonical' => Str::slug($group['name']),
                'description' => $group['description'],
            ]);

            foreach ($group['faqs'] as $order => $f) {
                $faq = Faq::create([
                    'publish' => 2,
                    'order' => $order + 1,
                    'user_id' => 1,
                ]);

                $faq->languages()->attach($languageId, [
                    'name' => $f['name'],
                    'canonical' => Str::slug($f['name']),
                    'content' => $f['content'],
                ]);

                $faq->faq_catalogues()->attach($catalogue->id);
            }
        }
    }
}
