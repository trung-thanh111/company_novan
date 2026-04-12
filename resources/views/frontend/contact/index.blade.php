@extends('frontend.homepage.layout')


@push('styles')
    <style>
        /* ── Hero (synced with About page) ── */
        .bn-section-hero-static {
            position: relative;
            padding: 160px 0 140px;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #ffffff;
            overflow: hidden;
        }
        .bn-section-hero-static::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.65));
            z-index: 1;
        }
        .bn-section-hero-static .bn-container {
            position: relative;
            z-index: 2;
        }
        .bn-section-hero-static .bn-sec-title--big {
            color: #ffffff !important;
        }
        .bn-section-hero-static .bn-sec-desc {
            margin-top: 24px;
        }

        /* ── Contact Section ── */
        .bn-contact-section {
            background-color: #1a202c;
            padding: 80px 0;
            color: #fff;
        }

        .bn-contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: start;
        }

        .bn-contact-details {
            padding-top: 20px;
        }
        .bn-contact-details .bn-pill-label {
            background: rgba(255,255,255,0.1);
            color: #fff;
            border-color: rgba(255,255,255,0.2);
        }
        .bn-contact-details .bn-sec-title {
            color: #fff;
            margin-top: 20px;
            margin-bottom: 24px;
        }
        .bn-contact-details__desc {
            color: #cbd5e1;
            margin-bottom: 40px;
            font-size: 16px;
            line-height: 1.6;
        }
        .bn-contact-details__divider {
            width: 100%;
            height: 1px;
            background: rgba(255,255,255,0.1);
            margin-bottom: 40px;
        }
        .bn-contact-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
        .bn-contact-info-grid__full {
            grid-column: span 2;
        }
        .bn-contact-info-grid h4 {
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 8px;
        }
        .bn-contact-info-grid a,
        .bn-contact-info-grid p {
            color: #cbd5e1;
            font-weight: 600;
        }
        .bn-contact-info-grid p {
            line-height: 1.6;
        }

        /* ── Contact Form Card ── */
        .bn-contact-form-wrapper {
            background: #fff;
            border-radius: 12px;
            padding: 40px;
            color: #1a202c;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .bn-contact-form-wrapper__title {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
        }
        .bn-contact-form__grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .bn-contact-form__field {
            margin-bottom: 5px;
        }
        .bn-contact-form__field--full {
            grid-column: span 2;
        }
        .bn-contact-form__label {
            display: block;
            font-size: 13px;
            margin-bottom: 6px;
            font-weight: 600;
        }
        .bn-contact-form__input,
        .bn-contact-form__select,
        .bn-contact-form__textarea {
            width: 100%;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 12px 16px;
            outline: none;
            background: #f8fafc;
            font-family: inherit;
            font-size: 14px;
            transition: border-color 0.2s ease;
        }
        .bn-contact-form__input:focus,
        .bn-contact-form__select:focus,
        .bn-contact-form__textarea:focus {
            border-color: var(--bn-accent, #e65c00);
        }
        .bn-contact-form__select {
            cursor: pointer;
        }
        .bn-contact-form__textarea {
            resize: vertical;
        }
        .bn-contact-form__submit {
            grid-column: span 2;
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        .bn-contact-form__submit .bn-btn {
            padding: 14px 40px;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }
        .bn-contact-form__submit .bn-btn i {
            margin-left: 0px !important;
            color: var(--bn-accent) !important;
        }

        /* ── Form Success ── */
        .bn-contact-form__success {
            display: none;
            margin-top: 20px;
            padding: 20px;
            background: #ecfdf5;
            border: 1px solid #10b981;
            border-radius: 6px;
            text-align: center;
        }
        .bn-contact-form__success h4 {
            margin-bottom: 8px;
            color: #059669;
            font-size: 16px;
            font-weight: 600;
        }
        .bn-contact-form__success h4 i {
            margin-right: 6px;
        }
        .bn-contact-form__success p {
            color: #047857;
            margin: 0;
            font-size: 14px;
        }

        /* ── Map Section ── */
        .bn-section--map {
            padding-top: 80px;
            padding-bottom: 40px;
        }
        .bn-section--map .bn-sec-head {
            margin-bottom: 40px;
        }
        .bn-map-container {
            border-radius: 12px;
            overflow: hidden;
            height: 450px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.1);
        }
        .bn-map-container iframe {
            border: 0;
        }

        /* ── FAQ Section ── */
        .bn-section--faq {
            padding: 60px 0;
        }
        .bn-section--faq .bn-container {
            max-width: 800px;
        }
        .bn-section--faq .bn-sec-head {
            margin-bottom: 50px;
        }
        .bn-faq-list {
            display: flex;
            flex-direction: column;
        }
        .bn-faq-item {
            border-bottom: 1px solid #e2e8f0;
            padding: 24px 0;
        }
        .bn-faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 500;
            font-size: 18px;
            color: #1e293b;
            transition: all 0.2s ease;
        }
        .bn-faq-question__inner {
            display: flex;
            gap: 24px;
            align-items: center;
        }
        .bn-faq-question__num {
            color: var(--bn-accent, #e65c00);
            font-weight: 600;
            font-size: 16px;
        }
        .bn-faq-question__icon {
            color: #94a3b8;
            margin-left: 15px;
        }
        .bn-faq-answer {
            display: none;
            padding-top: 20px;
            padding-left: 45px;
            color: #475569;
            line-height: 1.6;
            font-size: 15px;
        }

        /* ── CTA Wrapper ── */
        .bn-contact-cta-wrap {
            padding-bottom: 60px;
        }

        /* ── Responsive ── */
        @media (max-width: 992px) {
            .bn-contact-grid {
                grid-template-columns: 1fr;
            }
            .bn-contact-info-grid {
                grid-template-columns: 1fr;
            }
            .bn-contact-info-grid__full {
                grid-column: span 1;
            }
            .bn-contact-form__grid {
                grid-template-columns: 1fr;
            }
            .bn-contact-form__field--full,
            .bn-contact-form__submit {
                grid-column: span 1;
            }
        }
    </style>
@endpush

@section('content')
<main class="bn-page">
    <div id="scroll-progress"></div>

    <!-- HERO SECTION -->
    <section class="bn-section-hero-static" style="background-image: url('{{ $heroGallery->image ?? asset('frontend/resources/img/homely/slider/1.webp') }}');">
        <div class="bn-container">
            <div class="bn-sec-head bn-sec-head--center">
                <h1 class="bn-sec-title bn-sec-title--big">Hãy Cùng Thảo Luận Về Dự Án Của Bạn</h1>
                <div class="bn-sec-desc">
                    Cho dù bạn đang lên kế hoạch, xây dựng hay cải tạo, chúng tôi đều sẵn sàng trợ giúp. Hãy liên hệ ngay hôm nay và cùng nhau xây dựng nên những giải pháp công nghệ tuyệt vời.
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT MODULE -->
    <section class="bn-contact-section">
        <div class="bn-container">
            <div class="bn-contact-grid">
                <div class="bn-contact-details">
                    <span class="bn-pill-label">Chi Tiết Liên Hệ</span>
                    <h2 class="bn-sec-title">Hãy Làm Việc Cùng Nhau</h2>
                    <p class="bn-contact-details__desc">Cho dù bạn có câu hỏi, cần thêm thông tin về dịch vụ của chúng tôi, hay muốn thảo luận về sự hợp tác tiềm năng, chúng tôi luôn sẵn sàng hỗ trợ.</p>

                    <div class="bn-contact-details__divider"></div>

                    <div class="bn-contact-info-grid">
                        <div>
                            <h4>Tin Nhắn</h4>
                            <a href="mailto:{{ $system['contact_email'] ?? 'contact@novan.com' }}">{{ $system['contact_email'] ?? 'contact@novan.com' }}</a>
                        </div>
                        <div>
                            <h4>Điện Thoại</h4>
                            <a href="tel:{{ $system['contact_hotline'] ?? '(084) 456-2390' }}">{{ $system['contact_hotline'] ?? '(084) 456-2390' }}</a>
                        </div>
                        <div class="bn-contact-info-grid__full">
                            <h4>Địa Chỉ</h4>
                            <p>{{ $system['contact_address'] ?? '82 Westfeld Industrial Blvd, San Diego, CA 92121' }}</p>
                        </div>
                        <div class="bn-contact-info-grid__full">
                            <h4>Giờ Mở Cửa</h4>
                            <p>
                                Thứ Hai - Thứ Sáu: 8:00 Sáng - 5:00 Chiều<br>
                                Thứ Bảy: 8:00 Sáng - 12:00 Trưa<br>
                                Chủ Nhật: Đóng Cửa
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right: Form -->
                <div class="bn-contact-form-wrapper">
                    <h3 class="bn-contact-form-wrapper__title">Gửi Tin Nhắn!</h3>

                    <form id="visit-request-form" method="post" action="{{ route('visit-request.store') }}">
                        @csrf
                        <div class="bn-contact-form__grid">
                            <div class="bn-contact-form__field bn-contact-form__field--full">
                                <label class="bn-contact-form__label">Họ và Tên *</label>
                                <input type="text" name="full_name" placeholder="Họ và tên của bạn" required class="bn-contact-form__input">
                            </div>
                            <div class="bn-contact-form__field">
                                <label class="bn-contact-form__label">Email *</label>
                                <input type="email" name="email" placeholder="Email của bạn" required class="bn-contact-form__input">
                            </div>
                            <div class="bn-contact-form__field">
                                <label class="bn-contact-form__label">Số Điện Thoại *</label>
                                <input type="text" name="phone" placeholder="Số điện thoại" required class="bn-contact-form__input">
                            </div>
                            <div class="bn-contact-form__field bn-contact-form__field--full">
                                <label class="bn-contact-form__label">Loại Dự Án *</label>
                                <select name="project_type" required class="bn-contact-form__select">
                                    <option value="">Chọn loại dự án</option>
                                    @if(isset($companyServices) && count($companyServices))
                                        @foreach($companyServices as $service)
                                            <option value="{{ data_get($service, 'languages.0.pivot.name', 'Dịch vụ') }}">{{ data_get($service, 'languages.0.pivot.name', 'Dịch vụ') }}</option>
                                        @endforeach
                                    @else
                                        <option value="Xây nhà ở">Xây nhà ở</option>
                                        <option value="Xây dựng thương mại">Xây dựng thương mại</option>
                                        <option value="Cải tạo & Nâng cấp">Cải tạo & Nâng cấp</option>
                                    @endif
                                </select>
                            </div>
                            <div class="bn-contact-form__field bn-contact-form__field--full">
                                <label class="bn-contact-form__label">Tin Nhắn *</label>
                                <textarea name="message" placeholder="Cho chúng tôi biết về thông tin dự án của bạn..." required class="bn-contact-form__textarea" rows="4"></textarea>
                            </div>
                            <div class="bn-contact-form__submit">
                                <button type="submit" class="bn-btn bn-btn--primary">Gửi Tin Nhắn <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <div class="bn-contact-form__success visit-form-success">
                            <h4><i class="fa fa-check-circle"></i> Tin nhắn đã được gửi!</h4>
                            <p>Cảm ơn bạn. Đội ngũ của chúng tôi sẽ liên hệ lại sớm nhất.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- MAP SECTION -->
    <section class="bn-section bn-section--map">
        <div class="bn-container">
            <div class="bn-sec-head bn-sec-head--center">
                <span class="bn-pill-label bn-pill-label--outline">Bản Đồ</span>
                <h2 class="bn-sec-title">Tìm Chúng Tôi Trên Bản Đồ</h2>
            </div>

            <div class="bn-map-container">
                {!! $system['contact_map'] ?? '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.324317070198!2d106.69736021462002!3d10.786450092316527!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f36bc4c10c1%3A0xe5eb6cba267f8976!2zMjEgxJAuIEzDqiBEdeG6qW4sIELhur9uIE5naMOpLCBRdeG6rW4gMSwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1628172935292!5m2!1sen!2s" width="100%" height="100%" allowfullscreen="" loading="lazy"></iframe>' !!}
            </div>
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section class="bn-section bn-section--faq">
        <div class="bn-container">
            <div class="bn-sec-head bn-sec-head--center">
                <span class="bn-pill-label bn-pill-label--outline">Hỏi Đáp</span>
                <h2 class="bn-sec-title">Giải đáp thắc mắc</h2>
                <p class="bn-sec-desc">Tìm câu trả lời nhanh cho những thắc mắc phổ biến nhất từ khách hàng của chúng tôi.</p>
            </div>

            <div class="bn-faq-list">
                @if(isset($faqs) && count($faqs))
                    @foreach($faqs as $index => $faq)
                        <div class="bn-faq-item">
                            <div class="bn-faq-question" onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'none' ? 'block' : 'none'; this.querySelector('i').className = this.nextElementSibling.style.display === 'none' ? 'fa fa-angle-down' : 'fa fa-angle-up';">
                                <div class="bn-faq-question__inner">
                                    <span class="bn-faq-question__num">{{ str_pad((string)($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                    <span>{{ data_get($faq, 'languages.0.pivot.name', 'Câu hỏi') }}</span>
                                </div>
                                <i class="fa fa-angle-down bn-faq-question__icon"></i>
                            </div>
                            <div class="bn-faq-answer">
                                {!! data_get($faq, 'languages.0.pivot.content', 'Nội dung trả lời') !!}
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach([
                        ['question' => 'Khu vực bạn phục vụ là ở đâu?', 'answer' => 'Chúng tôi phục vụ trên toàn quốc với các chi nhánh tại các thành phố lớn.'],
                        ['question' => 'Tôi nên liên hệ sớm bao lâu cho một dự án mới?', 'answer' => 'Tốt nhất là liên hệ trước ít nhất 1-2 tháng để đảm bảo lập trình tự kế hoạch tốt nhất.'],
                        ['question' => 'Bạn có cung cấp tư vấn miễn phí không?', 'answer' => 'Có, chúng tôi luôn có buổi tư vấn đầu tư miễn phí cho mọi khách hàng.'],
                        ['question' => 'Bạn có hỗ trợ làm giấy phép và tài liệu không?', 'answer' => 'Chúng tôi hỗ trợ toàn bộ quá trình xin giấy phép xây dựng và thủ tục pháp lý liên quan.'],
                        ['question' => 'Bạn làm việc với bản vẽ tùy chỉnh hay chỉ theo kế hoạch sẵn?', 'answer' => 'Chúng tôi làm cả hai, bao gồm thiết kế tùy chỉnh và thi công theo thiết kế có sẵn.']
                    ] as $index => $item)
                        <div class="bn-faq-item">
                            <div class="bn-faq-question" onclick="this.nextElementSibling.style.display = this.nextElementSibling.style.display === 'none' ? 'block' : 'none'; this.querySelector('i').className = this.nextElementSibling.style.display === 'none' ? 'fa fa-angle-down' : 'fa fa-angle-up';">
                                <div class="bn-faq-question__inner">
                                    <span class="bn-faq-question__num">{{ str_pad((string)($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                    <span>{{ $item['question'] }}</span>
                                </div>
                                <i class="fa fa-angle-down bn-faq-question__icon"></i>
                            </div>
                            <div class="bn-faq-answer">
                                {{ $item['answer'] }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    @include('frontend.component.cta')

</main>
@endsection
