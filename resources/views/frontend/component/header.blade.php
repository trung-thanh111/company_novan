<header class="bn-header @yield('header-class')">
    <style>
        .bn-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: transparent;
            padding: 24px 0;
        }

        .bn-header .bn-nav-pill li > a {
            color: #ffffff !important;
        }

        .bn-header--sticky {
            background: #0f172a !important;
            opacity: 0.98 !important;
            backdrop-filter: blur(16px);
            box-shadow: var(--bn-shadow-md);
            padding: 16px 0;
        }

        /* Dropdown fix for radius */
        .bn-header .bn-nav-pill .dropdown-menu {
            border-radius: var(--bn-radius-md);
            box-shadow: var(--bn-shadow-md);
        }

        /* ── Blog Components ── */
        .bn-blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
        }
        @media (max-width: 768px) {
            .bn-blog-grid {
                grid-template-columns: 1fr;
            }
        }

        .bn-blog-card {
            background: #fff;
            border-radius: var(--bn-radius-md);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            height: 100%;
            border: 1px solid rgba(15, 23, 42, 0.05);
            box-shadow: var(--bn-shadow-sm);
        }
        .bn-blog-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.12);
            border-color: rgba(15, 23, 42, 0.1);
        }
        .bn-blog-card__image-link {
            display: block;
            aspect-ratio: 16/10;
            overflow: hidden;
            position: relative;
        }
        .bn-blog-card__image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .bn-blog-card:hover .bn-blog-card__image {
            transform: scale(1.08);
        }
        .bn-blog-card__content {
            padding: 24px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .bn-blog-card__meta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .bn-blog-card__date { color: #94a3b8; }
        .bn-blog-card__category { color: var(--bn-accent, #e65c00); }
        .bn-blog-card__title {
            font-size: 20px;
            font-weight: 700;
            line-height: 1.4;
            color: #1e293b;
            margin-bottom: 16px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: color 0.3s ease;
        }
        .bn-blog-card:hover .bn-blog-card__title {
            color: var(--bn-accent, #e65c00);
        }
        .bn-blog-card__excerpt {
            color: #64748b;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 24px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .bn-blog-card__footer {
            margin-top: auto;
            display: flex;
            align-items: center;
            color: #0f172a;
            font-weight: 600;
            font-size: 14px;
            gap: 8px;
        }
        .bn-blog-card__footer i {
            font-size: 12px;
            transition: transform 0.3s ease;
        }
        .bn-blog-card:hover .bn-blog-card__footer i {
            transform: translateX(4px);
        }

        /* ── Typography for Post Content ── */
        .bn-typography {
            max-width: 100%;
            margin: 0 auto;
            color: #334155;
            font-size: 18px;
            line-height: 1.8;
        }
        .bn-typography h2, .bn-typography h3, .bn-typography h4 {
            color: #0f172a;
            margin: 48px 0 24px;
            font-weight: 700;
            line-height: 1.25;
        }
        .bn-typography h2 { font-size: 32px; }
        .bn-typography h3 { font-size: 26px; }
        .bn-typography p { margin-bottom: 24px; }
        .bn-typography img {
            border-radius: var(--bn-radius-md);
            margin: 40px 0;
            width: 100%;
            height: auto;
        }
        .bn-typography blockquote {
            border-left: 4px solid var(--bn-accent, #e65c00);
            padding: 16px 32px;
            background: #f8fafc;
            border-radius: 0 var(--bn-radius-md) var(--bn-radius-md) 0;
            font-style: italic;
            margin: 40px 0;
        }

        .bn-header--sticky .bn-nav-pill li > a,
        .bn-header--sticky .bn-btn--shiny-outline {
            color: #ffffff !important;
        }

        .bn-header .bn-nav-pill ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .bn-header .bn-nav-pill>ul {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .bn-header .bn-nav-pill>ul>li {
            position: relative;
        }

        .bn-header .bn-nav-pill .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 220px;
            margin-top: 10px;
            padding: 10px 8px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: var(--bn-radius-md);
            box-shadow: var(--bn-shadow-lg);
            z-index: 9999;
            max-height: min(60vh, 520px);
            overflow: auto;
            overscroll-behavior: contain;
            -webkit-overflow-scrolling: touch;
        }

        .bn-header .bn-nav-pill .dropdown-menu::before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: -12px;
            height: 12px;
        }

        .bn-header .bn-nav-pill .dropdown-menu ul {
            display: block !important;
        }

        .bn-header .bn-nav-pill .dropdown-menu li {
            display: block !important;
            width: 100%;
        }

        .bn-header .bn-nav-pill .dropdown-menu a {
            display: block;
            padding: 10px 12px;
            white-space: nowrap;
            border-radius: 10px;
            color: #1e293b !important;
            font-weight: 500;
        }

        .bn-header .bn-nav-pill .dropdown-menu a:hover {
            background: #f8fafc;
            color: var(--bn-accent) !important;
        }

        /* Open submenu via hover & class */
        .bn-header .bn-nav-pill li:hover > .dropdown-menu,
        .bn-header .bn-nav-pill li.is-open > .dropdown-menu {
            display: block;
        }

        .bn-header .bn-nav-pill li>a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .bn-header .bn-nav-pill li:has(> .dropdown-menu)>a::after {
            content: "▾";
            font-size: 12px;
            opacity: 0.9;
            transform: translateY(-1px);
        }

        @media (max-width: 991px) {
            .bn-header {
                padding: 16px 0;
            }
            .bn-header__inner {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .bn-header .bn-nav-pill,
            .bn-header .bn-btn--shiny-outline {
                display: none !important;
            }
            .bn-header__mobile-toggle {
                display: flex !important;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 8px;
                color: #fff;
                cursor: pointer;
                border: 1px solid rgba(255, 255, 255, 0.2);
                transition: all 0.3s ease;
            }
            .bn-header__mobile-toggle:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: scale(1.05);
            }
            .bn-header__logo img {
                height: 32px;
                width: auto;
            }
        }

        .bn-header__mobile-toggle {
            display: none;
        }
    </style>
    <div class="bn-container">
        <div class="bn-header__inner">
            <a href="/" class="bn-header__logo">
                <img src="{{ $system['homepage_logo'] ?? asset('frontend/resources/images/logo.png') }}" alt="{{ $system['homepage_brand'] ?? 'Bricknet' }}">
            </a>

            <div class="bn-header__mobile-toggle" data-uk-offcanvas="{target:'#mobileCanvas'}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </div>

            <nav class="bn-nav-pill">
                @if(isset($menu['main-menu']))
                <ul class="bn-nav-pill__menu">
                    {!! $menu['main-menu'] !!}
                </ul>
                @else
                <ul>
                    <li><a href="{{ write_url('') }}" class="active">Trang chủ</a></li>
                    <li><a href="{{ write_url('gioi-thieu') }}">Giới thiệu</a></li>
                    <li><a href="{{ write_url('du-an') }}">Dự án</a></li>
                    <li><a href="{{ write_url('lien-he') }}">Liên hệ</a></li>
                </ul>
                @endif
            </nav>

            <a href="{{ write_url('lien-he') }}" class="bn-btn bn-btn--shiny-outline">{{ $system['home_header_btn'] ?? 'Đặt lịch tư vấn' }}</a>
        </div>
    </div>

    <script>
        (() => {
            const header = document.querySelector('.bn-header');
            const nav = header?.querySelector('.bn-nav-pill');
            if (!nav) return;

            const closeAll = (exceptLi = null) => {
                nav.querySelectorAll('li.is-open').forEach((li) => {
                    if (exceptLi && li === exceptLi) return;
                    li.classList.remove('is-open');
                });
            };

            // Close behavior: use JS for specialized state management if needed.
            // We add a short delay so user can move into dropdown comfortably.
            const closeTimers = new WeakMap();
            const scheduleClose = (li, delayMs = 200) => {
                const existing = closeTimers.get(li);
                if (existing) window.clearTimeout(existing);
                closeTimers.set(li, window.setTimeout(() => li.classList.remove('is-open'), delayMs));
            };
            const cancelClose = (li) => {
                const existing = closeTimers.get(li);
                if (existing) window.clearTimeout(existing);
                closeTimers.delete(li);
            };

            nav.querySelectorAll('li').forEach((li) => {
                const dropdown = li.querySelector(':scope > .dropdown-menu');
                if (!dropdown) return;

                li.addEventListener('mouseenter', () => {
                    cancelClose(li);
                    li.classList.add('is-open');
                });
                li.addEventListener('mouseleave', () => scheduleClose(li));
                
                // Ensure dropdown itself keeps it open
                dropdown.addEventListener('mouseenter', () => cancelClose(li));
                dropdown.addEventListener('mouseleave', () => scheduleClose(li));
            });

            // Close when clicking outside
            document.addEventListener('click', (e) => {
                if (!nav.contains(e.target)) closeAll();
            });

            // Close on Esc
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeAll();
            });

            // Sticky Header Logic
            const headerEl = document.querySelector('.bn-header');
            const handleScroll = () => {
                if (window.scrollY > 50) {
                    headerEl.classList.add('bn-header--sticky');
                } else {
                    headerEl.classList.remove('bn-header--sticky');
                }
            };
            window.addEventListener('scroll', handleScroll, { passive: true });
            handleScroll();
        })();
    </script>
</header>

@include('frontend.component.header-mobile')
