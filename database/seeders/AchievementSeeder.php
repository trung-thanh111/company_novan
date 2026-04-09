<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Achievement;
use Illuminate\Support\Facades\DB;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('achievements')->truncate();
        DB::table('achievement_language')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $languageId = 1; // vi

        $achievements = [
            [
                'name' => 'Giải thưởng Sáng tạo Công nghệ 2024',
                'description' => 'Vinh danh những đóng góp vượt bậc trong việc ứng dụng AI vào thực tiễn sản xuất và kinh doanh.',
                'image' => 'https://images.unsplash.com/photo-1578262825743-a4e402caab76?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Top 10 Doanh nghiệp ICT tiêu biểu',
                'description' => 'Ghi nhận bởi Hiệp hội Phần mềm và Dịch vụ CNTT Việt Nam (VINASA) về sự tăng trưởng và uy tín.',
                'image' => 'https://images.unsplash.com/photo-1549421263-5ec394a5ad4c?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Chứng chỉ Bảo mật Quốc tế ISO 27001',
                'description' => 'Khẳng định quy chuẩn bảo mật dữ liệu khách hàng đạt cấp độ quốc tế.',
                'image' => 'https://images.unsplash.com/photo-1627483262769-04d0a1401487?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Giải thưởng Thiết kế Trải nghiệm Người dùng (UX) 2023',
                'description' => 'Sản phẩm có giao diện thân thiện và trải nghiệm người dùng tối ưu nhất trong năm.',
                'image' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Cúp vàng Chuyển đổi số Việt Nam',
                'description' => 'Dành cho các cơ quan, đơn vị, doanh nghiệp có giải pháp chuyển đổi số xuất sắc.',
                'image' => 'https://images.unsplash.com/photo-1595181512136-22448378d38f?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Top 500 Doanh nghiệp lớn nhất Việt Nam (VNR500)',
                'description' => 'Khẳng định vị thế và quy mô phát triển bền vững của công ty trong nền kinh tế.',
                'image' => 'https://images.unsplash.com/photo-1523292562811-3957297e64f8?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Thương hiệu Quốc gia Việt Nam',
                'description' => 'Hệ thống chương trình xúc tiến thương mại dài hạn nhằm xây dựng và quảng bá thương hiệu.',
                'image' => 'https://images.unsplash.com/photo-1614852206758-0caebadb3b25?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Danh hiệu Sao Khuê 5 sao',
                'description' => 'Chứng nhận cho các giải pháp phần mềm và dịch vụ CNTT xuất sắc tại thị trường nội địa.',
                'image' => 'https://images.unsplash.com/photo-1635332043277-5138f62fa19b?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Giải thưởng Make in Viet Nam 2022',
                'description' => 'Công nhận các sản phẩm công nghệ số được thiết kế, sáng tạo và sản xuất tại Việt Nam.',
                'image' => 'https://images.unsplash.com/photo-1589187151032-573a91d17673?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Chứng nhận AWS Select Tier Partner',
                'description' => 'Cấp bậc đối tác được công nhận bởi Amazon Web Services về năng lực kỹ thuật đám mây.',
                'image' => 'https://images.unsplash.com/photo-1614741118887-7a4ee193a5fa?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Google Cloud Specialization',
                'description' => 'Chứng nhận chuyên sâu về phân tích dữ liệu và hạ tầng điện toán đám mây từ Google.',
                'image' => 'https://images.unsplash.com/photo-1573804633927-bfcbcd909acd?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Giải thưởng Smart City 2021',
                'description' => 'Vinh danh cho các giải pháp đô thị thông minh đóng góp vào sự phát triển xã hội.',
                'image' => 'https://images.unsplash.com/photo-1449824913935-188605b82030?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Top 50 Start-up có sức ảnh hưởng nhất',
                'description' => 'Bình chọn bởi các tạp chí kinh tế hàng đầu về mô hình kinh doanh đột phá.',
                'image' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Bằng khen của Bộ Thông tin & Truyền thông',
                'description' => 'Ghi nhận những đóng góp cho sự nghiệp phát triển ngành CNTT nước nhà.',
                'image' => 'https://images.unsplash.com/photo-1605810230434-7631ac76ec81?q=80&w=400&auto=format&fit=crop',
            ],
            [
                'name' => 'Huy chương Vàng ICT Việt Nam',
                'description' => 'Giải thưởng uy tín do Hội Tin học Việt Nam tổ chức hàng năm.',
                'image' => 'https://images.unsplash.com/photo-1589482236193-477082989c25?q=80&w=400&auto=format&fit=crop',
            ],
        ];

        foreach ($achievements as $idx => $a) {
            $achievement = Achievement::create([
                'image' => $a['image'],
                'publish' => 2,
                'order' => $idx + 1,
                'user_id' => 1,
            ]);

            $achievement->languages()->attach($languageId, [
                'name' => $a['name'],
                'description' => $a['description'],
            ]);
        }
    }
}
