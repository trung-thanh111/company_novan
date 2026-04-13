@extends('frontend.homepage.layout')


@push('styles')
    <style>
        .bn-section-hero-static {
            position: relative;
            padding: 140px 0 0;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #ffffff;
            overflow: hidden;
        }
        .bn-section-hero-static::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.7));
            z-index: 1;
        }
        .bn-section-hero-static .bn-container {
            position: relative;
            z-index: 2;
            padding-bottom: 30px; /* Added spacing */
        }
        .bn-sec-title--big {
            color: #ffffff !important;
            margin-bottom: 35px !important;
            text-shadow: 0 4px 20px rgba(0,0,0,0.6);
            line-height: 1.2;
        }
        .bn-sec-desc {
            color: rgba(255, 255, 255, 0.9);
            font-size: 18px;
            margin-top: 20px;
        }
        .bn-btn--primary {
            background: #1e293b;
            color: #ffffff !important;
        }
        .bn-btn--primary:hover {
            background: #0f172a;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .bn-btn i {
            margin-left: 0 !important;
            font-size: 1.1em;
        }
        .bn-svc-slider-wrapper .bn-btn i,
        .bn-svc-featured .bn-svc-card__footer .bn-btn i,
        .bn-svc-portfolio .bn-svc-item__cta .bn-btn i,
        .svc-prev i, 
        .svc-next i {
            color: #ffffff !important;
        }
        .bn-btn--outline-nav {
            background: transparent;
            border: 1.5px solid #e2e8f0;
            color: #1e293b;
        }
        .bn-btn--outline-nav:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .bn-svc-showcase {
            padding: 110px 0;
            background: #fff;
        }
        .bn-svc-slider-wrapper {
            position: relative;
            margin-top: 50px;
        }
        .bn-svc-showcase__item {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 70px;
            align-items: center;
        }
        .bn-svc-showcase__img-wrap {
            position: relative;
            border-radius: var(--bn-radius-md);
            overflow: hidden;
            height: 540px;
            box-shadow: var(--bn-shadow-md);
        }
        .bn-svc-showcase__img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1.2s ease;
        }
        .swiper-slide-active .bn-svc-showcase__img-wrap img {
            transform: scale(1.05);
        }
        .bn-svc-showcase__content {
            padding-right: 30px;
        }
        .bn-svc-showcase__title {
            font-size: 46px;
            font-weight: 800;
            margin: 25px 0;
            color: #1e293b;
            line-height: 1.1;
        }
        .bn-svc-showcase__desc {
            font-size: 18px;
            color: #475569;
            line-height: 1.8;
            margin-bottom: 40px;
        }

        /* ── Grid Section ── */
        .bn-svc-featured {
            background: #f8fafc;
            padding: 60px 0;
        }
        .bn-svc-featured__grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .bn-svc-card {
            background: #ffffff;
            border-radius: var(--bn-radius-md);
            overflow: hidden;
            transition: all 0.4s ease;
            border: 1px solid #f1f5f9;
            display: flex;
            flex-direction: column;
        }
        .bn-svc-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--bn-shadow-md);
        }
        .bn-svc-card__img {
            height: 280px;
            overflow: hidden;
            position: relative;
        }
        .bn-svc-card__img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .bn-svc-card__cat {
            position: absolute;
            top: 20px; left: 20px;
            background: rgba(15, 23, 42, 0.9);
            color: #ffffff;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .bn-svc-card__body {
            padding: 20px;
            flex-grow: 1;
        }
        .bn-svc-card__name {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #1e293b;
        }
        .bn-svc-card__footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: auto;
            padding-top: 10px;
            border-top: 1px solid #f1f5f9;
        }

        .bn-svc-portfolio {
            padding: 60px 0;
            background: #fff;
        }
        .bn-svc-portfolio__filters {
            display: flex;
            gap: 12px;
            margin: 50px 0 60px;
            flex-wrap: wrap;
        }
        .bn-filter-btn {
            background: #f1f5f9;
            border: none;
            padding: 10px 20px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 14px;
            color: #64748b;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .bn-filter-btn.active, .bn-filter-btn:hover {
            background: #1e293b;
            color: #ffffff;
        }
        .bn-svc-masonry {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
        }
        .bn-svc-item {
            position: relative;
            border-radius: var(--bn-radius-md);
            overflow: hidden;
            background: transparent;
        }
        .bn-svc-item:nth-child(even) {
            margin-top: 80px;
        }
        .bn-svc-item__img {
            height: 480px;
            opacity: 0.85;
            transition: opacity 0.4s ease;
            line-height: 0; /* Fixed: baseline gap */
            background: transparent;
        }
        .bn-svc-item:hover .bn-svc-item__img {
            opacity: 0.65;
        }
        .bn-svc-item__img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block; /* Fixed: inline gap */
        }
        .bn-svc-item__overlay {
            position: absolute;
            bottom: 0; left: 0; width: 100%;
            padding: 25px 35px 20px; /* Refined compact padding */
            background: linear-gradient(to top, rgba(15, 23, 42, 0.4) 0%, transparent 100%);
            color: #ffffff;
            pointer-events: none;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            min-height: auto;
        }
        .bn-svc-item__title {
            font-size: 26px; /* Slightly smaller for compactness */
            font-weight: 800;
            margin-bottom: 0px; /* Eliminated margin */
            color: #ffffff !important; 
            text-shadow: 0 4px 10px rgba(0,0,0,0.5);
            display: block;
        }
        .bn-svc-item__cat {
            font-size: 14px;
            color: rgba(255,255,255,0.8);
            font-weight: 500;
            text-transform: uppercase;
            margin-bottom: 2px;
        }
        .bn-svc-item__cta {
            margin-top: 8px; /* Minimal top margin */
            margin-bottom: 0;
            pointer-events: auto;
        }

        /* ── Partners ── */
        .bn-svc-partners {
            padding: 100px 0;
            background: #fff;
            border-top: 1px solid #f1f5f9;
        }
        .bn-partner-item img {
            max-width: 160px;
            max-height: 65px;
            filter: grayscale(1);
            opacity: 0.3;
            transition: all 0.4s ease;
        }
        .bn-partner-item:hover img {
            filter: grayscale(0);
            opacity: 1;
        }

        /* ── Final CTA Sync ── */
        .bn-cta {
            background: #475569 !important; /* Slate-600 */
            text-align: center;
            padding: var(--bn-section-padding);
            border-radius: 0;
        }
        .bn-cta__inner {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
        }
        .bn-cta__title {
            color: #ffffff;
            font-size: 42px;
            font-weight: 800;
            max-width: 800px;
            margin: 0;
        }
        .bn-cta .bn-btn--white {
            background: #ffffff;
            color: #1e293b !important;
        }

        /* ── Responsive ── */
        @media (max-width: 1024px) {
            .bn-svc-showcase__item { grid-template-columns: 1fr; gap: 50px; }
            .bn-svc-showcase__img-wrap { height: 450px; }
            .bn-svc-featured__grid { grid-template-columns: repeat(2, 1fr); }
            .bn-svc-masonry { grid-template-columns: 1fr; }
            .bn-svc-item:nth-child(even) { margin-top: 0; }
        }
        @media (max-width: 768px) {
            .bn-svc-featured__grid { grid-template-columns: 1fr; }
            .bn-svc-showcase__title { font-size: 34px; }
            .bn-svc-item__overlay { padding: 15px 15px 5px; }
            .bn-svc-item__title { font-size: 22px; }
            .bn-cta__title { font-size: 28px; }
        }
    </style>
