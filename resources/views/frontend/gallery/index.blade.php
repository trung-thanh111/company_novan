@extends('frontend.homepage.layout')
@section('header-class', 'header-inner')
@section('content')
    <div id="scroll-progress"></div>
    <div class="linden-page">

        <section class="ln-page-header"
            style="background-image: url('{{ $property->image ?? asset('frontend/resources/img/homely/slider/1.webp') }}');">
            <div class="ln-page-header__content">
                <div class="uk-container uk-container-center">
                    <div class="ln-page-header__breadcrumb">
                        <a href="{{ route('home.index') }}">Trang Chủ</a>
                        <span class="separator">/</span>
                        <span class="current-page">Thư Viện Ảnh</span>
                    </div>
                    <h1 class="ln-page-header__title">Thư Viện Ảnh</h1>
                    <div class="ln-page-header__desc">Khám phá bộ sưu tập hình ảnh nội thất và ngoại thất tuyệt đẹp của
                        {{ $property->title ?? 'dự án' }}.</div>
                </div>
            </div>
        </section>

        <section class="ln-gallery-page">
            <div class="uk-container uk-container-center">
                @php
                    $allImages = collect();
                    $catalogueImages = [];

                    if (isset($galleryCatalogues) && $galleryCatalogues->count() > 0) {
                        foreach ($galleryCatalogues as $catalogue) {
                            $catName = $catalogue->languages->first()->pivot->name ?? 'Không tên';
                            $catalogueImages[$catName] = collect();

                            if ($catalogue->galleries->count() > 0) {
                                foreach ($catalogue->galleries as $gallery) {
                                    if (is_array($gallery->album)) {
                                        foreach ($gallery->album as $img) {
                                            $catalogueImages[$catName]->push(['url' => $img, 'name' => $catName]);
                                            $allImages->push(['url' => $img, 'name' => $catName]);
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        if ($galleries->count() > 0) {
                            foreach ($galleries as $gallery) {
                                if (is_array($gallery->album)) {
                                    foreach ($gallery->album as $img) {
                                        $allImages->push(['url' => $img, 'name' => 'Tất Cả']);
                                    }
                                }
                            }
                        }
                    }
                @endphp

                <ul class="uk-subnav ln-gallery-page__tabs" data-uk-switcher="{connect:'#gallery-tabs'}" data-reveal="up">
                    <li><a href="#">Tất Cả ({{ $allImages->count() }})</a></li>
                    @foreach ($catalogueImages as $catName => $images)
                        @if ($images->count() > 0)
                            <li><a href="#">{{ $catName }} ({{ $images->count() }})</a></li>
                        @endif
                    @endforeach
                </ul>

                <ul id="gallery-tabs" class="uk-switcher">
                    {{-- Tất Cả Tab --}}
                    <li>
                        <div class="ln-gallery-page__grid">
                            @if ($allImages->count() > 0)
                                @foreach ($allImages as $img)
                                    <a href="{{ $img['url'] }}" class="ln-gallery-page__item" data-fancybox="gallery-all"
                                        data-caption="{{ $img['name'] }}" data-reveal="up">
                                        <img src="{{ $img['url'] }}" alt="{{ $img['name'] }}" loading="lazy">
                                        <div class="gallery-overlay"><span class="gallery-zoom"><i
                                                    class="fa fa-expand"></i></span></div>
                                    </a>
                                @endforeach
                            @else
                                @for ($i = 1; $i <= 6; $i++)
                                    <a href="{{ asset('frontend/resources/img/homely/gallery/' . $i . '.webp') }}"
                                        class="ln-gallery-page__item" data-fancybox="gallery-all" data-reveal="up">
                                        <img src="{{ asset('frontend/resources/img/homely/gallery/' . $i . '.webp') }}"
                                            alt="Gallery {{ $i }}" loading="lazy">
                                        <div class="gallery-overlay"><span class="gallery-zoom"><i
                                                    class="fa fa-expand"></i></span></div>
                                    </a>
                                @endfor
                            @endif
                        </div>
                    </li>

                    {{-- Category Tabs --}}
                    @foreach ($catalogueImages as $catName => $images)
                        @if ($images->count() > 0)
                            <li>
                                <div class="ln-gallery-page__grid">
                                    @foreach ($images as $img)
                                        <a href="{{ $img['url'] }}" class="ln-gallery-page__item"
                                            data-fancybox="gallery-{{ Str::slug($catName) }}"
                                            data-caption="{{ $img['name'] }}" data-reveal="up">
                                            <img src="{{ $img['url'] }}" alt="{{ $img['name'] }}" loading="lazy">
                                            <div class="gallery-overlay"><span class="gallery-zoom"><i
                                                        class="fa fa-expand"></i></span></div>
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </section>

    </div>

@endsection
