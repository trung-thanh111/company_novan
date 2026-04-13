@php
    $heroImages = ['https://images.unsplash.com/photo-1541888081622-47ef8d91ea1e?auto=format&fit=crop&q=80'];
    if(isset($heroGallery) && !empty($heroGallery->album)) {
        $album = is_string($heroGallery->album) ? json_decode($heroGallery->album, true) : $heroGallery->album;
        if(is_array($album) && count($album) > 0) {
            $heroImages = $album;
        }
    }
@endphp

<section class="bn-hero">
    <div class="swiper bn-hero-bg-slider" style="position: absolute; top:0; left:0; width:100%; height:100%; z-index: 1;">
        <div class="swiper-wrapper">
            @foreach($heroImages as $img)
                <div class="swiper-slide bn-hero-slide" style="background-image: url('{{ $img }}'); background-size: cover; background-position: center;"></div>
            @endforeach
        </div>
        <!-- Optional: Add overlay for readability -->
        <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5); z-index: 2;"></div>
    </div>

    <!-- Content -->
    <div class="bn-container bn-hero__content" style="position: relative; z-index: 3;">
        <span class="bn-pill-label bn-pill-label--dark">{{ $system['home_hero_kicker'] ?? 'ĐỐI TÁC XÂY DỰNG TIN CẬY CỦA BẠN' }}</span>
        
        <h1 class="bn-hero__title">
            {{ $system['home_hero_title'] ?? 'Xây Dựng Tầm Nhìn Từ Nền Tảng' }}
        </h1>
        
        <p class="bn-hero__desc">
            {{ $system['home_hero_desc'] ?? 'Chúng tôi cung cấp dịch vụ thi công uy tín với chất lượng thi công vượt trội, đảm bảo tiến độ và tối ưu chi phí.' }}
        </p>
        
        <a href="/lien-he.html" class="bn-btn bn-btn--white">
            {{ $system['home_hero_btn'] ?? 'Nhận báo giá ngay' }} <i class="fa fa-arrow-right uk-text-muted"></i>
        </a>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if(typeof Swiper !== 'undefined') {
            new Swiper('.bn-hero-bg-slider', {
                loop: true,
                effect: 'fade',
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                allowTouchMove: false
            });
        }
    });
</script>
@endpush
