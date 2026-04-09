<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\WorkProcess;
use App\Models\Language;

class WorkProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $steps = [
            [
                'name' => 'Khảo sát & Tư vấn',
                'description' => 'Chúng tôi tiến hành khảo sát thực tế và lắng nghe nhu cầu của khách hàng để đưa ra giải pháp tối ưu nhất.',
                'order' => 1,
            ],
            [
                'name' => 'Lập kế hoạch & Báo giá',
                'description' => 'Xây dựng kế hoạch triển khai chi tiết cùng báo giá minh bạch, phù hợp với ngân sách của dự án.',
                'order' => 2,
            ],
            [
                'name' => 'Thiết kế & Kiến trúc',
                'description' => 'Đội ngũ kiến trúc sư sáng tạo sẽ hoàn thiện bản vẽ thiết kế 2D/3D đáp ứng tính thẩm mỹ và công năng.',
                'order' => 3,
            ],
            [
                'name' => 'Triển khai & Thi công',
                'description' => 'Bắt đầu quá trình thi công thực tế dưới sự giám sát chặt chẽ, đảm bảo tiến độ và chất lượng công trình.',
                'order' => 4,
            ],
            [
                'name' => 'Kiểm tra & Nghiệm thu',
                'description' => 'Cùng khách hàng kiểm tra từng chi tiết dựa trên hợp đồng và bản vẽ trước khi chính thức bàn giao.',
                'order' => 5,
            ],
            [
                'name' => 'Bàn giao & Bảo hành',
                'description' => 'Hoàn tất bàn giao công trình và cam kết đồng hành cùng khách hàng trong suốt quá trình sử dụng.',
                'order' => 6,
            ],
        ];

        $language = Language::where('canonical', 'vn')->first();
        $languageId = $language->id ?? 1;

        // Clear existing data to avoid duplicates
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('work_process_language')->truncate();
        DB::table('work_processes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($steps as $step) {
            $workProcess = WorkProcess::create([
                'image' => 'frontend/resources/img/bricknet/process-' . $step['order'] . '.jpg',
                'publish' => 2,
                'order' => $step['order'],
                'user_id' => 1,
            ]);

            $workProcess->languages()->attach($languageId, [
                'name' => $step['name'],
                'description' => $step['description'],
                'content' => '',
            ]);
        }
    }
}
