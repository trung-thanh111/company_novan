<section class="bn-section bn-testimonials">
    <div class="bn-container">
        <div class="bn-sec-head bn-sec-head--split">
            <div>
                <span class="bn-pill-label bn-pill-label--outline">{{ $system['home_testi_label'] ?? 'Khách hàng nói gì' }}</span>
                <h2 class="bn-sec-title">{{ $system['home_testi_title'] ?? 'Trải nghiệm của khách hàng' }}</h2>
                <div class="bn-sec-desc">{{ $system['home_testi_desc'] ?? 'Những phản hồi chân thực từ khách hàng đã tin tưởng và đồng hành cùng chúng tôi.' }}</div>
            </div>
            <div class="bn-testimonials__nav" style="flex-shrink: 0;">
                <button class="bn-btn bn-btn--outline" id="bn-testi-prev" style="border-radius:50%; width: 52px; height: 52px; padding: 0;"><i class="fa fa-arrow-left" style="margin:0;"></i></button>
                <button class="bn-btn bn-btn--outline" id="bn-testi-next" style="border-radius:50%; width: 52px; height: 52px; padding: 0; margin-left:12px;"><i class="fa fa-arrow-right" style="margin:0;"></i></button>
            </div>
        </div>
        
        <div class="swiper bn-testimonials__swiper">
            <div class="swiper-wrapper">
                @foreach(($reviews ?? []) as $review)
                    <div class="swiper-slide">
                        <div class="bn-testi-card">
                            <div class="bn-testi-card__icon"><i class="fa fa-quote-left"></i></div>
                            <div class="bn-testi-card__quote">
                                "{{ $review->description }}"
                            </div>
                            <p class="bn-testi-card__text">
                                @php
                                    $score = max(0, min(5, (int) $review->score));
                                @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $score)
                                        <i class="fa fa-star" style="color:#fbbf24;"></i>
                                    @else
                                        <i class="fa fa-star-o" style="color:#e5e7eb;"></i>
                                    @endif
                                @endfor
                            </p>
                            <div class="bn-testi-card__author">
                                <strong>{{ $review->fullname ?? 'Khách hàng ẩn danh' }}</strong><br>
                                @if(!empty($review->email))
                                    <span style="font-size: 13px; opacity: .8;">{{ $review->email }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof Swiper === 'undefined') return;

            const swiper = new Swiper('.bn-testimonials__swiper', {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 40,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '#bn-testi-next',
                    prevEl: '#bn-testi-prev',
                },
                breakpoints: {
                    992: {
                        slidesPerView: 2,
                    },
                },
            });
        });
    </script>
    @endpush
</section>
