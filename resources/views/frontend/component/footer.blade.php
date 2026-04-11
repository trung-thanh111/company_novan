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
                    {!! $menu['main-menu'] !!}
                </ul>
            </div>
            
            <div>
                <h3 class="bn-footer__title">Mạng xã hội</h3>
                <ul class="bn-footer__links">
                    <li><a href="{{ $system['social_twitter'] ?? '#' }}">Twitter/X</a></li>
                    <li><a href="{{ $system['social_instagram'] ?? '#' }}">Instagram</a></li>
                    <li><a href="{{ $system['social_facebook'] ?? '#' }}">Facebook</a></li>
                    <li><a href="{{ $system['social_pinterest'] ?? '#' }}">Pinterest</a></li>
                    <li><a href="{{ $system['social_linkedin'] ?? '#' }}">LinkedIn</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="bn-footer__title">Hỗ trợ</h3>
                <ul class="bn-footer__links">
                    <li><a href="/lien-he.html">Liên hệ</a></li>
                    <li><a href="#">Câu hỏi thường gặp</a></li>
                    <li><a href="#">Trung tâm trợ giúp</a></li>
                </ul>
            </div>
        </div>
        
        <div class="bn-footer-bottom">
            <div>&copy; {{ date('Y') }} {{ $system['homepage_brand'] ?? 'Bricknet' }}. Bản quyền đã được bảo hộ</div>
            <div><a href="#">Chính sách bảo mật</a> &amp; <a href="#">Điều khoản sử dụng</a></div>
        </div>
    </div>
</footer>
