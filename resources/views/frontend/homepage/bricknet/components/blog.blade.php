<section class="bn-section bn-blog">
    <div class="bn-container">
        <div class="bn-sec-head">
            <span class="bn-pill-label bn-pill-label--outline">{{ $system['home_blog_label'] ?? 'Bản tin' }}</span>
            <h2 class="bn-sec-title">{{ $system['home_blog_title'] ?? 'Kiến thức & Cập nhật' }}</h2>
            <div class="bn-sec-desc">{{ $system['home_blog_desc'] ?? 'Khám phá xu hướng, bí quyết và cảm hứng trong lĩnh vực xây dựng và kiến trúc.' }}</div>
        </div>
        
        <div class="bn-blog__grid">
            @if(isset($homePosts) && count($homePosts))
                @php
                    $mainPost = $homePosts->first();
                    $listPosts = $homePosts->slice(1);
                @endphp
                
                @if($mainPost)
                    @php
                        $trans = $mainPost->languages->first()->pivot ?? null;
                        $catName = $mainPost->post_catalogues->first()?->languages->first()->pivot->name ?? 'Tin tức';
                        $url = route('router.index', ['canonical' => $trans->canonical ?? '']);
                    @endphp
                    <article class="bn-blog-main">
                        <a href="{{ $url }}" class="bn-blog-main__link">
                            <div class="bn-blog-main__img-wrapper">
                                <img src="{{ $mainPost->image ?? '/frontend/resources/img/placeholder.jpg' }}" alt="{{ $trans->name ?? '' }}" class="bn-blog-main__img">
                            </div>
                            <div class="bn-blog-meta">
                                <span class="bn-pill-label">{{ $catName }}</span>
                                <span class="bn-blog-date">{{ $mainPost->created_at->format('d/m/Y') }}</span>
                            </div>
                            <h3 class="bn-blog-title">{{ $trans->name ?? '' }}</h3>
                            <div class="bn-blog-author">
                                <span>&bull; {{ rand(5, 15) }} phút đọc</span>
                            </div>
                        </a>
                    </article>
                @endif
                
                <div class="bn-blog-list">
                    @foreach($listPosts as $post)
                        @php
                            $trans = $post->languages->first()->pivot ?? null;
                            $catName = $post->post_catalogues->first()?->languages->first()->pivot->name ?? 'Tin tức';
                            $url = route('router.index', ['canonical' => $trans->canonical ?? '']);
                        @endphp
                        <article class="bn-blog-item">
                            <a href="{{ $url }}" class="bn-blog-item__link">
                                <div class="bn-blog-meta">
                                    <span class="bn-pill-label">{{ $catName }}</span>
                                    <span class="bn-blog-date">{{ $post->created_at->format('d/m/Y') }}</span>
                                </div>
                                <h3 class="bn-blog-title">{{ $trans->name ?? '' }}</h3>
                                <div class="bn-blog-author">
                                    <span>&bull; {{ rand(3, 10) }} phút đọc</span>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
