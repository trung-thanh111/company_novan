<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CoreValue;

class CoreValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coreValues = [
            [
                'image' => 'fa-diamond',
                'name' => 'Chất lượng tay nghề',
                'description' => 'Chúng tôi ưu tiên sự tỉ mỉ đến từng chi tiết và sử dụng vật liệu chất lượng cao để mang lại kết quả lâu dài, đặc biệt.',
                'content' => 'Chất lượng luôn là ưu tiên hàng đầu tại Bricknet. Chúng tôi cam kết mỗi viên gạch, mỗi mảng tường đều được hoàn thiện với độ chính xác cao nhất.',
                'order' => 1
            ],
            [
                'image' => 'fa-clock-o',
                'name' => 'Bàn giao đúng hạn',
                'description' => 'Chúng tôi coi trọng thời gian của bạn và đảm bảo các dự án được hoàn thành đúng kế hoạch đã cam kết.',
                'content' => 'Tiến độ dự án được kiểm soát chặt chẽ bởi đội ngũ quản lý giàu kinh nghiệm, đảm bảo không có sự chậm trễ không đáng có.',
                'order' => 2
            ],
            [
                'image' => 'fa-shield',
                'name' => 'An toàn là trên hết',
                'description' => 'Chúng tôi duy trì các tiêu chuẩn an toàn hàng đầu để bảo vệ cả đội ngũ của chúng tôi và tài sản của bạn.',
                'content' => 'An toàn lao động không chỉ là quy định mà là văn hóa tại Bricknet. Mọi quy trình thi công đều tuân thủ nghiêm ngặt các tiêu chuẩn an toàn.',
                'order' => 3
            ],
            [
                'image' => 'fa-bolt',
                'name' => 'Giải pháp đổi mới',
                'description' => 'Chúng tôi ưu tiên sáng tạo trong thiết kế và thi công để mang lại những giải pháp tối ưu nhất cho không gian sống.',
                'content' => 'Không ngừng cập nhật các công nghệ mới nhất trong ngành xây dựng để mang đến cho khách hàng những trải nghiệm sống hiện đại và tiện nghi.',
                'order' => 4
            ],
        ];

        foreach ($coreValues as $value) {
            $cv = CoreValue::create([
                'image' => $value['image'],
                'publish' => 2, // Active
                'order' => $value['order'],
                'user_id' => 1,
            ]);

            DB::table('core_value_language')->insert([
                'core_value_id' => $cv->id,
                'language_id' => 1, // VN
                'name' => $value['name'],
                'description' => $value['description'],
                'content' => $value['content'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
