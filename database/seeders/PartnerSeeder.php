<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Partner;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('partners')->truncate();
        DB::table('partner_language')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $languageId = 1; // vi

        $partners = [
            [
                'name' => 'Google',
                'description' => 'Đối tác chiến lược cung cấp giải pháp điện toán đám mây và AI.',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/google/google-original.svg',
                'link' => 'https://google.com',
            ],
            [
                'name' => 'Amazon Web Services',
                'description' => 'Nền tảng điện toán đám mây toàn diện và phổ biến nhất thế giới.',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/amazonwebservices/amazonwebservices-original-wordmark.svg',
                'link' => 'https://aws.amazon.com',
            ],
            [
                'name' => 'Microsoft',
                'description' => 'Hợp tác phát triển giải pháp phần mềm và hạ tầng Azure.',
                'image' => 'https://cdn.simpleicons.org/microsoft/000000',
                'link' => 'https://microsoft.com',
            ],
            [
                'name' => 'Meta (Facebook)',
                'description' => 'Đối tác công nghệ mạng xã hội và giải pháp thực tế ảo.',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/facebook/facebook-original.svg',
                'link' => 'https://meta.com',
            ],
            [
                'name' => 'Apple',
                'description' => 'Hệ sinh thái thiết bị thông minh và phần mềm cao cấp.',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/apple/apple-original.svg',
                'link' => 'https://apple.com',
            ],
            [
                'name' => 'Oracle',
                'description' => 'Chuyên gia cơ sở dữ liệu và phần mềm quản trị doanh nghiệp.',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/oracle/oracle-original.svg',
                'link' => 'https://oracle.com',
            ],
            [
                'name' => 'DigitalOcean',
                'description' => 'Giải pháp máy chủ cloud tối ưu cho các nhà phát triển.',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/digitalocean/digitalocean-original.svg',
                'link' => 'https://digitalocean.com',
            ],
            [
                'name' => 'GitHub',
                'description' => 'Nền tảng quản lý mã nguồn và phát triển phần mềm cộng tác.',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/github/github-original.svg',
                'link' => 'https://github.com',
            ],
            [
                'name' => 'Cloudflare',
                'description' => 'Dẫn đầu về giải pháp bảo mật và tăng tốc website (CDN).',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/cloudflare/cloudflare-original.svg',
                'link' => 'https://cloudflare.com',
            ],
            [
                'name' => 'Docker',
                'description' => 'Công nghệ ảo hóa container hàng đầu cho việc triển khai.',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/docker/docker-original-wordmark.svg',
                'link' => 'https://docker.com',
            ],
            [
                'name' => 'Vercel',
                'description' => 'Nền tảng triển khai website và ứng dụng frontend xuất sắc.',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/vercel/vercel-original.svg',
                'link' => 'https://vercel.com',
            ],
            [
                'name' => 'Linux',
                'description' => 'Hệ điều hành cốt lõi cho các máy chủ bảo mật cao.',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/linux/linux-original.svg',
                'link' => 'https://linux.org',
            ],
        ];

        foreach ($partners as $idx => $p) {
            $partner = Partner::create([
                'image' => $p['image'],
                'link' => $p['link'],
                'publish' => 2,
                'order' => $idx + 1,
                'user_id' => 1,
            ]);

            $partner->languages()->attach($languageId, [
                'name' => $p['name'],
                'description' => $p['description'],
            ]);
        }
    }
}
