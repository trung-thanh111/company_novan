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
                        <span class="current-page">Tiện Nghi</span>
                    </div>
                    <h1 class="ln-page-header__title">Tiện Nghi</h1>
                    <div class="ln-page-header__desc">Trải nghiệm cuộc sống với những tiện nghi được thiết kế tinh tế cho
                        phong cách sống hiện đại.</div>
                </div>
            </div>
        </section>

        <section class="ln-amenity-hero">
            <div class="uk-container uk-container-center">
                <div class="ln-label ln-label-center" data-reveal="fade">Nghệ Thuật Sống</div>
                <h2 class="ln-section-title" style="text-align:center;" data-reveal="up">Tất Cả Bạn Cần,<br>Đều Ở Đây</h2>
                <p class="ln-section-desc" style="margin:0 auto;text-align:center;" data-reveal="up">Mỗi tiện nghi đều được
                    chọn lọc và thiết kế kỹ lưỡng nhằm nâng cao chất lượng cuộc sống hàng ngày của bạn.</p>
            </div>
        </section>

        @php
            $sliderImages = collect();
            if (isset($galleries) && $galleries->count() > 0) {
                foreach ($galleries as $g) {
                    if (is_array($g->album)) {
                        foreach ($g->album as $img) {
                            $sliderImages->push($img);
                        }
                    }
                }
            }
        @endphp

        @if ($sliderImages->count() > 0)
            <section class="ln-amenity-slider" style="padding:0 !important;">
                <div class="swiper ln-amenity-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($sliderImages->take(8) as $img)
                            <div class="swiper-slide"><img src="{{ $img }}" alt="Tiện nghi"></div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next amenity-next" style="color:#fff;"></div>
                    <div class="swiper-button-prev amenity-prev" style="color:#fff;"></div>
                </div>
            </section>
        @endif

        <section class="ln-features">
            <div class="uk-container uk-container-center">
                <div class="uk-text-center" style="margin-bottom:60px;">
                    <div class="ln-label ln-label-center" data-reveal="fade">Nổi Bật</div>
                    <h2 class="ln-section-title" data-reveal="up">Đặc Điểm Căn Hộ</h2>
                </div>
                <div class="ln-features__grid" data-reveal-group>
                    @php
                        $defaultFeatures = [
                            [
                                'name' => 'Vị Trí Trung Tâm',
                                'desc' =>
                                    'Tất cả những gì bạn cần đều ở ngay cạnh — vị trí trung tâm với đầy đủ tiện ích hạ tầng.',
                                'icon' => 'fa-map-marker',
                            ],
                            [
                                'name' => 'Thiết Kế Đạt Giải',
                                'desc' =>
                                    'Căn hộ được thiết kế bởi kiến trúc sư hàng đầu với sự chú ý đến từng chi tiết nhỏ nhất.',
                                'icon' => 'fa-trophy',
                            ],
                            [
                                'name' => 'Tầm Nhìn Tuyệt Đẹp',
                                'desc' => 'Căn hộ sáng sủa và rộng rãi với tầm nhìn ấn tượng ra hướng sông thành phố.',
                                'icon' => 'fa-sun-o',
                            ],
                            [
                                'name' => 'Nhà Thông Minh',
                                'desc' => 'Công nghệ nhà thông minh cho phép điều khiển mọi thiết bị từ xa dễ dàng.',
                                'icon' => 'fa-wifi',
                            ],
                            [
                                'name' => 'Năng Lượng Xanh',
                                'desc' =>
                                    'Hệ thống pin năng lượng mặt trời giảm chi phí sinh hoạt hàng tháng hiệu quả.',
                                'icon' => 'fa-leaf',
                            ],
                            [
                                'name' => 'Hồ Bơi Riêng',
                                'desc' => 'Hồ bơi riêng thiết kế phong cách resort, bao quanh bởi sân vườn xanh mát.',
                                'icon' => 'fa-tint',
                            ],
                            [
                                'name' => 'An Ninh 24/7',
                                'desc' =>
                                    'Hệ thống an ninh thông minh với camera HD và khóa vân tay hoạt động liên tục.',
                                'icon' => 'fa-shield',
                            ],
                            [
                                'name' => 'Sân Vườn Xanh',
                                'desc' =>
                                    'Sân vườn thoáng đãng với cây xanh phủ bóng, tạo không gian sống gần gũi thiên nhiên.',
                                'icon' => 'fa-tree',
                            ],
                        ];
                        $displayFeatures =
                            $facilities->count() > 0
                                ? $facilities
                                : collect($defaultFeatures)->map(fn($f) => (object) $f);
                    @endphp
                    @foreach ($displayFeatures as $feature)
                        <div class="ln-features__item" data-reveal="up">
                            <div class="ln-features__icon" style="margin-bottom: 20px;">
                                @php
                                    $iconClass =
                                        isset($feature->icon) && !empty($feature->icon)
                                            ? $feature->icon
                                            : 'fa-check-circle-o';
                                    if (strpos($iconClass, 'fa ') === false && strpos($iconClass, 'fa-') === 0) {
                                        $iconClass = 'fa ' . $iconClass;
                                    }
                                @endphp
                                <i class="{{ $iconClass }}" style="color:var(--ln-accent); font-size: 42px;"></i>
                            </div>
                            <div class="ln-features__name">{{ $feature->name }}</div>
                            <div class="ln-features__desc">{{ $feature->description ?? ($feature->desc ?? '') }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </div>

@endsection
