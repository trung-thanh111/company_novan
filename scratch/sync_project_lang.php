<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

$projects = [
    ['id' => 1, 'n' => 'Hệ thống Booking Online - Luxury Travel'],
    ['id' => 2, 'n' => 'Giải pháp ERP cho nhà máy may mặc'],
    ['id' => 3, 'n' => 'Thiết kế bộ nhận diện thương hiệu Bricknet'],
    ['id' => 4, 'n' => 'Chatbot AI hỗ trợ khách hàng đa ngôn ngữ']
];

foreach ($projects as $item) {
    DB::table('project_language')->updateOrInsert(
        ['project_id' => $item['id'], 'language_id' => 1],
        [
            'name' => $item['n'],
            'canonical' => Str::slug($item['n']),
            'content' => 'Nội dung chi tiết cho ' . $item['n'],
            'description' => 'Mô tả ngắn cho ' . $item['n'],
        ]
    );
}
echo "Done sync project language\n";
