<footer class="bn-footer">
    <div class="bn-container">
        <div class="bn-footer-grid">
            <div class="bn-footer__logo">
                <img src="{{ $system['homepage_logo'] ?? asset('frontend/resources/images/logo.png') }}" alt="{{ $system['homepage_brand'] ?? 'Bricknet' }}">
                <h3 class="bn-footer__title">Đăng ký nhận bản tin</h3>
                <p>Nhận thông tin cập nhật, bí quyết và tin tức ngành ngay trong hộp thư của bạn</p>
                <form action="#" class="bn-footer__form">
                    <input type="email" placeholder="Nhập địa chỉ email của bạn">
                    <button type="submit">Đăng ký</button>
                </form>
            </div>
            
            <div>
                <h3 class="bn-footer__title">Công ty</h3>
                <ul class="bn-footer__links">
                    @if(isset($menu['main-menu_array']))
                        @foreach($menu['main-menu_array'] as $val)
                            @php
                                $name = $val['item']->languages->first()->pivot->name;
                                $canonical = write_url($val['item']->languages->first()->pivot->canonical, true, true);
                            @endphp
                            <li><a href="{{ $canonical }}">{{ $name }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
            
            <div>
                <h3 class="bn-footer__title">Mạng xã hội</h3>
                <ul class="bn-footer__links">
                    @php
                        $socials = [
                            'social_twitter' => 'Twitter/X',
                            'social_instagram' => 'Instagram',
                            'social_facebook' => 'Facebook',
                            'social_pinterest' => 'Pinterest',
                            'social_linkedin' => 'LinkedIn',
                        ];
                    @endphp
                    @foreach($socials as $key => $label)
                        @if(!empty($system[$key]))
                            <li><a href="{{ $system[$key] }}" target="_blank">{{ $label }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            
            <div>
                <h3 class="bn-footer__title">Hỗ trợ</h3>
                <ul class="bn-footer__links">
                    @if(!empty($system['contact_hotline']))
                        <li><a href="tel:{{ $system['contact_hotline'] }}">{{ $system['contact_hotline'] }}</a></li>
                    @endif
                    @if(!empty($system['contact_address']))
                        <li><span style="color: rgba(255, 255, 255, 0.7); font-size: 14px; line-height: 1.6; display: block;">{{ $system['contact_address'] }}</span></li>
                    @endif
                    <li><a href="/lien-he.html">Gửi yêu cầu liên hệ</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
