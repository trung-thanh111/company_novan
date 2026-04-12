@extends('frontend.homepage.layout')

@push('styles')
    <style>
        /* High-Fidelity Refinement Styles */
        :root {
            --bn-gray-light: #f8fafc;
            --bn-text-muted: #64748b;
        }

        /* Hero Section with Static BG */
        .bn-section-hero-static {
            position: relative;
            padding: 160px 0 140px;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #ffffff;
            overflow: hidden;
        }

        .bn-section-hero-static::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.65));
            z-index: 1;
        }

        .bn-section-hero-static .bn-container {
            position: relative;
            z-index: 2;
        }

        .bn-section-hero-static .bn-sec-title--big {
            color: #ffffff !important;
        }

        /* Stats Bar with Counting Animation & Alternating Colors */
        .bn-section-stats-bar {
            margin-top: -80px;
            position: relative;
            z-index: 100;
        }

        .bn-stats-card {
            background: #ffffff;
            border-radius: 30px;
            padding: 50px 40px;
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.12);
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
        }

        .bn-stat-v3 {
            flex: 1;
            min-width: 200px;
            text-align: center;
            padding: 20px;
            position: relative;
        }

        .bn-stat-v3:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 50px;
            width: 1px;
            background: #f1f5f9;
        }

        .bn-stat-v3__num {
            display: block;
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 12px;
            font-family: var(--bn-font-display);
        }

        .bn-stat-v3__label {
            font-size: 14px;
            font-weight: 700;
            color: var(--bn-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.15em;
        }

        /* Alternating Colors for Stats (Primary & Accent) */
        .bn-stat-v3:nth-child(odd) .bn-stat-v3__num { color: var(--bn-primary); }
        .bn-stat-v3:nth-child(even) .bn-stat-v3__num { color: var(--bn-accent); }

        /* Our Story (Image 2 Style) */
        .bn-section-story-v2 {
            padding: 130px 0;
            background: #ffffff;
        }

        .bn-story-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 80px;
            align-items: center;
        }

        .bn-story-image {
            position: relative;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 40px 80px rgba(0,0,0,0.1);
        }

        .bn-story-image img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.6s ease;
        }

        .bn-story-image:hover img {
            transform: scale(1.03);
        }

        /* Project Cards Refinement (Image 2 Style) */
        .bn-project-card-v2 {
            margin-bottom: 40px;
        }

        .bn-project-card-v2__img {
            height: 440px;
            overflow: hidden;
            border-radius: 0;
            margin-bottom: 25px;
        }

        .bn-project-card-v2__img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .bn-project-card-v2:hover .bn-project-card-v2__img img {
            transform: scale(1.1);
        }

        .bn-project-card-v2__title {
            font-size: 1.85rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--bn-primary);
            line-height: 1.2;
        }

        .bn-project-card-v2__link {
            font-size: 1rem;
            font-weight: 600;
            color: var(--bn-primary);
            display: inline-flex;
            align-items: center;
            gap: 12px;
            transition: 0.3s;
        }

        .bn-project-card-v2__link i {
            font-size: 14px;
        }

        .bn-project-card-v2:hover .bn-project-card-v2__link {
            color: var(--bn-accent);
        }

        .bn-feature-item {
            display: flex;
            gap: 25px;
            padding: 30px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .bn-feature-item:last-child {
            border-bottom: none;
        }

        .bn-feature-icon {
            width: 54px;
            height: 54px;
            flex-shrink: 0;
            background: rgba(255, 110, 64, 0.1);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--bn-accent);
            font-size: 24px;
        }

        .bn-feature-content {
            flex: 1;
        }

        .bn-feature-content h3 {
            font-size: 1.35rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--bn-primary);
        }

        .bn-feature-content p {
            color: var(--bn-text-muted);
            line-height: 1.6;
            font-size: 0.95rem;
            margin: 0; /* Ensure no extra spacing hides content */
        }

        /* Video Section Refinement */
        .bn-section-video {
            position: relative;
            min-height: 700px;
            display: flex;
            align-items: center;
            overflow: hidden;
            background: #0f172a;
        }

        .bn-video-bg {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: 1;
        }

        .bn-video-bg::after {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.8);
        }

        .bn-video-bg video, .bn-video-bg img {
            width: 100%; height: 100%; object-fit: cover;
        }

        .bn-section-video .bn-container {
            position: relative;
            z-index: 2;
            text-align: center;
            color: #fff;
        }

        /* Split Project Layout (Image 4 Style) */
        .bn-section-projects-v2 {
            background: #ffffff;
            padding: 120px 0;
        }

        .bn-project-split {
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 80px;
        }

        .bn-project-split__info {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-bottom: 40px;
        }

        .bn-project-split__gallery {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
        }

        /* Common Button Standardization */
        .bn-btn--custom {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 32px;
            font-weight: 700;
            border-radius: 0;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 14px;
        }

        .bn-btn--outline-dark {
            border: 2px solid #000;
            color: #000 !important;
            background: #ffffff;
            z-index: 5;
            position: relative;
        }

        .bn-btn--outline-dark:hover {
            background: #000;
            color: #ffffff !important;
        }

        .bn-btn--custom-accent {
            background: var(--bn-accent);
            color: #fff;
            border: 2px solid var(--bn-accent);
        }

        .bn-btn--custom-accent:hover {
            background: #fff;
            color: var(--bn-accent);
        }

        /* Split CTA Foot Section (Image 4 style) */
        .bn-section-cta-split {
            background: #fff;
            padding: 120px 0;
        }

        .bn-cta-split-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-radius: 40px;
            overflow: hidden;
            background: #fef2f2; /* Light accent background */
        }

        .bn-cta-split__left {
            padding: 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fff7ed; /* Very light orange tint */
        }

        .bn-cta-split__right {
            background-size: cover;
            background-position: center;
            min-height: 500px;
        }

        /* Responsiveness */
        @media (max-width: 1200px) {
            .bn-story-grid, .bn-project-split, .bn-cta-split-grid {
                grid-template-columns: 1fr;
            }
            .bn-cta-split__left {
                padding: 40px;
            }
            .bn-project-split__gallery {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <main class="bn-page">
        <!-- Hero Section -->
        <section class="bn-section-hero-static" style="background-image: url('{{ $heroGallery->image ?? asset('frontend/resources/img/homely/slider/1.webp') }}');">
            <div class="bn-container">
                <div class="bn-sec-head bn-sec-head--center">
                    <h1 class="bn-sec-title bn-sec-title--big">{{ $system['about_hero_title'] ?? 'Tầm Nhìn & Sứ Mệnh' }}</h1>
                    <div class="bn-sec-desc" style="margin-top: 24px;">
                        {{ $system['about_hero_desc'] ?? 'Chúng tôi kết nối công nghệ và con người để tạo ra những giải pháp đột phá, thúc đẩy sự phát triển bền vững của doanh nghiệp trong kỷ nguyên số.' }}
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section (Alternating Primary/Accent) -->
        <section class="bn-section-stats-bar">
            <div class="bn-container">
                <div class="bn-stats-card">
                    @php
                        $stats = [
                            ['num' => $system['home_stat_1_num'] ?? '10+', 'label' => $system['home_stat_1_label'] ?? 'Năm Kinh Nghiệm'],
                            ['num' => ($projectCount ?? 0) . '+', 'label' => $system['home_stat_2_label'] ?? 'Dự Án Hoàn Thành'],
                            ['num' => $system['home_stat_3_num'] ?? '500+', 'label' => $system['home_stat_3_label'] ?? 'Khách Hàng Tin Tưởng'],
                            ['num' => $system['home_stat_4_num'] ?? '98%', 'label' => $system['home_stat_4_label'] ?? 'Sự Hài Lòng'],
                        ];
                    @endphp
                    @foreach($stats as $index => $stat)
                        @php
                            preg_match('/(\d+)/', $stat['num'], $matches);
                            $target = $matches[0] ?? 0;
                            $suffix = str_replace($target, '', $stat['num']);
                        @endphp
                        <div class="bn-stat-v2 bn-stat-v3" data-reveal="fade">
                            <span class="bn-stat-v3__num js-counter" data-target="{{ $target }}">{{ $stat['num'] }}</span>
                            <span class="bn-stat-v3__label">{{ $stat['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Our Story Section (Localized & Fixed text) -->
        <section class="bn-section-story-v2">
            <div class="bn-container">
                <div class="bn-story-grid">
                    <div class="bn-story-image" data-reveal="left">
                        <img src="{{ asset('frontend/resources/img/homely/slider/2.webp') }}" alt="Our Story">
                    </div>
                    <div class="bn-story-content" data-reveal="right">
                        <span class="bn-pill-label bn-pill-label--outline">Hành trình Novan</span>
                        <h2 class="bn-sec-title" style="margin: 20px 0;">Từ Đam mê Đến Vị thế Dẫn đầu trong Ngành Công nghệ</h2>
                        <p class="bn-sec-desc" style="margin-bottom: 40px;">
                            Hành trình của chúng tôi là minh chứng cho sự kiên trì và đổi mới. Chúng tôi không chỉ xây dựng phần mềm, chúng tôi kiến tạo tương lai số cho mọi doanh nghiệp.
                        </p>
                        
                        <div class="bn-features-list">
                            @foreach($coreValues->take(3) as $value)
                            <div class="bn-feature-item">
                                <div class="bn-feature-icon">
                                    <i class="fa {{ $value->image ?? 'fa-check' }}"></i>
                                </div>
                                <div class="bn-feature-content">
                                    <h3>{{ $value->languages->first()->pivot->name ?? $value->name }}</h3>
                                    <p>{{ $value->languages->first()->pivot->description ?? $value->description }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Video Section (Refined Dimensions & Fallback) -->
        <section class="bn-section-video">
            <div class="bn-video-bg">
                <img src="{{ asset('frontend/resources/img/homely/slider/5.webp') }}" alt="Video Background" style="filter: brightness(0.6);">
                <video autoplay muted loop playsinline style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.6;">
                    <source src="{{ asset('frontend/resources/video/bg-about.mp4') }}" type="video/mp4">
                </video>
            </div>
            <div class="bn-container">
                <div class="bn-section-video__content">
                    <span class="bn-pill-label bn-pill-label--outline" style="border-color: var(--bn-accent); color: var(--bn-accent);">Khám Phá Novan</span>
                    <h2 class="bn-project-featured-title" style="margin-top: 20px; font-size: 3.5rem; color: #fff;">Sự Giao Thoa Giữa Công Nghệ & Nghệ Thuật</h2>
                    <p style="font-size: 1.2rem; opacity: 0.9; max-width: 800px; margin: 20px auto 40px; color: #cbd5e1; line-height: 1.6;">
                        Mỗi dòng code, mỗi giải pháp chúng tôi tạo ra đều hướng tới một trải nghiệm người dùng hoàn hảo và giá trị thực chất cho khách hàng.
                    </p>
                    
                    <a href="{{ $system['homepage_video_youtube'] ?? '#' }}" class="bn-play-btn-large" style="width: 100px; height: 100px; border: 2px solid #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; color: #fff; font-size: 30px; transition: 0.3s; background: rgba(255,110,64,0.3);">
                        <i class="fa fa-play" style="margin-left: 5px;"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Split Projects Section (Image 2 Perfection) -->
        <section class="bn-section-projects-v2">
            <div class="bn-container">
                <div class="bn-project-split">
                    <div class="bn-project-split__info" data-reveal="left">
                        <div>
                            <span class="bn-pill-label bn-pill-label--outline">Dự án chọn lọc</span>
                            <h2 class="bn-sec-title" style="margin: 25px 0; font-size: 4rem; line-height: 1.1;">Thành tựu & <br>Dấu ấn Thực tế</h2>
                            <p class="bn-sec-desc" style="margin-bottom: 40px;">
                                Minh chứng cho năng lực triển khai và tư vấn chiến lược của đội ngũ Novan qua những dự án quy mô và phức tạp nhất.
                            </p>
                        </div>
                        <div>
                            <a href="{{ write_url('du-an') }}" class="bn-btn--custom bn-btn--outline-dark">
                                KHÁM PHÁ TẤT CẢ DỰ ÁN <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="bn-project-split__gallery" data-reveal="right">
                        @foreach($projects->take(2) as $project)
                            @php
                                $lang = $project->languages->first();
                                $pName = $lang->pivot->name ?? 'N/A';
                                $pCanonical = $lang->pivot->canonical ?? '#';
                            @endphp
                        <div class="bn-project-card-v2">
                            <div class="bn-project-card-v2__img">
                                <img src="{{ asset($project->image) }}" alt="{{ $pName }}">
                            </div>
                            <div class="bn-project-card-v2__body">
                                <h3 class="bn-project-card-v2__title">{{ $pName }}</h3>
                                <a href="{{ write_url($pCanonical) }}" class="bn-project-card-v2__link">
                                    Xem chi tiết <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Dynamic Team Section -->
        <section class="bn-section specialized-team" style="padding: 120px 0;">
            <div class="bn-container">
                <div class="bn-sec-head bn-sec-head--center">
                    <span class="bn-pill-label bn-pill-label--outline">Đội ngũ chuyên gia</span>
                    <h2 class="bn-sec-title">Nhân sự là giá trị cốt lõi bền vững</h2>
                </div>
                <div class="uk-grid uk-grid-medium" data-uk-grid>
                    @foreach($teams as $member)
                    <div class="uk-width-medium-1-4" style="margin-bottom: 30px;">
                        <div class="team-card-v2" style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.06); transition: 0.4s; height: 100%;">
                            <div style="width: 100%; height: 380px; overflow: hidden; background: #f8fafc;">
                                @php
                                    $avatar = $member->avatar;
                                    // Robust fallback seeding
                                    if (empty($avatar)) {
                                        $avatar = 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=400&auto=format&fit=crop';
                                    }
                                @endphp
                                <img src="{{ asset($avatar) }}" alt="{{ $member->full_name }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div style="padding: 25px; text-align: center;">
                                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 5px; color: var(--bn-primary);">{{ $member->full_name }}</h3>
                                <p style="color: var(--bn-accent); font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">{{ $member->title ?? 'Thành viên' }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @include('frontend.component.cta', [
            'image' => $ctaGallery->image ?? asset('frontend/resources/img/homely/slider/3.webp')
        ])
    </main>

    <script>
        // Number Counter Animation JS
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.js-counter');
            
            const animateCounter = (el) => {
                const targetText = el.getAttribute('data-target');
                const target = parseInt(targetText);
                const duration = 2000;
                const start = 0;
                let startTime = null;

                const step = (timestamp) => {
                    if (!startTime) startTime = timestamp;
                    const progress = Math.min((timestamp - startTime) / duration, 1);
                    const current = Math.floor(progress * (target - start) + start);
                    
                    // Maintain suffix
                    const suffix = el.getAttribute('data-suffix') || el.innerText.replace(/[0-9,]/g, '');
                    if (!el.getAttribute('data-suffix')) el.setAttribute('data-suffix', suffix);
                    
                    el.innerText = current.toLocaleString() + suffix;
                    
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    } else {
                        el.innerText = target.toLocaleString() + suffix;
                    }
                };

                window.requestAnimationFrame(step);
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                        animateCounter(entry.target);
                        entry.target.classList.add('animated');
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach(counter => observer.observe(counter));
        });
    </script>
@endsection
