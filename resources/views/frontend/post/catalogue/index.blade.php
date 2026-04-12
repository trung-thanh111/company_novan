@extends('frontend.homepage.layout')

@section('content')
    <style>
        /* ── Post Catalogue Specific Styles ── */
        .bn-section--blog-list {
            padding: 80px 0 80px;
            background-color: #f8fafc;
        }

        .bn-blog-filter {
            margin-bottom: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .bn-filter-pills {
            display: flex;
            gap: 12px;
            list-style: none;
            padding: 0;
            margin: 0;
            overflow-x: auto;
            padding-bottom: 5px;
            scrollbar-width: none;
        }
        .bn-filter-pills::-webkit-scrollbar { display: none; }

        .bn-filter-pills li a {
            display: block;
            padding: 10px 24px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 100px;
            color: #475569;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .bn-filter-pills li.active a,
        .bn-filter-pills li a:hover {
            background: #0f172a;
            color: #fff;
            border-color: #0f172a;
            box-shadow: 0 10px 20px rgba(15, 23, 42, 0.1);
        }

        .bn-search-trigger {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 50%;
            color: #475569;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .bn-search-trigger:hover {
            background: var(--bn-accent, #e65c00);
            color: #fff;
            border-color: var(--bn-accent, #e65c00);
        }

        /* ── Hero Standardized Padding ── */
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

        /* ── Pagination / Load More ── */
        .bn-load-more-wrapper {
            margin-top: 60px;
            display: flex;
            justify-content: center;
        }
        .bn-load-more-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 48px;
            background: #0f172a;
            color: #fff;
            border-radius: 100px;
            font-weight: 700;
            font-size: 15px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15);
        }
        .bn-load-more-btn:hover {
            background: var(--bn-accent, #e65c00);
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(230, 92, 0, 0.25);
            color: #fff;
        }
        .bn-load-more-btn.loading {
            opacity: 0.7;
            pointer-events: none;
        }
        .bn-load-more-btn i {
            font-size: 14px;
        }
        .bn-load-more-btn.loading i {
            animation: rotate 1s linear infinite;
        }
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .bn-empty-state {
            text-align: center;
            padding: 100px 0;
            background: #fff;
            border-radius: 24px;
            border: 1px dashed #e2e8f0;
        }
    </style>

    <div id="scroll-progress"></div>

    <main class="bn-page">
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
                    <h1 class="bn-sec-title bn-sec-title--big">
@if (isset($postCatalogue) && $postCatalogue && $postCatalogue->parent_id != 0)
                            {{ $postCatalogue->languages->first()->pivot->name ?? 'Bài viết' }}
                        @else
                            Tin Tức & Sự Kiện
                        @endif
                    </h1>
                    <div class="bn-sec-desc">
                        Cập nhật những thông tin mới nhất về kiến trúc, nội thất và các dự án của {{ $system['homepage_brand'] ?? 'Bricknet' }}.
                    </div>
                </div>
            </div>
        </section>

        <!-- BLOG LIST SECTION -->
        <section class="bn-section--blog-list">
            <div class="bn-container">
                <div class="bn-sec-head bn-sec-head--center" style="margin-bottom: 50px;">
                    <span class="bn-pill-label">Cập nhật</span>
                    <h2 class="bn-sec-title">Tin Tức Mới Nhất</h2>
                </div>

                @if (!empty($posts) && $posts->count() > 0)
                    <div id="bn-blog-grid" class="bn-blog-grid">
                        @foreach ($posts as $index => $post)
                            @php
                                $postImage = !empty($post->image) ? asset($post->image) : asset('images/placeholder-news.jpg');
                                $postUrl = !empty($post->canonical) ? url(rtrim($post->canonical, '/') . (str_ends_with($post->canonical, '.html') ? '' : '.html')) : '#';
                                $postName = $post->name ?? 'Untitled';
                                $postDesc = strip_tags($post->languages->first()->pivot->description ?? '');
                                
                                $publishedAt = !empty($post->released_at) ? \Carbon\Carbon::parse($post->released_at) : \Carbon\Carbon::parse($post->created_at);
                                $dateFormatted = $publishedAt->format('d/m/Y');

                                $categoryName = '';
                                if ($post->post_catalogues->count() > 0) {
                                    $cat = $post->post_catalogues->first();
                                    $categoryName = $cat->languages->first()->pivot->name ?? '';
                                }
                            @endphp

                            <article class="bn-blog-card" uk-scrollspy="cls: uk-animation-slide-bottom-small; delay: {{ $index * 100 }}; repeat: true">
                                <a href="{{ $postUrl }}" class="bn-blog-card__image-link">
                                    <img src="{{ $postImage }}" alt="{{ $postName }}" class="bn-blog-card__image" loading="{{ $index < 3 ? 'eager' : 'lazy' }}">
                                </a>
                                <div class="bn-blog-card__content">
                                    <div class="bn-blog-card__meta">
                                        <span class="bn-blog-card__category">{{ $categoryName }}</span>
                                        <span class="bn-blog-card__date">{{ $dateFormatted }}</span>
                                    </div>
                                    <a href="{{ $postUrl }}">
                                        <h3 class="bn-blog-card__title">{{ $postName }}</h3>
                                    </a>
                                    <p class="bn-blog-card__excerpt">{{ \Str::limit($postDesc, 100) }}</p>
                                    <a href="{{ $postUrl }}" class="bn-blog-card__footer">
                                        Xem chi tiết <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    @if ($posts->hasMorePages())
                        <div class="bn-load-more-wrapper">
                            <button id="bn-load-more" class="bn-load-more-btn" data-url="{{ $posts->nextPageUrl() }}">
                                <span>Xem thêm tin tức</span>
                                <i class="fa fa-refresh"></i>
                            </button>
                        </div>
                    @endif
                @else
                    <div class="bn-empty-state">
                        <i class="fa fa-folder-open-o" style="font-size: 48px; color: #cbd5e1; margin-bottom: 20px; display: block;"></i>
                        <p class="pc-empty-state__text">Không tìm thấy bài viết nào trong danh mục này.</p>
                        <a href="{{ url($rootCanonical) }}" class="bn-btn bn-btn--primary uk-margin-top">Quay lại tất cả</a>
                    </div>
                @endif
            </div>
        </section>

        <!-- Search Modal -->
        <div id="modal-search" class="uk-modal ln-search-modal" uk-modal>
            <div class="uk-modal-dialog uk-modal-dialog-blank uk-height-viewport uk-flex uk-flex-center uk-flex-middle" style="background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px);">
                <button class="uk-modal-close-full uk-close-large" type="button" uk-close style="color: #fff;"></button>
                <div class="uk-width-large-1-2 uk-width-medium-2-3 uk-width-5-6">
                    <form action="{{ request()->url() }}" method="GET" class="ln-search-form">
                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                            placeholder="Nhập từ khóa tìm kiếm..." class="ln-search-input" autofocus 
                            style="background: transparent; border: none; border-bottom: 2px solid rgba(255,255,255,0.2); color: #fff; font-size: 32px; width: 100%; outline: none; padding: 20px 0;">
                        <div class="ln-search-instruction" style="color: rgba(255,255,255,0.5); margin-top: 20px; font-weight: 500;">Nhấn Enter để tìm kiếm sản phẩm hoặc tin tức</div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loadMoreBtn = document.getElementById('bn-load-more');
            const blogGrid = document.getElementById('bn-blog-grid');

            if (loadMoreBtn && blogGrid) {
                loadMoreBtn.addEventListener('click', async () => {
                    const url = loadMoreBtn.getAttribute('data-url');
                    if (!url) return;

                    loadMoreBtn.classList.add('loading');
                    loadMoreBtn.querySelector('span').textContent = 'Đang tải...';

                    try {
                        const response = await fetch(url);
                        const html = await response.text();
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        // Extract items and append
                        const newItems = doc.querySelectorAll('#bn-blog-grid .bn-blog-card');
                        newItems.forEach(item => {
                            // Re-initialize scrollspy for new items if needed
                            blogGrid.appendChild(item);
                        });

                        // Check for next page
                        const nextBtn = doc.getElementById('bn-load-more');
                        if (nextBtn) {
                            loadMoreBtn.setAttribute('data-url', nextBtn.getAttribute('data-url'));
                            loadMoreBtn.classList.remove('loading');
                            loadMoreBtn.querySelector('span').textContent = 'Xem thêm tin tức';
                        } else {
                            loadMoreBtn.closest('.bn-load-more-wrapper').remove();
                        }
                    } catch (error) {
                        console.error('Error loading more posts:', error);
                        loadMoreBtn.classList.remove('loading');
                        loadMoreBtn.querySelector('span').textContent = 'Thử lại';
                    }
                });
            }
        });
    </script>
@endsection
