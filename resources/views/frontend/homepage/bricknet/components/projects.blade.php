@php
    $projImg = 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=1200&auto=format&fit=crop';
    $projTitle = 'Skyline Residence';
    
    // Get projects data $projects is expected from controller
@endphp
<section class="project-section" id="PROJECTS">
    <div class="bn-container">
        <!-- Section Header Optimized for Image 2 -->
        <div class="bn-sec-head bn-sec-head--split">
            <h2 class="bn-sec-title bn-sec-title--big">Dự án tiêu biểu</h2>
            <div class="bn-sec-desc">
                Cái nhìn cận cảnh về sự tinh tế trong từng công trình của chúng tôi, thể hiện chất lượng trong mỗi dự án.
            </div>
        </div>

        <div class="project-slider-wrapper">
            <div class="swiper project-slider">
                <div class="swiper-wrapper">
                    @if(isset($projects) && $projects->isNotEmpty())
                        @foreach($projects as $project)
                            @php
                                $lang = $project->languages->first() ?? null;
                                $name = data_get($lang, 'pivot.name', 'N/A');
                                $description = data_get($lang, 'pivot.description', '');
                                $catalogueName = data_get($project->project_catalogue->languages->first(), 'pivot.name', 'Dự án');
                                $canonical = data_get($lang, 'pivot.canonical', '#');
                                $year = date('Y', strtotime($project->created_at));
                                $client = $project->customer ?? 'Khách hàng cá nhân';
                            @endphp
                            <div class="swiper-slide">
                                <div class="project-slide">
                                    <!-- Left: Image with Overlay Description -->
                                    <div class="project-image-box">
                                        <a href="{{ write_url($canonical) }}">
                                            <img src="{{ asset($project->image) }}" alt="{{ $name }}">
                                        </a>
                                        <div class="project-image-overlay-desc">
                                            {!! Str::words(strip_tags($description), 35) !!}
                                        </div>
                                    </div>

                                    <!-- Right: Project Detailed Info -->
                                    <div class="project-info-box">
                                        <div class="project-category-pill">{{ $catalogueName }}</div>
                                        <h3 class="project-title-large">
                                            <a href="{{ write_url($canonical) }}">
                                                {{ $name }}
                                            </a>
                                        </h3>
                                        <div class="project-meta-info">
                                            <span class="year">{{ $year }}</span>
                                            <span class="client">{{ $client }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Mock if no DB projects for demo as requested -->
                        @for($i=1; $i<=3; $i++)
                        <div class="swiper-slide">
                            <div class="project-slide">
                                <div class="project-image-box">
                                    <img src="{{ $projImg }}" alt="Mock Project">
                                    <div class="project-image-overlay-desc">
                                        Một sự phục hồi tỉ mỉ của một biệt thự cổ kính, bảo tồn kiến thức cổ điển đồng thời tích hợp các tiện nghi hiện đại cho một trải nghiệm sống sang trọng.
                                    </div>
                                </div>
                                <div class="project-info-box">
                                    <div class="project-category-pill">Cải tạo</div>
                                    <h3 class="project-title-large">The Grand Oak Mansion</h3>
                                    <div class="project-meta-info">
                                        <span class="year">2025</span>
                                        <span class="client">Miller Estate</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    @endif
                </div>
            </div>

            <!-- Custom Segmented Progress Bar (Matches Image 2) -->
            <div class="project-pagination-container">
                <div class="project-progress-bar-wrap">
                    @php
                        $count = (isset($projects) && $projects->isNotEmpty()) ? $projects->count() : 3;
                    @endphp
                    @for($index = 0; $index < $count; $index++)
                        <div class="progress-step" data-index="{{ $index }}">
                            <div class="step-line"></div>
                            <span class="step-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const steps = document.querySelectorAll('.progress-step');
    if(!steps.length) return;

    if(typeof Swiper === 'undefined') return;
    
    const projectSwiper = new Swiper('.project-slider', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        speed: 800,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },
        on: {
            init: function() {
                updateProgress(0);
            },
            slideChange: function() {
                updateProgress(this.realIndex);
            }
        }
    });

    function updateProgress(index) {
        steps.forEach((step, i) => {
            if(i === index) {
                step.classList.add('is-active');
            } else {
                step.classList.remove('is-active');
            }
        });
    }

    steps.forEach((step, index) => {
        step.addEventListener('click', () => {
            projectSwiper.slideTo(index);
        });
    });
});
</script>
@endpush
