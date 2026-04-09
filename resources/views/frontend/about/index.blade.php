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
                        <span class="current-page">Giới Thiệu</span>
                    </div>
                    <h1 class="ln-page-header__title">{{ $property->title ?? 'Linden Residence' }}</h1>
                    <div class="ln-page-header__desc">
                        {{ $property->description_short ?? 'Không gian sống sang trọng được thiết kế dành cho cuộc sống hiện đại, nơi mỗi chi tiết đều được chăm chút tỉ mỉ.' }}
                    </div>
                </div>
            </div>
        </section>

        <section class="ln-building-concept">
            <div class="uk-container uk-container-center">
                <div class="ln-building-concept__grid">
                    <div data-reveal="left">
                        <div class="ln-label">Tầm Nhìn</div>
                        <h2 class="ln-section-title">{{ $property->title ?? 'Linden Residence' }}</h2>
                        <div class="ln-section-desc" style="max-width:100%;">{!! $property->description ??
                            'Ngôi nhà này được thiết kế tinh tế với tầm nhìn về một không gian sống hoàn hảo. Mỗi chi tiết kiến trúc đều phản ánh sự kết hợp giữa nghệ thuật và công năng hiện đại.' !!}</div>
                        <div style="margin-top:30px;"><a href="{{ url('/lien-he.html') }}" class="ln-btn">Liên Hệ Tư Vấn</a>
                        </div>
                    </div>
                    <div class="ln-building-concept__slider" data-reveal="right">
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
                            <div class="swiper ln-building-swiper">
                                <div class="swiper-wrapper">
                                    @foreach ($sliderImages->take(8) as $img)
                                        <div class="swiper-slide"><img src="{{ $img }}" alt="Không gian"
                                                style="width:100%;height:480px;object-fit:cover;"></div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-next building-next" style="color:#fff;"></div>
                                <div class="swiper-button-prev building-prev" style="color:#fff;"></div>
                            </div>
                        @else
                            <img src="{{ $property->image ?? asset('frontend/resources/img/homely/slider/1.webp') }}"
                                alt="Building" style="width:100%;height:480px;object-fit:cover;">
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section class="ln-floorplan">
            <div class="uk-container uk-container-center">
                <div class="uk-text-center" style="margin-bottom:50px;">
                    <div class="ln-label ln-label-center" data-reveal="fade">Quy Trình</div>
                    <h2 class="ln-section-title" data-reveal="up">Khám Phá Giải Pháp</h2>
                    <p class="ln-section-desc" style="margin:0 auto;text-align:center;" data-reveal="up">Mỗi giải pháp được thiết kế thông minh, tối ưu công năng và mang lại giá trị bền vững.</p>
                </div>
                <div class="ln-floorplan__grid">
                    <div data-reveal="left">
                        @if (isset($floorplans) && $floorplans->count() > 0)
                            <ul class="ln-floorplan__tabs uk-subnav" data-uk-switcher="{connect:'#floorplan-2'}">
                                @foreach ($floorplans as $i => $floor)
                                    <li><a
                                            href="#">{{ $floor->floor_label ?? 'Tầng ' . ($floor->floor_number ?? $i + 1) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <ul id="floorplan-2" class="uk-switcher">
                                @foreach ($floorplans as $floor)
                                    <li>
                                        <div class="ln-floorplan__image"><img
                                                src="{{ strpos($floor->plan_image, 'http') === 0 ? $floor->plan_image : asset($floor->plan_image ?? 'frontend/resources/img/homely/misc/floorplan.webp') }}"
                                                alt="{{ $floor->floor_label }}"></div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="ln-floorplan__image"><img
                                    src="{{ asset('frontend/resources/img/homely/misc/floorplan.webp') }}"
                                    alt="Sơ đồ tầng"></div>
                        @endif
                    </div>
                    <div data-reveal="right">
                        <div class="ln-floorplan__short-desc">Thiết kế tối ưu hóa công năng sử dụng với bố trí hợp lý, đảm
                            bảo sự riêng tư và thoải mái cho mọi thành viên.</div>
                        <div class="ln-spec-grid" style="display: none;">
                            <div class="ln-spec-card"><i class="fa fa-arrows-alt"></i>
                                <div class="spec-text"><span>{{ $property->area_sqm ?? '—' }} m²</span><br>Diện tích</div>
                            </div>
                            <div class="ln-spec-card"><i class="fa fa-bed"></i>
                                <div class="spec-text"><span>{{ $property->bedrooms ?? '—' }}</span><br>Phòng ngủ</div>
                            </div>
                            <div class="ln-spec-card"><i class="fa fa-bath"></i>
                                <div class="spec-text"><span>{{ $property->bathrooms ?? '—' }}</span><br>Phòng tắm</div>
                            </div>
                            <div class="ln-spec-card"><i class="fa fa-car"></i>
                                <div class="spec-text"><span>{{ $property->parking_spots ?? '—' }}</span><br>Chỗ đỗ xe
                                </div>
                            </div>
                            <div class="ln-spec-card"><i class="fa fa-building"></i>
                                <div class="spec-text"><span>{{ $property->floors ?? '—' }}</span><br>Số tầng</div>
                            </div>
                            <div class="ln-spec-card"><i class="fa fa-calendar"></i>
                                <div class="spec-text"><span>{{ $property->year_built ?? '—' }}</span><br>Năm xây dựng
                                </div>
                            </div>
                            <div class="ln-spec-card"><i class="fa fa-money"></i>
                                <div class="spec-text"><span>{{ number_format($property->price ?? 0, 0, ',', '.') }}
                                        {{ $property->price_unit ?? 'Tỷ' }}</span><br>Giá tiền</div>
                            </div>
                            <div class="ln-spec-card"><i class="fa fa-map-marker"></i>
                                <div class="spec-text"><span>{{ $property->district ?? '' }},
                                        {{ $property->city ?? '' }}</span><br>Vị trí</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ln-features">
            <div class="uk-container uk-container-center">
                <div class="uk-text-center" style="margin-bottom:60px;">
                    <div class="ln-label ln-label-center" data-reveal="fade">Giá Trị</div>
                    <h2 class="ln-section-title" data-reveal="up">Đặc Điểm Nổi Bật</h2>
                </div>
                <div class="ln-features__grid" data-reveal-group>
                    @php
                        $defaultFeatures = [
                            [
                                'name' => 'Vị Trí Trung Tâm',
                                'desc' => 'Tất cả những gì bạn cần đều ở ngay cạnh — trung tâm với đầy đủ tiện ích.',
                                'icon' => 'fa-map-marker',
                            ],
                            [
                                'name' => 'Thiết Kế Đạt Giải',
                                'desc' =>
                                    'Căn hộ được thiết kế bởi kiến trúc sư hàng đầu với sự chú ý đến từng chi tiết.',
                                'icon' => 'fa-trophy',
                            ],
                            [
                                'name' => 'Tầm Nhìn Tuyệt Đẹp',
                                'desc' => 'Căn hộ sáng sủa và rộng rãi với tầm nhìn ấn tượng ra hướng sông.',
                                'icon' => 'fa-sun-o',
                            ],
                            [
                                'name' => 'Nhà Thông Minh',
                                'desc' => 'Công nghệ nhà thông minh được thiết kế bởi nhóm kiến trúc nổi tiếng.',
                                'icon' => 'fa-wifi',
                            ],
                        ];
                        $displayFeatures =
                            isset($facilities) && $facilities->count() > 0
                                ? $facilities
                                : collect($defaultFeatures)->map(fn($f) => (object) $f);
                    @endphp
                    @foreach ($displayFeatures->take(4) as $feature)
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

        <section class="ln-interior">
            <div class="uk-container uk-container-center">
                <div class="uk-text-center" style="margin-bottom:40px;">
                    <div class="ln-label ln-label-center" data-reveal="fade">Thiết Kế</div>
                    <h2 class="ln-section-title" data-reveal="up">Thiết Kế Nội Thất</h2>
                </div>
                <ul class="uk-subnav ln-interior__tabs" data-uk-switcher="{connect:'#interior-tabs'}" data-reveal="up">
                    <li><a href="#">Hình Ảnh</a></li>
                    <li><a href="#">Video</a></li>
                </ul>
                <ul id="interior-tabs" class="uk-switcher" data-reveal="up">
                    <li>
                        <div class="ln-interior__slider">
                            @if ($sliderImages->count() > 0)
                                <div class="swiper ln-interior-swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($sliderImages as $img)
                                            <div class="swiper-slide"><img src="{{ $img }}" alt="Nội thất">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-next interior-next" style="color:#fff;"></div>
                                    <div class="swiper-button-prev interior-prev" style="color:#fff;"></div>
                                </div>
                            @else
                                <img src="{{ $property->image ?? asset('frontend/resources/img/homely/slider/1.webp') }}"
                                    alt="Nội thất" style="width:100%;height:550px;object-fit:cover;">
                            @endif
                        </div>
                    </li>
                    <li>
                        @if ($property->video_tour_url)
                            <div class="ln-video"
                                style="position: relative; width: 100%; height: 550px; display: flex; align-items: center; justify-content: center; background-image: url('{{ $property->image ?? asset('frontend/resources/img/homely/slider/1.webp') }}'); background-size: cover; background-position: center;">
                                <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.4);"></div>
                                <a href="{{ $property->video_tour_url }}" data-fancybox class="ln-video-play-btn">
                                    <i class="fa fa-play" style="margin-left: 6px;"></i>
                                </a>
                            </div>
                        @else
                            <div style="padding:80px;text-align:center;background:var(--ln-cream);color:var(--ln-gray);">
                                Video chưa được cập nhật</div>
                        @endif
                    </li>
                </ul>
            </div>
        </section>

        <section class="ln-schedule">
            <div class="uk-container uk-container-center">
                <div class="ln-schedule__form-header" data-reveal="up">
                    <div class="ln-label ln-label-center">Tôi Sẵn Sàng Hỗ Trợ</div>
                    <h2 class="ln-section-title" style="text-align:center;">Liên Hệ Với Chúng Tôi</h2>
                    <p class="ln-section-desc" style="margin:0 auto;text-align:center;">Bạn quan tâm đến dự án? Đừng ngần
                        ngại liên hệ để được tư vấn.</p>
                </div>
                <div class="ln-schedule__grid">
                    <div class="ln-schedule__agent-card" data-reveal="left">
                        @php $contactAgent = $primaryAgent ?? ($teams->first() ?? null); @endphp
                        @if ($contactAgent)
                            @if ($contactAgent->avatar ?? $contactAgent->image)
                                <img src="{{ $contactAgent->avatar ?? $contactAgent->image }}"
                                    alt="{{ $contactAgent->full_name }}">
                            @else
                                <div class="ln-avatar-fallback"
                                    style="width:280px;height:340px;margin:0 auto 24px;border-radius:0;font-size:60px;"><i
                                        class="fa fa-user"></i></div>
                            @endif
                            <div class="agent-name">{{ $contactAgent->full_name }}</div>
                            <div class="agent-role">Chuyên Viên Tư Vấn</div>
                            <div class="agent-contact">
                                <a href="tel:{{ $contactAgent->phone }}"><i class="fa fa-phone"></i>
                                    {{ $contactAgent->phone }}</a>
                                @if ($contactAgent->email ?? false)
                                    <a href="mailto:{{ $contactAgent->email }}"><i class="fa fa-envelope-o"></i>
                                        {{ $contactAgent->email }}</a>
                                @endif
                            </div>
                        @else
                            <div class="ln-avatar-fallback"
                                style="width:280px;height:340px;margin:0 auto 24px;border-radius:0;font-size:60px;"><i
                                    class="fa fa-user"></i></div>
                            <div class="agent-name">Tư Vấn Viên</div>
                            <div class="agent-role">Chuyên Viên Tư Vấn</div>
                        @endif
                    </div>
                    <div class="ln-schedule__form-wrapper" data-reveal="right">
                        <form id="visit-request-form" method="post" action="{{ route('visit-request.store') }}">
                            @csrf
                            <input type="hidden" name="property_id" value="{{ $property->id ?? '' }}">
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-1-1" style="margin-bottom:25px;"><input type="text"
                                        name="full_name" placeholder="Họ và tên *" required class="ln-input"></div>
                                <div class="uk-width-medium-1-2 uk-width-1-1" style="margin-bottom:25px;"><input
                                        type="email" name="email" placeholder="Email *" class="ln-input"></div>
                                <div class="uk-width-medium-1-2 uk-width-1-1" style="margin-bottom:25px;"><input
                                        type="text" name="phone" placeholder="Số điện thoại *" required
                                        class="ln-input"></div>
                                <div class="uk-width-medium-1-2 uk-width-1-1" style="margin-bottom:25px;"><input
                                        type="text" name="preferred_date" placeholder="Ngày hẹn" class="ln-input"
                                        onfocus="this.type='date'" onblur="if(!this.value){this.type='text'}"></div>
                                <div class="uk-width-medium-1-2 uk-width-1-1" style="margin-bottom:25px;"><input
                                        type="text" name="preferred_time" placeholder="Giờ hẹn" class="ln-input"
                                        onfocus="this.type='time'" onblur="if(!this.value){this.type='text'}"></div>
                                <div class="uk-width-1-1" style="margin-bottom:25px;">
                                    <textarea name="message" class="ln-input ln-textarea" placeholder="Tin nhắn của bạn"></textarea>
                                </div>
                                <div class="uk-width-1-1"><button type="submit" class="ln-btn-submit">Gửi Tin
                                        Nhắn</button></div>
                            </div>
                            <div class="visit-form-success"
                                style="display:none;margin-top:20px;padding:24px;background:var(--ln-cream);text-align:center;">
                                <h4 style="margin-bottom:8px;color:var(--ln-dark);">Yêu Cầu Đã Được Ghi Nhận!</h4>
                                <p style="color:var(--ln-gray);margin:0;">Cảm ơn bạn. Đội ngũ của chúng tôi sẽ liên hệ sớm
                                    nhất.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
