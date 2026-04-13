<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Dọn dẹp dữ liệu cũ (Chỉ liên quan đến Post)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('posts')->truncate();
        DB::table('post_language')->truncate();
        DB::table('post_catalogue_post')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $userId = 4504; // ID user của bạn
        $languageId = 1; // Tiếng Việt
        $catalogueId = 1; // ID danh mục đã tìm thấy

        // 2. Danh sách 10 bài viết chuyên nghiệp
        $postsData = [
            [
                'title' => 'Chiến lược chuyển đổi số toàn diện cho doanh nghiệp Việt 2026',
                'excerpt' => 'Khám phá cách các doanh nghiệp hàng đầu đang áp dụng công nghệ để đột phá trong kỷ nguyên số.',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&q=80',
                'content' => $this->getContentDigitalTransformation()
            ],
            [
                'title' => 'Văn hóa Agile: Chìa khóa tăng năng suất đội ngũ tại Novan',
                'excerpt' => 'Tại sao chúng tôi chọn Agile để vận hành và cách nó giúp khách hàng nhận giá trị nhanh hơn.',
                'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80',
                'content' => $this->getContentAgile()
            ],
            [
                'title' => 'Tầm nhìn Novan: Trở thành đối tác công nghệ hàng đầu khu vực',
                'excerpt' => 'Hành trình và sứ mệnh của Novan trong việc định hình tương lai công nghệ tại Việt Nam.',
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&q=80',
                'content' => $this->getContentVision()
            ],
            [
                'title' => 'Cách tối ưu hóa vận hành doanh nghiệp bằng AI và Automation',
                'excerpt' => 'Tự động hóa không chỉ là xu hướng, đó là sự sống còn của doanh nghiệp hiện đại.',
                'image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=800&q=80',
                'content' => $this->getContentAI()
            ],
            [
                'title' => 'Tuyển dụng: Novan tìm kiếm 20 kỹ sư phần mềm tài năng',
                'excerpt' => 'Gia nhập đội ngũ Novan để cùng xây dựng những sản phẩm công nghệ thay đổi thế giới.',
                'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&q=80',
                'content' => $this->getContentRecruitment()
            ],
            [
                'title' => 'Review dự án: Hệ thống quản lý bất động sản Bricknet v2',
                'excerpt' => 'Cái nhìn chi tiết về giải pháp quản lý bất động sản toàn diện nhất hiện nay.',
                'image' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&q=80',
                'content' => $this->getContentBricknet()
            ],
            [
                'title' => 'Sức mạnh của dữ liệu trong việc ra quyết định kinh doanh',
                'excerpt' => 'Dữ liệu là dầu mỏ mới. Hãy học cách khai thác nó để đưa doanh nghiệp đi xa hơn.',
                'image' => 'https://images.unsplash.com/photo-1551288049-bbda48658a7d?w=800&q=80',
                'content' => $this->getContentDataPower()
            ],
            [
                'title' => 'Novan Charity 2026: Hành trình mang ánh sáng đến vùng cao',
                'excerpt' => 'Công nghệ không chỉ phục vụ kinh doanh, nó còn mang lại giá trị nhân văn cho cộng đồng.',
                'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=800&q=80',
                'content' => $this->getContentCharity()
            ],
            [
                'title' => 'Bảo mật thông tin: Ưu tiên hàng đầu trong kỷ nguyên số',
                'excerpt' => 'Làm thế nào để bảo vệ tài sản số của doanh nghiệp trước các mối đe dọa ngày càng tinh vi.',
                'image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=800&q=80',
                'content' => $this->getContentSecurity()
            ],
            [
                'title' => 'Kỷ niệm 5 năm thành lập Novan: Tự hào một hành trình',
                'excerpt' => 'Nhìn lại 5 năm xây dựng và phát triển với những cột mốc đáng nhớ.',
                'image' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=800&q=80',
                'content' => $this->getContentAnniversary()
            ],
        ];

        // 3. Thực hiện seeding
        foreach ($postsData as $index => $item) {
            $post = Post::create([
                'post_catalogue_id' => $catalogueId,
                'user_id' => $userId,
                'publish' => 2,
                'order' => $index + 1,
                'image' => $item['image'],
                'follow' => 1,
                'viewed' => rand(100, 5000),
            ]);

            $post->languages()->attach($languageId, [
                'name' => $item['title'],
                'canonical' => Str::slug($item['title']) . '-' . rand(100, 999),
                'description' => $item['excerpt'],
                'content' => $item['content'],
                'meta_title' => $item['title'],
                'meta_keyword' => 'novan, technology, software, ' . Str::slug($item['title'], ','),
                'meta_description' => $item['excerpt'],
            ]);

            $post->post_catalogues()->attach($catalogueId);
        }

        $this->command->info('PostSeeder: 10 structured posts have been seeded successfully.');
    }

    private function getContentDigitalTransformation() {
        return '<h2>Tại sao phải chuyển đổi số?</h2><p>Chuyển đổi số không còn là một lựa chọn, mà là một yêu cầu bắt buộc để tồn tại trong thị trường hiện nay.</p><ul><li>Tối ưu hóa quy trình làm việc.</li><li>Nâng cao trải nghiệm khách hàng.</li><li>Mở rộng thị trường nhanh chóng.</li></ul><p>Novan cung cấp các giải pháp ERP, CRM và AI tích hợp giúp doanh nghiệp của bạn sẵn sàng cho tương lai.</p>';
    }

    private function getContentAgile() {
        return '<h2>Agile tại Novan</h2><p>Chúng tôi tin rằng sự linh hoạt là yếu tố sống còn của phần mềm.</p><ul><li>Làm việc theo Sprint 2 tuần.</li><li>Phản hồi khách hàng liên tục.</li><li>Cải tiến quy trình mỗi ngày.</li></ul>';
    }

    private function getContentVision() {
        return '<h2>Tầm nhìn 2030</h2><p>Novan đặt mục tiêu trở thành công ty phần mềm Top 10 tại Đông Nam Á, mang giải pháp "Make in Vietnam" vươn tầm thế giới.</p>';
    }

    private function getContentAI() {
        return '<h2>AI trong vận hành</h2><p>Sử dụng AI để tự động hóa các tác vụ lặp đi lặp lại, giúp nhân viên tập trung vào các công việc sáng tạo và mang lại giá trị cao hơn.</p>';
    }

    private function getContentRecruitment() {
        return '<h2>Gia nhập Novan</h2><p>Chúng tôi đang tìm kiếm những trái tim đam mê công nghệ. Môi trường làm việc mở, trẻ trung và nhiều thử thách đang chờ đón bạn.</p>';
    }

    private function getContentBricknet() {
        return '<h2>Bricknet - Hệ sinh thái BĐS</h2><p>Bricknet v2 mang đến giải pháp quản lý giỏ hàng, khách hàng và booking vượt trội, giúp các sàn giao dịch bứt phá doanh số.</p>';
    }

    private function getContentDataPower() {
        return '<h2>Data-Driven Business</h2><p>Học cách sử dụng dữ liệu để dự báo xu hướng và giảm thiểu rủi ro trong kinh doanh. Cùng Novan xây dựng hệ thống Big Data chuyên nghiệp.</p>';
    }

    private function getContentCharity() {
        return '<h2>Trách nhiệm xã hội</h2><p>Mỗi năm, Novan trích 5% lợi nhuận để xây dựng trường học tại các vùng khó khăn. Chúng tôi tin rằng giáo dục là nền tảng của tương lai.</p>';
    }

    private function getContentSecurity() {
        return '<h2>Bảo mật đa tầng</h2><p>Trong thế giới số, mất dữ liệu là mất tất cả. Novan áp dụng các tiêu chuẩn bảo mật quốc tế để bảo vệ codebase và data của khách hàng.</p>';
    }

    private function getContentAnniversary() {
        return '<h2>5 năm một chặng đường</h2><p>Từ một văn phòng nhỏ đến đội ngũ 100 nhân sự chất lượng cao. Cảm ơn khách hàng và đối tác đã luôn đồng hành cùng Novan.</p>';
    }
}
