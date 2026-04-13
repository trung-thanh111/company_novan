<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $rows = [];
        $names = [
            ['fullname' => 'Nguyễn Văn A', 'gender' => 'male'],
            ['fullname' => 'Trần Thị B', 'gender' => 'female'],
            ['fullname' => 'Lê Văn C', 'gender' => 'male'],
            ['fullname' => 'Phạm Thị D', 'gender' => 'female'],
            ['fullname' => 'Hoàng Văn E', 'gender' => 'male'],
            ['fullname' => 'Đặng Thị F', 'gender' => 'female'],
            ['fullname' => 'Võ Văn G', 'gender' => 'male'],
            ['fullname' => 'Phan Thị H', 'gender' => 'female'],
            ['fullname' => 'Bùi Văn I', 'gender' => 'male'],
            ['fullname' => 'Đỗ Thị K', 'gender' => 'female'],
        ];

        foreach ($names as $index => $info) {
            $rows[] = [
                'reviewable_type' => null,
                'reviewable_id'   => null,
                'email'           => 'client' . ($index + 1) . '@example.com',
                'gender'          => $info['gender'],
                'fullname'        => $info['fullname'],
                'phone'           => '09' . rand(10000000, 99999999),
                'description'     => 'Dịch vụ rất chuyên nghiệp, đội ngũ hỗ trợ tận tâm và tiến độ thi công đúng cam kết.',
                'score'           => rand(4, 5),
                'status'          => 1,
                'image'           => null,
                'created_at'      => $now,
                'updated_at'      => $now,
            ];
        }

        DB::table('reviews')->insert($rows);
    }
}

