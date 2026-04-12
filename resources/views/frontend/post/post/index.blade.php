@extends('frontend.homepage.layout')

@section('content')
    <style>
        /* ── Post Detail Specific Styles ── */
        .bn-section-hero-static {
            padding: 160px 0 140px;
            position: relative;
        }
        .bn-section-hero-static::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(15, 23, 42, 0.6);
            z-index: 1;
        }
        .bn-section-hero-static .bn-container {
            position: relative;
            z-index: 2;
        }
        .bn-section-hero-static .bn-sec-title,
        .bn-section-hero-static .bn-sec-desc,
        .bn-section-hero-static .bn-breadcrumb a,
        .bn-section-hero-static .bn-breadcrumb span {
            color: #ffffff !important;
        }
        .bn-section-hero-static .bn-breadcrumb .separator {
            color: rgba(255,255,255,0.5) !important;
        }

        .bn-section--post-content {
            padding: 80px 0 120px;
            background-color: #ffffff;
        }

        .bn-post-meta-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 24px;
            margin-bottom: 40px;
            flex-wrap: wrap;
            padding: 20px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .bn-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .bn-meta-item i {
            color: var(--bn-accent, #e65c00);
            font-size: 16px;
        }

        .bn-post-featured-image {
            width: 100%;
            max-width: 100%;
            margin: 30px 0;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.1);
        }
        .bn-post-featured-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* ── Related Section ── */
        .bn-section--related {
            padding: 100px 0;
            background-color: #f8fafc;
        }
        
        .bn-section--related .bn-sec-head {
            margin-bottom: 60px;
        }

        /* Table of Contents overrides for premium look */
        .toc-list {
            background: #f8fafc;
            padding: 24px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            margin-bottom: 40px;
        }
        .toc-list h4 {
            margin-top: 0;
            margin-bottom: 16px;
            font-size: 18px;
            color: #0f172a;
        }
    </style>

    @php
        $postLang = $post->languages->first()?->pivot;
        $postTitle = $postLang?->name ?? ($post->name ?? '');
        $postDesc = $postLang?->description ?? '';
        $postImage = $post->image ?? asset('images/placeholder-news.jpg');

        $postDate = $post->released_at ? \Carbon\Carbon::parse($post->released_at) : \Carbon\Carbon::parse($post->created_at);
        $dateFormatted = $postDate->format('d/m/Y');

        $catLang = $postCatalogue->languages->first()?->pivot ?? null;
        $catName = $catLang?->name ?? ($postCatalogue->name ?? 'Bài viết');
        $catUrl = $catLang?->canonical ?? ($postCatalogue->canonical ?? '#');
    @endphp

    <div id="scroll-progress"></div>

    <main class="bn-page">
        <!-- HERO SECTION -->
        @php
            $bgHero = asset('frontend/resources/img/homely/slider/1.webp');
            if (isset($postCatalogue) && !empty($postCatalogue->image)) {
                $bgHero = asset($postCatalogue->image);
            } elseif (isset($property) && !empty($property->image)) {
                $bgHero = asset($property->image);
            }
        @endphp
        <section class="bn-section-hero-static" style="background-image: url('{{ $bgHero }}');">
            <div class="bn-container">
                <div class="bn-sec-head bn-sec-head--center">
                    <h1 class="bn-sec-title bn-sec-title--big">Thành Viên Novan Blog</h1>
                    <div class="bn-sec-desc">{{ $postTitle }}</div>
                </div>
            </div>
        </section>

        <!-- POST CONTENT SECTION -->
        <article class="bn-section--post-content">
            <div class="bn-container">
                <!-- Meta -->
                <div class="bn-post-meta-bar">
                    <div class="bn-meta-item">
                        <i class="fa fa-calendar-o"></i>
                        <span>{{ $dateFormatted }}</span>
                    </div>
                    <div class="bn-meta-item">
                        <i class="fa fa-folder-open-o"></i>
                        <span>{{ $catName }}</span>
                    </div>
                </div>

                <div class="bn-post-featured-image" uk-scrollspy="cls: uk-animation-fade; delay: 200">
                    <img src="{{ asset($postImage) }}" alt="{{ $postTitle }}">
                </div>

                <div class="bn-typography">
                    {!! $contentWithToc ?? $postLang?->content !!}
                </div>
            </div>
        </article>

        <!-- RELATED POSTS -->
        @if (isset($postCatalogue->posts) && $postCatalogue->posts->isNotEmpty() && $postCatalogue->posts->where('id', '!=', $post->id)->count() > 0)
            <section class="bn-section--related">
                <div class="bn-container">
                    <div class="bn-sec-head bn-sec-head--center">
                        <span class="bn-pill-label">Khám phá thêm</span>
                        <h2 class="bn-sec-title">Bài Viết Liên Quan</h2>
                    </div>

                    <div class="bn-blog-grid">
                        @foreach ($postCatalogue->posts->where('id', '!=', $post->id)->take(3) as $index => $related)
                            @php
                                $rLang = $related->languages->first()?->pivot;
                                $rTitle = $rLang?->name ?? '';
                                $rDesc = strip_tags($rLang?->description ?? '');
                                $rUrl = write_url($rLang?->canonical ?? '#');
                                $rImg = !empty($related->image) ? asset($related->image) : asset('images/placeholder-news.jpg');
                                $rDate = $related->released_at ? \Carbon\Carbon::parse($related->released_at) : \Carbon\Carbon::parse($related->created_at);
                                $rDateFormatted = $rDate->format('d/m/Y');
                            @endphp

                            <article class="bn-blog-card" uk-scrollspy="cls: uk-animation-slide-bottom-small; delay: {{ $index * 100 }}">
                                <a href="{{ $rUrl }}" class="bn-blog-card__image-link">
                                    <img src="{{ $rImg }}" alt="{{ $rTitle }}" class="bn-blog-card__image" loading="lazy">
                                </a>
                                <div class="bn-blog-card__content">
                                    <div class="bn-blog-card__meta">
                                        <span class="bn-blog-card__category">{{ $catName }}</span>
                                        <span class="bn-blog-card__date">{{ $rDateFormatted }}</span>
                                    </div>
                                    <a href="{{ $rUrl }}">
                                        <h3 class="bn-blog-card__title">{{ $rTitle }}</h3>
                                    </a>
                                    <p class="bn-blog-card__excerpt">{{ \Str::limit($rDesc, 100) }}</p>
                                    <a href="{{ $rUrl }}" class="bn-blog-card__footer">
                                        Đọc tiếp <i class="fa fa-arrow-right"></i>
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
