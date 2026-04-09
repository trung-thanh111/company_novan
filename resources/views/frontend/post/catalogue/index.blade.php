@extends('frontend.homepage.layout')

@section('header-class', 'header-inner')
@section('content')
    <div id="scroll-progress"></div>
    <div class="linden-page">
        <section class="ln-page-header"
            style="background-image: url('{{ isset($property) && $property->image ? $property->image : (isset($postCatalogue) && $postCatalogue->image ? $postCatalogue->image : asset('frontend/resources/img/homely/slider/1.webp')) }}');">
            <div class="ln-page-header__content">
                <div class="uk-container uk-container-center">
                    <div class="ln-page-header__breadcrumb">
                        <a href="{{ route('home.index') }}">Trang Chủ</a>
                        <span class="separator">/</span>
                        <span class="current-page">
                            @if (isset($postCatalogue) && $postCatalogue && $postCatalogue->parent_id != 0)
                                {{ $postCatalogue->languages->first()->pivot->name ?? 'Bài viết' }}
                            @else
                                Bài Viết
                            @endif
                        </span>
                    </div>
                    <h1 class="ln-page-header__title">
                        @if (isset($postCatalogue) && $postCatalogue && $postCatalogue->parent_id != 0)
                            {{ $postCatalogue->languages->first()->pivot->name ?? 'Bài viết' }}
                        @else
                            Bài Viết
                        @endif
                    </h1>
                    <div class="ln-page-header__desc">Cập nhật những thông tin mới nhất về thị trường bất động sản và các dự
                        án của {{ $system['homepage_brand'] ?? 'Linden Residence' }}.</div>
                </div>
            </div>
        </section>

        <section class="ln-blog-filter">
            <div class="uk-container uk-container-center">
                <div class="ln-filter-inner">
                    <ul class="ln-post-tabs">
                        @php
                            $rootCanonical = 'bai-viet.html'; // Mặc định
                            $isRootActive = true;
                            if (isset($postCatalogue) && $postCatalogue) {
                                $isRootActive = $postCatalogue->parent_id == 0;
                                if ($postCatalogue->parent_id != 0) {
                                    if (isset($breadcrumb)) {
                                        foreach ($breadcrumb as $item) {
                                            if ($item->parent_id == 0) {
                                                $rootCanonical = rtrim($item->canonical, '/') . '.html';
                                                break;
                                            }
                                        }
                                    }
                                } else {
                                    $rootCanonical = rtrim($postCatalogue->canonical, '/') . '.html';
                                }
                            }
                        @endphp
                        <li class="{{ $isRootActive ? 'active' : '' }}">
                            <a href="{{ url($rootCanonical) }}">tất cả</a>
                        </li>
                        @if (isset($categories))
                            @foreach ($categories as $cat)
                                <li
                                    class="{{ isset($postCatalogue) && $postCatalogue && $postCatalogue->id == $cat->id ? 'active' : '' }}">
                                    <a href="{{ url(rtrim($cat->canonical, '/') . '.html') }}">
                                        {{ strtoupper($cat->name) }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    <div class="ln-post-search-trigger">
                        <a href="#modal-search" data-uk-modal aria-label="Search"><i class="fa fa-search"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="pc-news-section">
            <div class="uk-container uk-container-center">

                @if (!empty($posts) && $posts->count() > 0)
                    <div class="ln-blog-grid">
                        @foreach ($posts as $index => $post)
                            @php
                                $postImage = !empty($post->image)
                                    ? asset($post->image)
                                    : asset('images/placeholder-news.jpg');
                                $postUrl = !empty($post->canonical)
                                    ? url(
                                        rtrim($post->canonical, '/') .
                                            (str_ends_with($post->canonical, '.html') ? '' : '.html'),
                                    )
                                    : '#';
                                $postName = $post->name ?? 'Untitled';

                                $publishedAt = !empty($post->released_at)
                                    ? \Carbon\Carbon::parse($post->released_at)
                                    : \Carbon\Carbon::parse($post->created_at);
                                $dateFormatted = $publishedAt->format('F d, Y');

                                $categoryName = '';
                                if ($post->post_catalogues->count() > 0) {
                                    $cat = $post->post_catalogues->first();
                                    $categoryName = $cat->languages->first()->pivot->name ?? '';
                                }
                            @endphp

                            <article class="ln-blog-card"
                                uk-scrollspy="cls: uk-animation-slide-bottom-small; delay: {{ $index * 50 }}">
                                <a href="{{ $postUrl }}" class="ln-blog-card__link">
                                    <div class="ln-blog-card__image-wrapper">
                                        <img src="{{ $postImage }}" alt="{{ $postName }}"
                                            class="ln-blog-card__image" loading="{{ $index < 3 ? 'eager' : 'lazy' }}">
                                    </div>
                                    <div class="ln-blog-card__content">
                                        <div class="ln-blog-card__meta">
                                            <span class="ln-blog-card__date">{{ strtoupper($dateFormatted) }}</span>
                                            @if ($categoryName)
                                                <span class="ln-blog-card__sep">•</span>
                                                <span class="ln-blog-card__category">{{ strtoupper($categoryName) }}</span>
                                            @endif
                                        </div>
                                        <h5 class="ln-blog-card__title">{{ $postName }}</h5>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>

                    @if ($posts->hasPages())
                        <div class="pc-pagination uk-margin-large-top">
                            {{ $posts->links('frontend.component.pagination') }}
                        </div>
                    @endif
                @else
                    <div class="pc-empty-state">
                        <p class="pc-empty-state__text">Không tìm thấy bài viết nào.</p>
                    </div>
                @endif
            </div>
        </section>

        <!-- Search Modal -->
        <div id="modal-search" class="uk-modal ln-search-modal">
            <div class="uk-modal-dialog uk-modal-dialog-blank uk-height-viewport uk-flex uk-flex-center uk-flex-middle">
                <a class="uk-modal-close uk-close uk-close-alt"></a>
                <div class="uk-width-large-1-2 uk-width-medium-2-3 uk-width-5-6">
                    <form action="{{ request()->url() }}" method="GET" class="ln-search-form">
                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                            placeholder="Nhập từ khóa tìm kiếm..." class="ln-search-input" autofocus>
                        <div class="ln-search-instruction">Nhấn Enter để tìm kiếm</div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
