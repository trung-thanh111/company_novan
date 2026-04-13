<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectLanguage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\Project::truncate();
        \App\Models\ProjectLanguage::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $projects = [
            [
                'name' => 'Hệ thống Booking Online - Luxury Travel',
                'catalogue_id' => 1, // Website
                'value' => 450000000,
                'scale' => 'Hỗ trợ 10.000 user/phút',
                'customer' => 'Luxury Travel Group',
                'status' => 'Đã hoàn thành',
                'location' => 'Toàn cầu',
                'start_date' => Carbon::now()->subMonths(4),
                'end_date' => Carbon::now()->subMonths(1),
                'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'Giải pháp ERP cho nhà máy may mặc',
                'catalogue_id' => 2, // Chuyển đổi số
                'value' => 1200000000,
                'scale' => '500 nhân sự sử dụng',
                'customer' => 'Garment JS Center',
                'status' => 'Đang triển khai',
                'location' => 'Bình Dương - Đồng Nai',
                'start_date' => Carbon::now()->subMonths(10),
                'end_date' => Carbon::now()->addMonths(6),
                'image' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'Thiết kế bộ nhận diện thương hiệu Bricknet',
                'catalogue_id' => 3, // Marketing
                'value' => 85000000,
                'scale' => 'Hạng mục: Logo, POSM, Web UI',
                'customer' => 'Bricknet Co., Ltd',
                'status' => 'Đã hoàn thành',
                'location' => 'Online',
                'start_date' => Carbon::now()->subMonths(2),
                'end_date' => Carbon::now()->subMonths(1),
                'image' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'Chatbot AI hỗ trợ khách hàng đa ngôn ngữ',
                'catalogue_id' => 4, // AI
                'value' => 320000000,
                'scale' => 'Tự động hóa 80% ticket',
                'customer' => 'TechGlobal Corp',
                'status' => 'Đang triển khai',
                'location' => 'Đà Nẵng',
                'start_date' => Carbon::now()->subMonth(),
                'end_date' => Carbon::now()->addMonths(3),
                'image' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?q=80&w=1200&auto=format&fit=crop',
            ]
        ];

        foreach ($projects as $index => $item) {
            $project = Project::create([
                'project_catalogue_id' => $item['catalogue_id'],
                'image' => $item['image'],
                'user_id' => 1,
                'publish' => 2,
                'order' => $index + 1,
                'value' => $item['value'],
                'scale' => $item['scale'],
                'location' => $item['location'],
                'customer' => $item['customer'],
                'status' => $item['status'],
                'start_date' => $item['start_date'],
                'end_date' => $item['end_date'],
            ]);

            ProjectLanguage::create([
                'project_id' => $project->id,
                'language_id' => 1,
                'name' => $item['name'],
                'canonical' => Str::slug($item['name']),
                'content' => 'Nội dung chi tiết cho dự án ' . $item['name'],
                'description' => 'Mô tả ngắn gọn về dự án ' . $item['name'],
            ]);

        }
    }
}
