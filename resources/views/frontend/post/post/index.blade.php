@extends('frontend.homepage.layout')
@section('header-class', 'header-inner')

@section('content')

    @php
        $postLang = $post->languages->first()?->pivot;
        $postTitle = $postLang?->name ?? ($post->name ?? '');
        $postDesc = $postLang?->description ?? '';
        $postImage = $post->image ?? asset('images/placeholder-news.jpg');

        $postDate = $post->released_at
            ? \Carbon\Carbon::parse($post->released_at)
            : \Carbon\Carbon::parse($post->created_at);
        $dateFormatted = $postDate->format('F d, Y');

        $catLang = $postCatalogue->languages->first()?->pivot ?? null;
        $catName = $catLang?->name ?? ($postCatalogue->name ?? 'Bài viết');
        $catUrl = $catLang?->canonical ?? ($postCatalogue->canonical ?? '#');
    @endphp

    <div id="scroll-progress"></div>
    <div class="linden-page">

        <section class="ln-page-header"
            style="background-image: url('{{ $property->image ?? asset('frontend/resources/img/homely/slider/1.webp') }}');">
            <div class="ln-page-header__content">
                <div class="uk-container uk-container-center">
                    <div class="ln-page-header__breadcrumb">
                        <a href="{{ route('home.index') }}">Trang Chủ</a>
                        <span class="separator">/</span>
                        <a href="{{ write_url($catUrl) }}">{{ $catName }}</a>
                        <span class="separator">/</span>
                        <span class="current-page">{{ \Str::limit($postTitle, 40) }}</span>
                    </div>
                    <h1 class="ln-page-header__title">Chi tiết bài viết</h1>
                    <div class="ln-page-header__desc">{{ $postTitle }}</div>
                </div>
            </div>
        </section>

        <section class="ln-post-overview">
            <div class="uk-container uk-container-center">
                <div class="uk-grid uk-grid-collapse uk-flex-middle">
                    <div class="uk-width-large-1-2 uk-width-medium-1-1">
                        <div class="ln-overview-image">
                            <img src="{{ asset($postImage) }}" alt="{{ $postTitle }}">
                        </div>
                    </div>
                    <div class="uk-width-large-1-2 uk-width-medium-1-1">
                        <div class="ln-overview-content">
                            <div class="ln-overview-meta">
                                <span class="ln-meta-date">{{ strtoupper($dateFormatted) }}</span>
                                <span class="ln-meta-sep">•</span>
                                <span class="ln-meta-cat">{{ strtoupper($catName) }}</span>
                            </div>
                            <h3 class="ln-overview-title">{{ $postTitle }}</h3>
                            @if ($postDesc)
                                <div class="ln-overview-desc">
                                    {!! strip_tags($postDesc) !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ln-post-content-section" style="background:var(--ln-white); padding: 80px 0;">
            <div class="uk-container uk-container-center">
                <div class="ln-post-content-inner">
                    {!! $contentWithToc ?? $postLang?->content !!}
                </div>
            </div>
        </section>

        @if (isset($postCatalogue->posts) &&
                $postCatalogue->posts->isNotEmpty() &&
                $postCatalogue->posts->where('id', '!=', $post->id)->count() > 0)
            <section class="ln-post-related-section" style="background:var(--ln-white); padding-bottom: 70px;">
                <div class="uk-container uk-container-center">
                    <div class="uk-text-center uk-container-center uk-width-large-2-3 uk-width-medium-4-5">
                        <h3 class="ln-section-title  uk-text-center">Bài viết liên quan</h3>
                        <span class="ln-section-desc is-visible uk-text-center">Khám phá bộ sưu tập hình ảnh nội thất và
                            ngoại
                            thất tuyệt đẹp của {{ $property->title ?? 'dự án' }}.</span>
                    </div>
                    <div class="ln-blog-grid uk-margin-large-top">
                        @foreach ($postCatalogue->posts->where('id', '!=', $post->id)->take(3) as $index => $related)
                            @php
                                $rLang = $related->languages->first()?->pivot;
                                $rTitle = $rLang?->name ?? '';
                                $rDesc = strip_tags($rLang?->description ?? '');
                                $rUrl = write_url($rLang?->canonical ?? '#');
                                $rImg = !empty($related->image)
                                    ? asset($related->image)
                                    : asset('images/placeholder-news.jpg');
                                $rDate = $related->released_at
                                    ? \Carbon\Carbon::parse($related->released_at)
                                    : \Carbon\Carbon::parse($related->created_at);
                                $rDateFormatted = $rDate->format('F d, Y');
                            @endphp

                            <article class="ln-blog-card"
                                uk-scrollspy="cls: uk-animation-slide-bottom-small; delay: {{ $index * 50 }}">
                                <a href="{{ $rUrl }}" class="ln-blog-card__link">
                                    <div class="ln-blog-card__image-wrapper">
                                        <img src="{{ $rImg }}" alt="{{ $rTitle }}"
                                            class="ln-blog-card__image" loading="lazy">
                                    </div>
                                    <div class="ln-blog-card__content">
                                        <div class="ln-blog-card__meta">
                                            <span class="ln-blog-card__date">{{ strtoupper($rDateFormatted) }}</span>
                                            <span class="ln-blog-card__sep">•</span>
                                            <span class="ln-blog-card__category">{{ strtoupper($catName) }}</span>
                                        </div>
                                        <h5 class="ln-blog-card__title">{{ $rTitle }}</h5>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

    </div>
@endsection