@endpush

@section('content')
<main class="bn-page">
    <section class="bn-section-hero-static" style="background-image: url('{{ $heroGallery->image ?? asset('frontend/resources/img/homely/slider/3.webp') }}');">
        <div class="bn-container">
            <div class="bn-sec-head bn-sec-head--center">
                <span class="bn-pill-label bn-pill-label--outline">Giải Pháp Hệ Thống</span>
                <h1 class="bn-sec-title bn-sec-title--big">Kiến Tạo Hệ Sinh Thái<br>Doanh Nghiệp Số</h1>
                <div class="bn-sec-desc">
                    Kết hợp giữa hạ tầng hiện đại và trí tuệ nhân tạo, chúng tôi đem đến <br> khả năng vận hành vượt trội cho đối tác toàn cầu.
                </div>
            </div>
        </div>
    </section>

    <section class="bn-svc-showcase">
        <div class="bn-container">
            <div class="bn-sec-head">
                <span class="bn-pill-label">Dự án</span>
                <h2 class="bn-sec-title">Giải Pháp Tiên Phong</h2>
            </div>

            <div class="bn-svc-slider-wrapper">
                <div class="swiper-container featured-svc-slider">
                    <div class="swiper-wrapper">
                        @foreach($projects as $project)
                            @php
                                $projName = data_get($project, 'languages.0.pivot.name', 'Dự án');
                                $projDesc = data_get($project, 'languages.0.pivot.description', '');
                                $projImg  = $project->image ?? asset('frontend/resources/img/homely/slider/1.webp');
                                $projCanonical = data_get($project, 'languages.0.pivot.canonical', '#');
                            @endphp
                            <div class="swiper-slide">
                                <div class="bn-svc-showcase__item">
                                    <div class="bn-svc-showcase__img-wrap">
                                        <img src="{{ $projImg }}" alt="{{ $projName }}">
                                    </div>
                                    <div class="bn-svc-showcase__content">
                                        <span class="bn-pill-label bn-pill-label--outline" style="color:var(--bn-accent); border-color:var(--bn-accent);">Giải Pháp Đặc Quyền</span>
                                        <h3 class="bn-svc-showcase__title">{{ $projName }}</h3>
                                        <p class="bn-svc-showcase__desc">{{ strip_tags($projDesc) }}</p>
                                        <div style="display: flex; gap: 20px;">
                                            <a href="{{ write_url($projCanonical) }}" class="bn-btn bn-btn--primary">Xem chi tiết <i class="fa fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div style="margin-top: 50px; display: flex; gap: 20px;">
                         <div class="svc-prev bn-btn bn-btn--icon-only bn-btn--outline-nav" style="min-width: 65px; padding: 15px;"><i class="fa fa-chevron-left"></i></div>
                         <div class="svc-next bn-btn bn-btn--icon-only bn-btn--outline-nav" style="min-width: 65px; padding: 15px;"><i class="fa fa-chevron-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ FEATURED GRID (SYNCHRONIZED BUTTONS) ============ -->
    <section class="bn-svc-featured">
        <div class="bn-container">
            <div class="bn-sec-head bn-sec-head--center">
                <span class="bn-pill-label">Giá trị mang lại</span>
                <h2 class="bn-sec-title">Dịch vụ</h2>
            </div>
            
            <div class="bn-svc-featured__grid">
                @foreach($featuredServices as $svc)
                    @php
                        $svcName = data_get($svc, 'languages.0.pivot.name', 'Dịch vụ');
                        $svcCat  = data_get($svc, 'service_catalogues.0.languages.0.pivot.name', 'Công nghệ');
                        $svcImg  = $svc->image ?? asset('frontend/resources/img/homely/slider/1.webp');
                        $svcCanonical = data_get($svc, 'languages.0.pivot.canonical', '#');
                    @endphp
                    <div class="bn-svc-card">
                        <div class="bn-svc-card__img">
                            <img src="{{ $svcImg }}" alt="{{ $svcName }}">
                            <span class="bn-svc-card__cat">{{ $svcCat }}</span>
                        </div>
                        <div class="bn-svc-card__body">
                            <h3 class="bn-svc-card__name">{{ $svcName }}</h3>
                            <p class="bn-svc-showcase__desc" style="font-size: 15px; margin-bottom: 0;">
                                {{ Illuminate\Support\Str::words(strip_tags(data_get($svc, 'languages.0.pivot.description')), 22) }}
                            </p>
                            <div class="bn-svc-card__footer">
                                <a href="{{ write_url($svcCanonical) }}" class="bn-btn bn-btn--primary" style="padding: 10px 24px; font-size: 14px;">Xem chi tiết <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bn-svc-portfolio">
        <div class="bn-container">
            <div class="bn-sec-head">
                <span class="bn-pill-label">Giải pháp</span>
                <h2 class="bn-sec-title">Hệ Sinh Thái Toàn Diện</h2>
                
                <div class="bn-svc-portfolio__filters">
                    <button class="bn-filter-btn active" data-filter="all">Tất cả dịch vụ</button>
                    @foreach($serviceCatalogues as $cat)
                        <button class="bn-filter-btn" data-filter="{{ $cat->id }}">
                            {{ data_get($cat, 'languages.0.pivot.name', 'Danh mục') }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="bn-svc-masonry">
                @foreach($services as $svc)
                    @php
                        $svcName = data_get($svc, 'languages.0.pivot.name', 'Dịch vụ');
                        $svcCat  = data_get($svc, 'service_catalogues.0.languages.0.pivot.name', 'Công nghệ');
                        $svcCatId = data_get($svc, 'service_catalogues.0.id', '');
                        $svcCanonical = data_get($svc, 'languages.0.pivot.canonical', '#');
                    @endphp
                    <div class="bn-svc-item" data-cat="{{ $svcCatId }}">
                        <div class="bn-svc-item__img">
                            <img src="{{ $svc->image }}" alt="{{ $svcName }}">
                        </div>
                        <div class="bn-svc-item__overlay">
                            <span class="bn-svc-item__cat">{{ $svcCat }}</span>
                            <h3 class="bn-svc-item__title">{{ $svcName }}</h3>
                             <div class="bn-svc-item__cta">
                                <a href="{{ write_url($svcCanonical) }}" class="bn-btn bn-btn--primary" style="padding: 10px 25px; font-size: 14px;">Tìm hiểu ngay <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bn-svc-partners">
        <div class="bn-container">
            <div class="bn-sec-head bn-sec-head--center" style="margin-bottom: 70px;">
                <span class="bn-pill-label">Hợp tác tin cậy</span>
                <h2 class="bn-sec-title">Đồng hành cùng chúng tôi</h2>
            </div>
            
            <div class="swiper-container bn-partner-ticker">
                <div class="swiper-wrapper">
                    @foreach($partners as $partner)
                        <div class="swiper-slide bn-partner-item">
                            <img src="{{ $partner->image }}" alt="{{ data_get($partner, 'languages.0.pivot.name', 'Đối tác') }}">
                        </div>
                    @endforeach
                    @foreach($partners as $partner)
                        <div class="swiper-slide bn-partner-item">
                            <img src="{{ $partner->image }}" alt="{{ data_get($partner, 'languages.0.pivot.name', 'Đối tác') }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @include('frontend.component.cta', [
        'title' => $system['home_cta_title'] ?? 'Sẵn sàng để kiến tạo những giải pháp đột phá?',
        'desc' => 'Liên hệ với đội ngũ chuyên gia của chúng tôi để bắt đầu hành trình chuyển đổi số toàn diện cho doanh nghiệp của bạn.',
        'btnText' => $system['home_cta_btn'] ?? 'TƯ VẤN NGAY'
    ])
