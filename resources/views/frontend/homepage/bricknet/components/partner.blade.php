<section class="bn-section bn-partners" id="partners">
    <style>
        .bn-partners__head {
            max-width: 700px;
            margin: 0 auto 28px;
            text-align: center;
        }

        /* title đồng bộ theo hệ bricknet-home.css */
        .bn-partners__title {
            font-size: 3rem;
            margin-bottom: 0;
        }

        .bn-partners__swiper {
            overflow: hidden;
        }

        .bn-partners__slide {
            width: auto;
        }

        /* bỏ border/shadow, cho logo to hơn */
        .bn-partners__item {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 90px;
            width: 220px;
            padding: 10px 18px;
            background: transparent;
        }

        /* default grayscale, hover show màu gốc */
        .bn-partners__item img {
            max-width: 100%;
            max-height: 56px;
            object-fit: contain;
            filter: grayscale(1) saturate(0.1);
            opacity: 0.72;
            transition: filter .18s ease, opacity .18s ease;
        }

        .bn-partners__item:hover img {
            filter: none;
            opacity: 1;
        }

        @media (max-width: 575px) {
            .bn-partners__title { font-size: 2.2rem; }
            .bn-partners__item { width: 180px; height: 82px; }
            .bn-partners__item img { max-height: 52px; }
        }
    </style>

    <div class="bn-container">
        <div class="bn-sec-head bn-sec-head--center">
            <h2 class="bn-sec-title">Đối tác của chúng tôi</h2>
            <div class="bn-sec-desc">Hợp tác cùng những thương hiệu công nghệ hàng đầu thế giới để mang lại giá trị tốt nhất cho khách hàng.</div>
        </div>

        <div class="swiper bn-partners__swiper" data-bn-partners-swiper>
            <div class="swiper-wrapper">
                @foreach(($partners ?? []) as $partner)
                    @php
                        $name = data_get($partner, 'languages.0.pivot.name', 'Partner');
                        $link = $partner->link ?? '#';
                        $image = $partner->image ?? '';
                    @endphp
                    <div class="swiper-slide bn-partners__slide">
                        <a class="bn-partners__item" href="{{ $link }}" target="_blank" rel="nofollow noopener" aria-label="{{ $name }}">
                            @if(!empty($image))
                                <img src="{{ asset($image) }}" alt="{{ $name }}" loading="lazy">
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const el = document.querySelector('[data-bn-partners-swiper]');
            if (!el || typeof Swiper === 'undefined') return;

            // auto-scroll continuous
            // eslint-disable-next-line no-new
            new Swiper(el, {
                slidesPerView: 'auto',
                spaceBetween: 18,
                loop: true,
                speed: 9000,
                allowTouchMove: true,
                freeMode: {
                    enabled: true,
                    momentum: false,
                },
                autoplay: {
                    delay: 0,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                breakpoints: {
                    576: { spaceBetween: 18 },
                    992: { spaceBetween: 22 },
                },
            });
        });
    </script>
</section>
