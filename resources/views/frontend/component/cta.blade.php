<section class="bn-cta-section">
    <div class="bn-container">
        <div class="bn-cta-card">
            <div class="bn-cta-card__left">
                <h2 class="bn-cta-card__title">{{ $title ?? 'Sẵn sàng để kiến tạo những giải pháp đột phá?' }}</h2>
                <p class="bn-cta-card__desc">{{ $desc ?? 'Liên hệ với đội ngũ chuyên gia của chúng tôi để bắt đầu hành trình chuyển đổi số toàn diện cho doanh nghiệp của bạn.' }}</p>
                <a href="{{ $btnLink ?? write_url('lien-he') }}" class="bn-btn bn-btn--accent bn-cta-card__btn">
                    {{ $btnText ?? 'TƯ VẤN NGAY' }}
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
            <div class="bn-cta-card__right">
                @php
                    $ctaImage = $image ?? ((isset($album) && !empty($album) && isset($album[0])) ? $album[0] : ($project->image ?? 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&q=80&w=1200'));
                @endphp
                <div class="bn-cta-card__img-wrapper">
                    <img src="{{ $ctaImage }}" alt="CTA Image" class="bn-cta-card__img">
                </div>
            </div>
        </div>
    </div>

    <style>
        .bn-cta-section {
            padding: var(--bn-section-padding);
            background: #fff;
        }
        .bn-cta-card {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            background: #fdf8f4; /* Soft cream/beige */
            border-radius: var(--bn-radius-lg);
            overflow: hidden;
            min-height: 480px;
        }
        .bn-cta-card__left {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 30px;
        }
        .bn-cta-card__title {
            font-size: 42px;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.2;
            margin: 0;
            letter-spacing: -0.02em;
        }
        .bn-cta-card__desc {
            font-size: 16px;
            color: #64748b;
            line-height: 1.6;
            max-width: 500px;
            margin: 0;
        }
        .bn-cta-card__btn {
            background: #ff6b3d; /* Vibrant orange from image */
            color: #fff;
            padding: 18px 32px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 15px;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            width: fit-content;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .bn-cta-card__btn:hover {
            background: #e65c00;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(230, 92, 0, 0.2);
        }
        .bn-cta-card__right {
            background: #fcf4f4; /* Light pinkish bg from image */
            position: relative;
        }
        .bn-cta-card__img-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .bn-cta-card__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.9;
        }

        @media (max-width: 991px) {
            .bn-cta-card {
                grid-template-columns: 1fr;
                border-radius: 24px;
            }
            .bn-cta-card__left {
                padding: 10px;
            }
            .bn-cta-card__title {
                font-size: 32px;
            }
            .bn-cta-card__right {
                height: 300px;
            }
        }
    </style>
</section>
