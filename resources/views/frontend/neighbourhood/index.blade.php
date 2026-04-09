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
                        <span class="current-page">Xung Quanh</span>
                    </div>
                    <h1 class="ln-page-header__title">Xung Quanh</h1>
                    <div class="ln-page-header__desc">Vị trí đắc địa với đầy đủ tiện ích xung quanh — từ trường học, bệnh
                        viện đến trung tâm thương mại.</div>
                </div>
            </div>
        </section>

        <section class="ln-neighbourhood-intro">
            <div class="uk-container uk-container-center">
                <div class="ln-neighbourhood-intro__grid">
                    <div class="ln-neighbourhood-intro__image" data-reveal="left">
                        <img src="{{ $property->image ?? asset('frontend/resources/img/homely/slider/1.webp') }}"
                            alt="{{ $property->title ?? 'Dự án' }}">
                    </div>
                    <div data-reveal="right">
                        <div class="ln-label">Trái Tim Thành Phố</div>
                        <h2 class="ln-section-title">{{ $property->title ?? 'Linden Residence' }}</h2>
                        <div class="ln-section-desc" style="max-width:100%;">{!! $property->description ??
                            'Tọa lạc tại vị trí trung tâm, dự án mang đến cuộc sống tiện nghi với mọi dịch vụ thiết yếu ngay trong tầm tay. Từ trường học quốc tế, bệnh viện hàng đầu đến các trung tâm thương mại sầm uất — tất cả đều nằm trong bán kính thuận tiện di chuyển.' !!}</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ln-location-slider">
            <div class="uk-container uk-container-center">
                <div class="ln-location-slider__header">
                    <div>
                        <div class="ln-label" data-reveal="fade">Khu Vực</div>
                        <h2 class="ln-section-title" data-reveal="up">Mọi Thứ Bạn Cần,<br>Ngay Bên Cạnh</h2>
                    </div>
                    <div class="ln-location-slider__nav" data-reveal="fade">
                        <button class="loc-prev"><i class="fa fa-angle-left"></i></button>
                        <button class="loc-next"><i class="fa fa-angle-right"></i></button>
                    </div>
                </div>

                @php
                    $locItems = collect();
                    if ($locationHighlights->count() > 0) {
                        foreach ($locationHighlights as $loc) {
                            $locItems->push($loc);
                        }
                    } else {
                        $defaults = [
                            [
                                'name' => 'Siêu Thị Vinmart',
                                'dist' => '15 phút đi bộ',
                                'desc' => 'Siêu thị tiện lợi với đa dạng sản phẩm chất lượng cao.',
                                'icon' => 'fa-shopping-basket',
                            ],
                            [
                                'name' => 'Phúc Long Coffee',
                                'dist' => '7 phút đi bộ',
                                'desc' => 'Quán cà phê nổi tiếng với đồ uống thủ công và bánh ngọt.',
                                'icon' => 'fa-coffee',
                            ],
                            [
                                'name' => 'Trường QT Việt Úc',
                                'dist' => '7 phút đi bộ',
                                'desc' => 'Trường quốc tế K-12 nổi tiếng với chất lượng giảng dạy.',
                                'icon' => 'fa-graduation-cap',
                            ],
                            [
                                'name' => 'AEON Mall',
                                'dist' => '6 phút lái xe',
                                'desc' => 'Trung tâm thương mại lớn với đầy đủ dịch vụ giải trí.',
                                'icon' => 'fa-building',
                            ],
                            [
                                'name' => 'Bệnh Viện FV',
                                'dist' => '10 phút lái xe',
                                'desc' => 'Bệnh viện quốc tế với đội ngũ bác sĩ giàu kinh nghiệm.',
                                'icon' => 'fa-hospital-o',
                            ],
                            [
                                'name' => 'Metro Line 1',
                                'dist' => '10 phút đi bộ',
                                'desc' => 'Tuyến metro đầu tiên kết nối Quận 1 - Quận 9.',
                                'icon' => 'fa-subway',
                            ],
                        ];
                        $locItems = collect($defaults)->map(fn($d) => (object) $d);
                    }
                @endphp

                <div class="swiper ln-location-swiper" data-reveal="up">
                    <div class="swiper-wrapper">
                        @foreach ($locItems as $item)
                            <div class="swiper-slide">
                                <div class="ln-location-card">
                                    <div class="ln-location-card__img">
                                        <img src="{{ $property->image ?? asset('frontend/resources/img/homely/slider/1.webp') }}"
                                            alt="{{ is_object($item) ? $item->name ?? '' : '' }}">
                                    </div>
                                    <div class="ln-location-card__body">
                                        <div class="ln-location-card__title">
                                            {{ is_object($item) ? $item->name ?? '' : '' }}</div>
                                        <div class="ln-location-card__time">
                                            {{ is_object($item) ? $item->distance_text ?? ($item->dist ?? '') : '' }}
                                        </div>
                                        <div class="ln-location-card__desc">
                                            {{ is_object($item) ? $item->description ?? ($item->desc ?? '') : '' }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="ln-cta-section">
            <div class="uk-container uk-container-center">
                <div class="ln-label ln-label-center" data-reveal="fade">Quan Tâm?</div>
                <h2 class="ln-section-title" data-reveal="up" style="text-align:center;font-size:42px;">Đặt Lịch Tham Quan
                    Ngay</h2>
                <p class="ln-section-desc" style="margin:0 auto 30px;text-align:center;" data-reveal="up">Hãy trực tiếp đến
                    xem và cảm nhận không gian sống tuyệt vời này.</p>
                <div style="text-align:center;" data-reveal="up"><a href="{{ url('/lien-he.html') }}" class="ln-btn">Liên
                        Hệ Ngay</a></div>
            </div>
        </section>

    </div>

@endsection
