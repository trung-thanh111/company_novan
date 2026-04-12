@extends('frontend.homepage.layout')

@section('content')
    <style>
        /* ── Service Detail Specific Styles ── */
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
            background: rgba(15, 23, 42, 0.7);
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

        .bn-section--service-content {
            padding: 80px 0 120px;
            background-color: #ffffff;
        }

        .bn-service-main-wrapper {
            max-width: 900px;
            margin: 0 auto;
        }

        .bn-service-featured-image {
            width: 100%;
            margin-bottom: 60px;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.1);
        }
        .bn-service-featured-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* ── Related Section ── */
        .bn-section--related {
            padding: 100px 0;
            background-color: #f8fafc;
        }

        /* ── CTA Block inside content ── */
        .bn-service-cta-inner {
            margin: 60px 0;
            padding: 48px;
            background: #0f172a;
            border-radius: 32px;
            color: #fff;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .bn-service-cta-inner::before {
            content: '';
            position: absolute;
            top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(230, 92, 0, 0.15) 0%, transparent 70%);
            z-index: 1;
        }
        .bn-service-cta-inner * {
            position: relative;
            z-index: 2;
        }
        .bn-service-cta-inner h3 {
            color: #fff;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 16px;
        }
        .bn-service-cta-inner p {
            color: rgba(255,255,255,0.7);
            font-size: 16px;
            margin-bottom: 32px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>

    @php
        $postLang = $post->languages->first()?->pivot;
        $postTitle = $postLang?->name ?? ($post->name ?? '');
        $postDesc = $postLang?->description ?? '';
        $postImage = $post->image ?? asset('images/placeholder-service.jpg');

        $catLang = $postCatalogue->languages->first()?->pivot ?? null;
        $catName = $catLang?->name ?? 'Giải pháp';
    @endphp

    <main class="bn-page">
        <!-- HERO SECTION -->
        <section class="bn-section-hero-static" style="background-image: url('{{ asset($postImage) }}');">
            <div class="bn-container">
                <div class="bn-sec-head bn-sec-head--center">
                    <h1 class="bn-sec-title bn-sec-title--big">Giải Pháp Công Nghệ Novan</h1>
                    <div class="bn-sec-desc">{{ $postTitle }}</div>
                </div>
            </div>
        </section>

        <!-- SERVICE CONTENT SECTION -->
        <article class="bn-section--service-content">
            <div class="bn-container">
                <div class="bn-service-main-wrapper">
                    <!-- Featured Image -->
                    <div class="bn-service-featured-image" uk-scrollspy="cls: uk-animation-fade; delay: 200">
                        <img src="{{ asset($postImage) }}" alt="{{ $postTitle }}">
                    </div>

                    <!-- Typography Content -->
                    <div class="bn-typography">
                        @if(!empty($postDesc))
                            <div class="bn-intro-text" style="font-size: 20px; color: #475569; line-height: 1.6; margin-bottom: 40px; font-weight: 500;">
                                {{ $postDesc }}
                            </div>
                        @endif
                        
                        {!! $postLang?->content !!}
                    </div>

                    <!-- CTA Block -->
                    <div class="bn-service-cta-inner" uk-scrollspy="cls: uk-animation-slide-top-small; delay: 300">
                        <h3>Sẵn sàng bứt phá cùng Novan?</h3>
                        <p>Liên hệ với đội ngũ chuyên gia của chúng tôi để được tư vấn giải pháp tối ưu nhất cho doanh nghiệp của bạn.</p>
                        <a href="{{ url('lien-he.html') }}" class="bn-btn bn-btn--shiny">Yêu cầu tư vấn ngay</a>
                    </div>
                </div>
            </div>
        </article>

        <!-- RELATED SERVICES -->
        @if (isset($relatedPosts) && $relatedPosts->isNotEmpty())
            <section class="bn-section--related">
                <div class="bn-container">
                    <div class="bn-sec-head bn-sec-head--center">
                        <span class="bn-pill-label">Dịch vụ khác</span>
                        <h2 class="bn-sec-title">Giải Pháp Liên Quan</h2>
                    </div>

                    <div class="bn-service-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 32px;">
                        @foreach ($relatedPosts as $index => $related)
                            @php
                                $rLang = $related->languages->first()?->pivot;
                                $rTitle = $rLang?->name ?? '';
                                $rDesc = strip_tags($rLang?->description ?? '');
                                $rUrl = url(rtrim($rLang?->canonical ?? '#', '/') . '.html');
                                $rImg = !empty($related->image) ? asset($related->image) : asset('images/placeholder-service.jpg');
                            @endphp

                            <article class="bn-service-card" uk-scrollspy="cls: uk-animation-slide-bottom-small; delay: {{ $index * 100 }}">
                                <a href="{{ $rUrl }}" class="bn-service-card__image-link" style="display: block; aspect-ratio: 16/10; overflow: hidden;">
                                    <img src="{{ $rImg }}" alt="{{ $rTitle }}" class="bn-service-card__image" style="width: 100%; height: 100%; object-fit: cover;">
                                </a>
                                <div class="bn-service-card__content" style="padding: 32px;">
                                    <a href="{{ $rUrl }}">
                                        <h3 class="bn-service-card__title" style="font-size: 24px; font-weight: 700; color: #1e293b; margin-bottom: 16px;">{{ $rTitle }}</h3>
                                    </a>
                                    <p class="bn-service-card__excerpt" style="color: #64748b; font-size: 16px; margin-bottom: 24px;">{{ \Str::limit($rDesc, 100) }}</p>
                                    <a href="{{ $rUrl }}" class="bn-service-card__footer" style="color: var(--bn-accent, #e65c00); font-weight: 700; text-transform: uppercase;">
                                        Xem thêm <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection
