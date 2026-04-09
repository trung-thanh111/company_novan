{{-- Desktop Header - Transparent on hero, white on scroll --}}
<header class="linden-header uk-visible-large @yield('header-class')"
    data-uk-sticky="{top:-100, animation: 'uk-animation-slide-top'}">
    <div class="uk-container uk-container-center">
        <div class="uk-grid uk-grid-collapse uk-flex uk-flex-middle">
            <div class="uk-width-large-1-10">
                <div class="logo">
                    <a href="/" title="logo">
                        <img src="{{ $system['homepage_logo'] ?? asset('frontend/resources/img/homely/logo.webp') }}"
                            alt="logo">
                    </a>
                </div>
            </div>
            <div class="uk-width-large-4-5">
                <nav class="linden-nav">
                    <ul class="uk-navbar-nav uk-flex uk-flex-center">
                        {!! $menu['main-menu'] ?? '' !!}
                    </ul>
                </nav>
            </div>
            <div class="uk-width-large-1-10 uk-text-right">
                <a href="/lien-he.html" class="ln-header-cta">
                    Liên Hệ
                </a>
            </div>
        </div>

    </div>
</header>

{{-- Mobile Header --}}
<header class="linden-mobile-header uk-hidden-large">
    <div class="uk-container uk-container-center">
        <div class="mobile-header-inner">
            <div class="mobile-header-left"></div>
            <div class="logo mobile-header-center">
                <a href="/" title="Logo">
                    <img src="{{ $system['homepage_logo'] ?? asset('frontend/resources/img/homely/logo.webp') }}"
                        alt="Logo" />
                </a>
            </div>
            <div class="mobile-header-right">
                <a class="moblie-menu-btn" href="#offcanvas" data-uk-offcanvas="{target:'#offcanvas'}">
                    <i class="fa fa-bars" style="font-size: 24px; color: var(--ln-dark);"></i>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Menu Offcanvas -->
<div id="offcanvas" class="uk-offcanvas">
    <div class="uk-offcanvas-bar uk-offcanvas-bar-flip mobile-menu-offcanvas">
        <button class="uk-offcanvas-close mobile-menu-close" type="button">
            <i class="fa fa-times"></i>
        </button>
        <div style="padding: 20px 0 30px; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <a href="/" title="Logo">
                <img src="{{ $system['homepage_logo'] ?? asset('frontend/resources/img/homely/logo.webp') }}"
                    alt="Logo" style="max-height: 28px; filter: brightness(0) invert(1);" />
            </a>
        </div>
        <nav style="margin-top: 20px;">
            <ul class="uk-nav uk-nav-offcanvas mobile-menu-list">
                {!! $menu['main-menu'] ?? '' !!}
            </ul>
        </nav>
        <div style="padding: 30px 0 20px;">
            <a href="/lien-he.html" class="ln-btn" style="width: 100%; text-align: center; justify-content: center;">
                Liên Hệ Ngay
            </a>
        </div>
    </div>
</div>
