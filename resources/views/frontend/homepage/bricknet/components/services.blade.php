<section class="bn-section bn-services" id="SERVICES">
    <div class="bn-container">
        <div class="bn-sec-head bn-sec-head--center">
            <span class="bn-pill-label bn-pill-label--outline">{{ $system['home_services_label'] ?? 'Dịch vụ của chúng tôi' }}</span>
            <h2 class="bn-sec-title">{{ $system['home_services_title'] ?? 'Chúng tôi xây dựng mọi thứ bạn cần' }}</h2>
            <div class="bn-sec-desc">Giải pháp công nghệ toàn diện và đổi mới giúp doanh nghiệp của bạn phát triển bứt phá trong kỷ nguyên số.</div>
            <p>{{ $system['home_services_desc'] ?? 'Chúng tôi cung cấp các giải pháp xây dựng tùy chỉnh, được thiết kế để đáp ứng nhu cầu của bạn và thực hiện với sự chính xác và chuyên môn cao.' }}</p>
        </div>
        
        <div class="bn-services__grid">
            @foreach(($companyServices ?? []) as $i => $service)
                @php
                    $name = data_get($service, 'languages.0.pivot.name', '');
                    $desc = data_get($service, 'languages.0.pivot.description', '');
                    $image = $service->image ?? '';
                    $num = str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT);
                @endphp
                <article class="bn-service-card">
                    <div class="bn-service-card__num">{{ $num }}</div>
                    <h3 class="bn-service-card__title">{{ $name }}</h3>
                    <p class="bn-service-card__desc">{{ $desc }}</p>
                    @if(!empty($image))
                        <img src="{{ asset($image) }}" class="bn-service-card__img" alt="{{ $name }}" loading="lazy">
                    @endif
                </article>
            @endforeach
        </div>
        <div style="margin-top: 18px;">
                <a href="/dich-vu.html" class="bn-btn bn-btn--outline">Xem thêm <i class="fa fa-arrow-right"></i></a>
            </div>
    </div>
</section>
