<section class="bn-section bn-features">
    <div class="bn-container">
        <div class="bn-features__grid">
            <div class="bn-sec-head">
                <span class="bn-pill-label bn-pill-label--outline">{{ $system['home_features_label'] ?? 'Tại sao chọn chúng tôi' }}</span>
                <h2 class="bn-sec-title">{{ $system['home_features_title'] ?? 'Giải pháp vượt trội cho công trình' }}</h2>
            </div>
            
            <div class="bn-features__right">
                <div class="bn-features__right-title">
                    {{ $system['home_why_desc'] ?? 'Được tin tưởng bởi các đối tác hàng đầu, xây dựng cho kết quả lâu dài và được thiết kế để mang lại thành công bền vững, đáng tin cậy.' }}
                </div>
                
                <div class="bn-features__items">
                    @if(isset($coreValues) && count($coreValues))
                        @foreach($coreValues as $key => $val)
                            @php
                                $name = $val->languages->first()->pivot->name ?? '';
                                $description = $val->languages->first()->pivot->description ?? '';
                                $image = $val->image;
                                $isIcon = (str_contains($image, 'fa-'));
                            @endphp
                            <div class="bn-feature">
                                <div class="bn-feature__icon">
                                    @if($isIcon)
                                        <i class="fa {{ $image }}"></i>
                                    @else
                                        <img src="{{ (str_contains($image, 'http')) ? $image : asset($image) }}" alt="{{ $name }}" style="width: 32px; height: 32px; object-fit: contain;">
                                    @endif
                                </div>
                                <h3 class="bn-feature__title">{{ $name }}</h3>
                                <p class="bn-feature__desc">{{ $description }}</p>
                            </div>
                        @endforeach
                    @endif
            </div>
        </div>
    </div>
</section>
