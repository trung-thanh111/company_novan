<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectCatalogue;
use App\Models\ProjectCatalogueLanguage;
use Illuminate\Support\Str;

class ProjectCatalogueSeeder extends Seeder
{
    public function run(): void
    {
        $catalogues = [
            ['name' => 'Website & Ứng dụng', 'canonical' => 'website-ung-dung'],
            ['name' => 'Giải pháp Chuyển đổi số', 'canonical' => 'giai-phap-chuyen-doi-so'],
            ['name' => 'Thương hiệu & Marketing', 'canonical' => 'thuong-hieu-marketing'],
            ['name' => 'AI & Tự động hóa', 'canonical' => 'ai-tu-dong-hoa'],
        ];

        foreach ($catalogues as $index => $item) {
            $catalogue = ProjectCatalogue::create([
                'publish' => 2,
                'order' => $index + 1,
                'user_id' => 1,
            ]);

            ProjectCatalogueLanguage::create([
                'project_catalogue_id' => $catalogue->id,
                'language_id' => 1, // Tiếng Việt
                'name' => $item['name'],
                'canonical' => $item['canonical'],
                'description' => 'Mô tả ngắn cho danh mục ' . $item['name'],
            ]);
        }
    }
}
