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
                        <span class="current-page">Liên Hệ</span>
                    </div>
                    <h1 class="ln-page-header__title">Liên Hệ</h1>
                    <div class="ln-page-header__desc">Chúng tôi luôn sẵn sàng hỗ trợ bạn. Hãy liên hệ để được tư vấn chi
                        tiết về dự án.</div>
                </div>
            </div>
        </section>

        <section style="padding:0;">
            <div class="ln-contact-hero">
                <div class="ln-contact-hero__info">
                    <div class="ln-label" data-reveal="fade">Liên Hệ Với Chúng Tôi</div>
                    <h2 class="ln-section-title" data-reveal="up" style="font-size:38px;">Chúng Tôi Sẵn Sàng<br>Hỗ Trợ Bạn
                    </h2>
                    <div style="margin-top:30px;">
                        <div class="ln-contact-block" data-reveal="up">
                            <div class="contact-icon"><i class="fa fa-map-marker"></i></div>
                            <h4>Địa Chỉ</h4>
                            <p>{{ $property->address ?? '742 Evergreen Terrace, Quận 7, TP. HCM' }}</p>
                        </div>
                        <div class="ln-contact-block" data-reveal="up">
                            <div class="contact-icon"><i class="fa fa-phone"></i></div>
                            <h4>Số Điện Thoại</h4>
                            <p>{{ $system['contact_hotline'] ?? '(+84) 123 456 789' }}</p>
                        </div>
                        <div class="ln-contact-block" data-reveal="up">
                            <div class="contact-icon"><i class="fa fa-envelope-o"></i></div>
                            <h4>Email</h4>
                            <p>{{ $system['contact_email'] ?? 'info@linden.vn' }}</p>
                        </div>
                    </div>
                </div>
                <div class="ln-contact-hero__image"
                    style="background-image: url('{{ $property->image ?? asset('frontend/resources/img/homely/slider/1.webp') }}');">
                </div>
            </div>
        </section>

        <section class="ln-contact-form-section">
            <div class="uk-container uk-container-center">
                <div class="form-wrapper">
                    <div class="uk-text-center" style="margin-bottom:50px;">
                        <div class="ln-label ln-label-center" data-reveal="fade">Gửi Tin Nhắn</div>
                        <h2 class="ln-section-title" data-reveal="up">Đặt Lịch Tham Quan</h2>
                        <p class="ln-section-desc" style="margin:0 auto;" data-reveal="up">Hãy để lại thông tin và chúng tôi
                            sẽ liên hệ với bạn sớm nhất có thể.</p>
                    </div>
                    <form id="visit-request-form" method="post" action="{{ route('visit-request.store') }}"
                        data-reveal="up">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id ?? '' }}">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-1-1" style="margin-bottom:25px;"><input type="text" name="full_name"
                                    placeholder="Họ và tên *" required class="ln-input"></div>
                            <div class="uk-width-medium-1-2 uk-width-1-1" style="margin-bottom:25px;"><input type="email"
                                    name="email" placeholder="Email *" class="ln-input"></div>
                            <div class="uk-width-medium-1-2 uk-width-1-1" style="margin-bottom:25px;"><input type="text"
                                    name="phone" placeholder="Số điện thoại *" required class="ln-input"></div>
                            <div class="uk-width-medium-1-2 uk-width-1-1" style="margin-bottom:25px;">
                                <input type="text" name="preferred_date" placeholder="Ngày hẹn" class="ln-input"
                                    onfocus="this.type='date'" onblur="if(!this.value){this.type='text'}">
                            </div>
                            <div class="uk-width-medium-1-2 uk-width-1-1" style="margin-bottom:25px;">
                                <input type="text" name="preferred_time" placeholder="Giờ hẹn" class="ln-input"
                                    onfocus="this.type='time'" onblur="if(!this.value){this.type='text'}">
                            </div>
                            <div class="uk-width-1-1" style="margin-bottom:25px;">
                                <textarea name="message" class="ln-input ln-textarea" placeholder="Tin nhắn của bạn"></textarea>
                            </div>
                            <div class="uk-width-1-1 uk-text-center"><button type="submit" class="ln-btn-submit">Gửi Yêu
                                    Cầu</button></div>
                        </div>
                        <div class="visit-form-success"
                            style="display:none;margin-top:20px;padding:24px;background:var(--ln-cream);text-align:center;">
                            <h4 style="margin-bottom:8px;color:var(--ln-dark);">Yêu Cầu Đã Được Ghi Nhận!</h4>
                            <p style="color:var(--ln-gray);margin:0;">Cảm ơn bạn. Đội ngũ của chúng tôi sẽ liên hệ sớm
                                nhất.
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="ln-follow-section">
            <div class="uk-container uk-container-center">
                <div class="ln-label ln-label-center" data-reveal="fade">Kết Nối</div>
                <h2 class="ln-section-title" style="text-align:center;" data-reveal="up">Theo Dõi Chúng Tôi</h2>
                <div class="ln-follow-section__socials" data-reveal="up">
                    @if (!empty($system['social_facebook']))
                        <a href="{{ $system['social_facebook'] }}" target="_blank"><i class="fa fa-facebook"></i></a>
                    @endif
                    @if (!empty($system['social_instagram']))
                        <a href="{{ $system['social_instagram'] }}" target="_blank"><i class="fa fa-instagram"></i></a>
                    @endif
                    @if (!empty($system['social_twitter']))
                        <a href="{{ $system['social_twitter'] }}" target="_blank"><i class="fa fa-twitter"></i></a>
                    @endif
                    @if (!empty($system['social_youtube']))
                        <a href="{{ $system['social_youtube'] }}" target="_blank"><i class="fa fa-youtube-play"></i></a>
                    @endif
                    @if (!empty($system['social_tiktok']))
                        <a href="{{ $system['social_tiktok'] }}" target="_blank"><i class="fa fa-music"></i></a>
                    @endif
                    @if (!empty($system['social_linkedin']))
                        <a href="{{ $system['social_linkedin'] }}" target="_blank"><i class="fa fa-linkedin"></i></a>
                    @endif
                    @if (empty($system['social_facebook']) && empty($system['social_instagram']) && empty($system['social_youtube']))
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    @endif
                </div>
            </div>
        </section>

    </div>
@endsection
