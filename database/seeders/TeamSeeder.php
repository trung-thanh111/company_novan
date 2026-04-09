<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Team;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('teams')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $teams = [
            [
                'full_name' => 'Nguyễn Minh Quân',
                'title' => 'CEO & Founder',
                'phone' => '0912345678',
                'email' => 'quan.nguyen@company.com',
                'avatar' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=400&auto=format&fit=crop',
                'bio' => 'Với hơn 15 năm kinh nghiệm trong ngành công nghệ, ông Quân là người định hướng chiến lược và dẫn dắt công ty đạt được những thành tựu vượt bậc.',
                'zalo' => '0912345678', 'is_primary' => 1, 'publish' => 2, 'user_id' => 1,
            ],
            [
                'full_name' => 'Trần Thị Mỹ Hạnh',
                'title' => 'Chief Technology Officer (CTO)',
                'phone' => '0922334455',
                'email' => 'hanh.tran@company.com',
                'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=400&auto=format&fit=crop',
                'bio' => 'Chuyên gia về kiến trúc phần mềm và AI. Bà Hạnh chịu trách nhiệm phát triển các nền tảng cốt lõi và tích hợp công nghệ mới.',
                'zalo' => '0922334455', 'is_primary' => 2, 'publish' => 2, 'user_id' => 1,
            ],
            [
                'full_name' => 'Lê Hoàng Nam',
                'title' => 'Creative Director',
                'phone' => '0933445566',
                'email' => 'nam.le@company.com',
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=400&auto=format&fit=crop',
                'bio' => 'Người đứng sau những giao diện người dùng đỉnh cao, chú trọng vào trải nghiệm khách hàng và thẩm mỹ hiện đại.',
                'zalo' => '0933445566', 'is_primary' => 2, 'publish' => 2, 'user_id' => 1,
            ],
            [
                'full_name' => 'Phạm Thanh Thảo',
                'title' => 'Head of Marketing',
                'phone' => '0944556677',
                'email' => 'thao.pham@company.com',
                'avatar' => 'https://images.unsplash.com/photo-1580894732230-282b963aee24?q=80&w=400&auto=format&fit=crop',
                'bio' => 'Chuyên gia Marketing với khả năng phân tích thị trường nhạy bén, đưa thương hiệu tiếp cận khách hàng toàn cầu.',
                'zalo' => '0944556677', 'is_primary' => 2, 'publish' => 2, 'user_id' => 1,
            ],
            [
                'full_name' => 'Hoàng Văn Bách',
                'title' => 'Technical Lead',
                'phone' => '0911223344',
                'email' => 'bach.hoang@company.com',
                'avatar' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?q=80&w=400&auto=format&fit=crop',
                'bio' => 'Lãnh đạo đội ngũ lập trình viên, đảm bảo tiến độ và chất lượng mã nguồn cho các dự án phức tạp.',
                'zalo' => '0911223344', 'is_primary' => 2, 'publish' => 2, 'user_id' => 1,
            ],
            [
                'full_name' => 'Đặng Thụy Du',
                'title' => 'Senior UI/UX Designer',
                'phone' => '0922446688',
                'email' => 'du.dang@company.com',
                'avatar' => 'https://images.unsplash.com/photo-1567532939604-b6b5b0db2a04?q=80&w=400&auto=format&fit=crop',
                'bio' => 'Tập trung vào hành trình người dùng và tối ưu hóa chuyển đổi thông qua thiết kế giao diện tinh tế.',
                'zalo' => '0922446688', 'is_primary' => 2, 'publish' => 2, 'user_id' => 1,
            ],
            [
                'full_name' => 'Vũ Anh Tuấn',
                'title' => 'Backend Developer',
                'phone' => '0933557799',
                'email' => 'tuan.vu@company.com',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=400&auto=format&fit=crop',
                'bio' => 'Chuyên gia Laravel và kiến trúc microservices. Ưu tiên tính ổn định và bảo mật của dữ liệu.',
                'zalo' => '0933557799', 'is_primary' => 2, 'publish' => 2, 'user_id' => 1,
            ],
            [
                'full_name' => 'Mai Lan Hương',
                'title' => 'Frontend Developer',
                'phone' => '0944668811',
                'email' => 'huong.mai@company.com',
                'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=400&auto=format&fit=crop',
                'bio' => 'Đam mê ReactJS và hoạt ảnh mượt mà. Đảm bảo giao diện website hiển thị hoàn hảo trên mọi thiết bị.',
                'zalo' => '0944668811', 'is_primary' => 2, 'publish' => 2, 'user_id' => 1,
            ],
            [
                'full_name' => 'Bùi Vĩnh Phúc',
                'title' => 'AI Engineer',
                'phone' => '0911335577',
                'email' => 'phuc.bui@company.com',
                'avatar' => 'https://images.unsplash.com/photo-1552058544-f2b08422138a?q=80&w=400&auto=format&fit=crop',
                'bio' => 'Nghiên cứu và triển khai các mô hình Machine Learning, giúp doanh nghiệp tự động hóa xử lý dữ liệu.',
                'zalo' => '0911335577', 'is_primary' => 2, 'publish' => 2, 'user_id' => 1,
            ],
            [
                'full_name' => 'Nguyễn Thị Diễm My',
                'title' => 'Product Manager',
                'phone' => '0922558800',
                'email' => 'my.nguyen@company.com',
                'avatar' => 'https://images.unsplash.com/photo-1598550874175-4d0fe4a2c90d?q=80&w=400&auto=format&fit=crop',
                'bio' => 'Cầu nối giữa khách hàng và team kỹ thuật, đảm bảo sản phẩm hoàn thiện đúng mong đợi và mang lại giá trị.',
                'zalo' => '0922558800', 'is_primary' => 2, 'publish' => 2, 'user_id' => 1,
            ],
            [
                'full_name' => 'Đỗ Trọng Hiếu',
                'title' => 'DevOps Engineer',
                'phone' => '0933771133',
                'email' => 'hieu.do@company.com',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=400&auto=format&fit=crop',
                'bio' => 'Quản lý hạ tầng đám mây và quy trình CI/CD, đảm bảo hệ thống vận hành liên tục không gián đoạn.',
                'zalo' => '0933771133', 'is_primary' => 2, 'publish' => 2, 'user_id' => 1,
            ],
            [
                'full_name' => 'Ngô Bảo Châu',
                'title' => 'Quality Assurance (QA)',
                'phone' => '0944993355',
                'email' => 'chau.ngo@company.com',
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=400&auto=format&fit=crop',
                'bio' => 'Kỹ lưỡng trong việc kiểm định chất lượng, không bỏ sót bất kỳ lỗi nào để mang lại trải nghiệm tốt nhất.',
                'zalo' => '0944993355', 'is_primary' => 2, 'publish' => 2, 'user_id' => 1,
            ],
            [
                'full_name' => 'Trịnh Nam Sơn',
                'title' => 'Business Analyst',
                'phone' => '0911663300',
                'email' => 'son.trinh@company.com',
                'avatar' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400&auto=format&fit=crop',
                'bio' => 'Phân tích nghiệp vụ và tối ưu hóa giải pháp kinh doanh thông qua các công cụ phân tích dữ liệu chuyên sâu.',
                'zalo' => '0911663300', 'is_primary' => 2, 'publish' => 2, 'user_id' => 1,
            ],
            [
                'full_name' => 'Lý Thu Thủy',
                'title' => 'Account Manager',
                'phone' => '0922774411',
                'email' => 'thuy.ly@company.com',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=400&auto=format&fit=crop',
                'bio' => 'Chăm sóc và duy trì mối quan hệ bền bỉ với khách hàng, đối tác chiến lược của công ty.',
                'zalo' => '0922774411', 'is_primary' => 2, 'publish' => 2, 'user_id' => 1,
            ],
            [
                'full_name' => 'Kim Thái Dương',
                'title' => 'Technical Support',
                'phone' => '0933995522',
                'email' => 'duong.kim@company.com',
                'avatar' => 'https://images.unsplash.com/photo-1554151228-14d9def656ec?q=80&w=400&auto=format&fit=crop',
                'bio' => 'Hỗ trợ kỹ thuật 24/7, xử lý nhanh chóng mọi vấn đề phát sinh trong quá trình vận hành hệ thống.',
                'zalo' => '0933995522', 'is_primary' => 2, 'publish' => 2, 'user_id' => 1,
            ],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
