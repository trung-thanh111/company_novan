<section class="bn-section bn-blog">
    <div class="bn-container">
        <div class="bn-sec-head">
            <span class="bn-pill-label bn-pill-label--outline">{{ $system['home_blog_label'] ?? 'Bản tin' }}</span>
            <h2 class="bn-sec-title">{{ $system['home_blog_title'] ?? 'Kiến thức & Cập nhật' }}</h2>
            <div class="bn-sec-desc">{{ $system['home_blog_desc'] ?? 'Khám phá xu hướng, bí quyết và cảm hứng trong lĩnh vực xây dựng và kiến trúc.' }}</div>
        </div>
        
        <div class="bn-blog__grid" style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 60px; align-items: start;">
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
                        <a href="{{ $url }}" style="text-decoration: none; color: inherit; display: block;">
                            <div class="bn-blog-main__img-wrapper" style="border-radius: 12px; overflow: hidden; margin-bottom: 30px; height: 400px;">
                                <img src="{{ $mainPost->image ?? '/frontend/resources/img/placeholder.jpg' }}" alt="{{ $trans->name ?? '' }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div class="bn-blog-meta" style="margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between;">
                                <span class="bn-pill-label" style="background: var(--bn-accent-light); padding: 4px 12px; font-size: 12px; margin: 0; border-radius: 999px; text-transform: none; color: var(--bn-text-main); font-weight: 600;">{{ $catName }}</span>
                                <span style="font-size: 14px; opacity: 0.6;">{{ $mainPost->created_at->format('d/m/Y') }}</span>
                            </div>
                            <h3 class="bn-blog-title" style="font-size: 1.75rem; line-height: 1.3; margin-bottom: 15px; transition: color 0.3s;">{{ $trans->name ?? '' }}</h3>
                            <div class="bn-blog-author" style="font-size: 14px; opacity: 0.7;">
                                <span>&bull; {{ rand(5, 15) }} phút đọc</span>
                            </div>
                        </a>
                    </article>
                @endif
                
                <div class="bn-blog-list" style="display: flex; flex-direction: column; gap: 40px;">
                    @foreach($listPosts as $post)
                        @php
                            $trans = $post->languages->first()->pivot ?? null;
                            $catName = $post->post_catalogues->first()?->languages->first()->pivot->name ?? 'Tin tức';
                            $url = route('router.index', ['canonical' => $trans->canonical ?? '']);
                        @endphp
                        <article class="bn-blog-item" style="border-bottom: 1px solid var(--bn-border); padding-bottom: 30px;">
                            <a href="{{ $url }}" style="text-decoration: none; color: inherit; display: block;">
                                <div class="bn-blog-meta" style="margin-bottom: 15px; display: flex; align-items: center; justify-content: space-between;">
                                    <span class="bn-pill-label" style="background: var(--bn-accent-light); padding: 4px 12px; font-size: 12px; margin: 0; border-radius: 999px; text-transform: none; color: var(--bn-text-main); font-weight: 600;">{{ $catName }}</span>
                                    <span style="font-size: 14px; opacity: 0.6;">{{ $post->created_at->format('d/m/Y') }}</span>
                                </div>
                                <h3 class="bn-blog-title" style="font-size: 1.35rem; line-height: 1.3; margin-bottom: 12px; transition: color 0.3s;">{{ $trans->name ?? '' }}</h3>
                                <div class="bn-blog-author" style="font-size: 13px; opacity: 0.7;">
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