</main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const featuredSlider = new Swiper('.featured-svc-slider', {
            slidesPerView: 1,
            spaceBetween: 50,
            loop: true,
            speed: 1200,
            autoplay: { delay: 5000, disableOnInteraction: false },
            navigation: { nextEl: '.svc-next', prevEl: '.svc-prev' },
            watchSlidesProgress: true,
        });

        const partnerTicker = new Swiper('.bn-partner-ticker', {
            slidesPerView: 6,
            spaceBetween: 50,
            loop: true,
            speed: 4000,
            allowTouchMove: true,
            autoplay: { delay: 1, disableOnInteraction: false },
            freeMode: true,
            breakpoints: {
                320: { slidesPerView: 2, spaceBetween: 30 },
                768: { slidesPerView: 4, spaceBetween: 40 },
                1024: { slidesPerView: 6, spaceBetween: 50 }
            }
        });

        const btns = document.querySelectorAll('.bn-filter-btn');
        const items = document.querySelectorAll('.bn-svc-item');

        btns.forEach(btn => {
            btn.addEventListener('click', () => {
                btns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const filter = btn.dataset.filter;
                items.forEach(item => {
                    if (filter === 'all' || item.dataset.cat === filter) {
                        item.style.display = 'block';
                        setTimeout(() => item.style.opacity = '1', 10);
                    } else {
                        item.style.opacity = '0';
                        setTimeout(() => item.style.display = 'none', 300);
                    }
                });
            });
        });
    });
</script>
@endpush
