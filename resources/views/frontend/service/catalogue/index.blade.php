@extends('frontend.homepage.layout')

@section('content')
    <style>
        /* ── Service Catalogue Specific Styles ── */
        .bn-section--service-list {
            padding: 80px 0 120px;
            background-color: #f8fafc;
        }

        /* ── Hero Standardized Padding ── */
        .bn-section-hero-static {
            padding: 160px 0 140px;
            position: relative;
            background-size: cover;
            background-position: center;
        }
        .bn-section-hero-static::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(15, 23, 42, 0.65);
            z-index: 1;
        }
        .bn-section-hero-static .bn-container {
            position: relative;
            z-index: 2;
        }
        .bn-section-hero-static .bn-sec-title,
        .bn-section-hero-static .bn-sec-desc {
            color: #ffffff !important;
        }

        /* ── Service Card Premium Style ── */
        .bn-service-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 32px;
        }
        @media (max-width: 768px) {
            .bn-service-grid {
                grid-template-columns: 1fr;
            }
        }

        .bn-service-card {
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            height: 100%;
            border: 1px solid rgba(15, 23, 42, 0.05);
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
            position: relative;
        }
        .bn-service-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 30px 60px rgba(15, 23, 42, 0.12);
            border-color: var(--bn-accent, #e65c00);
        }
        .bn-service-card__image-link {
            display: block;
            aspect-ratio: 16/10;
            overflow: hidden;
            position: relative;
        }
        .bn-service-card__image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }
        .bn-service-card:hover .bn-service-card__image {
            transform: scale(1.1);
        }
        .bn-service-card__content {
            padding: 32px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .bn-service-card__title {
            font-size: 24px;
            font-weight: 700;
            line-height: 1.3;
            color: #1e293b;
            margin-bottom: 16px;
            transition: color 0.3s ease;
        }
        .bn-service-card:hover .bn-service-card__title {
            color: var(--bn-accent, #e65c00);
        }
        .bn-service-card__excerpt {
            color: #64748b;
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 24px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .bn-service-card__footer {
            margin-top: auto;
            display: flex;
            align-items: center;
            color: var(--bn-accent, #e65c00);
            font-weight: 700;
            font-size: 15px;
            gap: 10px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .bn-service-card__footer i {
            transition: transform 0.3s ease;
        }
        .bn-service-card:hover .bn-service-card__footer i {
            transform: translateX(6px);
        }

        .bn-empty-state {
            text-align: center;
            padding: 120px 0;
            background: #fff;
            border-radius: 32px;
            border: 2px dashed #e2e8f0;
        }
    </style>

    <main class="bn-page">
        @php
            $bgHero = asset('frontend/resources/img/homely/slider/1.webp');
            if (isset($postCatalogue) && !empty($postCatalogue->image)) {
                $bgHero = asset($postCatalogue->image);
            }
        @endphp
        <section class="bn-section-hero-static" style="background-image: url('{{ $bgHero }}');">
            <div class="bn-container">
                <div class="bn-sec-head bn-sec-head--center">
                    <h1 class="bn-sec-title bn-sec-title--big">
                        {{ $postCatalogue->languages->first()->pivot->name ?? 'Dịch vụ Solution' }}
                    </h1>
                    <div class="bn-sec-desc">
                        {{ $postCatalogue->languages->first()->pivot->description ?? 'Khám phá các giải pháp công nghệ tiên tiến giúp tối ưu hóa vận hành và bứt phá doanh thu cho doanh nghiệp của bạn.' }}
                    </div>
                </div>
            </div>
        </section>

        <!-- SERVICE LIST SECTION -->
        <section class="bn-section--service-list">
            <div class="bn-container">
                <div class="bn-sec-head bn-sec-head--center" style="margin-bottom: 60px;">
                    <span class="bn-pill-label">Giải pháp chuyên sâu</span>
                    <h2 class="bn-sec-title">Danh sách dịch vụ</h2>
                </div>

                @if (!empty($posts) && $posts->count() > 0)
                    <div class="bn-service-grid">
                        @foreach ($posts as $index => $post)
                            @php
                                $itemImage = !empty($post->image) ? asset($post->image) : asset('images/placeholder-service.jpg');
                                $itemUrl = !empty($post->languages->first()->pivot->canonical) ? url(rtrim($post->languages->first()->pivot->canonical, '/') . '.html') : '#';
                                $itemName = $post->languages->first()->pivot->name ?? 'Untitled Service';
                                $itemDesc = strip_tags($post->languages->first()->pivot->description ?? '');
                            @endphp

                            <article class="bn-service-card" uk-scrollspy="cls: uk-animation-slide-bottom-small; delay: {{ $index * 100 }}; repeat: true">
                                <a href="{{ $itemUrl }}" class="bn-service-card__image-link">
                                    <img src="{{ $itemImage }}" alt="{{ $itemName }}" class="bn-service-card__image" loading="{{ $index < 3 ? 'eager' : 'lazy' }}">
                                </a>
                                <div class="bn-service-card__content">
                                    <a href="{{ $itemUrl }}">
                                        <h3 class="bn-service-card__title">{{ $itemName }}</h3>
                                    </a>
                                    <p class="bn-service-card__excerpt">{{ \Str::limit($itemDesc, 120) }}</p>
                                    <a href="{{ $itemUrl }}" class="bn-service-card__footer">
                                        Chi tiết giải pháp <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="bn-empty-state">
                        <i class="fa fa-lightbulb-o" style="font-size: 64px; color: #cbd5e1; margin-bottom: 24px; display: block;"></i>
                        <p style="font-size: 18px; color: #64748b;">Hiện tại chưa có dịch vụ nào trong danh mục này.</p>
                        <a href="{{ url('dich-vu.html') }}" class="bn-btn bn-btn--shiny-outline mt-8" style="margin-top: 24px;">Quay lại trang dịch vụ</a>
                    </div>
                @endif
            </div>
        </section>
    </main>
@endsection
