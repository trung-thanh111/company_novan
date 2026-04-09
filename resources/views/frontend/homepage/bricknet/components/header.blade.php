<header class="bn-header">
    <style>
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
            background: rgba(30, 40, 55, 0.98);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 14px;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.35);
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
        }

        .bn-header .bn-nav-pill .dropdown-menu a:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        /* Open submenu via click toggle */
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

            .bn-header .bn-nav-pill>ul {
                flex-wrap: wrap;
            }

            .bn-header .bn-nav-pill .dropdown-menu {
                position: static;
                display: block;
                min-width: 0;
                margin-top: 8px;
                padding: 8px 0 0;
                border: 0;
                background: transparent;
                box-shadow: none;
            }

            .bn-header .bn-nav-pill .dropdown-menu a {
                padding: 8px 0 8px 14px;
                white-space: normal;
            }
        }
    </style>
    <div class="bn-container">
        <div class="bn-header__inner">
            <a href="/" class="bn-header__logo">
                <img src="{{ $system['homepage_logo'] ?? asset('frontend/resources/images/logo.png') }}" alt="{{ $system['homepage_brand'] ?? 'Bricknet' }}">
            </a>

            <nav class="bn-nav-pill">
                @if(isset($menu['main-menu']))
                <ul class="bn-nav-pill__menu">
                    {!! $menu['main-menu'] !!}
                </ul>
                @else
                <ul>
                    <li><a href="/" class="active">Trang chủ</a></li>
                    <li><a href="/gioi-thieu.html">Giới thiệu</a></li>
                    <li><a href="/du-an.html">Dự án</a></li>
                    <li><a href="/lien-he.html">Liên hệ</a></li>
                </ul>
                @endif
            </nav>

            <a href="/lien-he.html" class="bn-btn bn-btn--shiny-outline">{{ $system['home_header_btn'] ?? 'Đặt lịch tư vấn' }}</a>
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

            // Toggle on click for items that have dropdown
            nav.addEventListener('click', (e) => {
                const a = e.target?.closest?.('a');
                if (!a) return;

                const li = a.closest('li');
                if (!li) return;

                const dropdown = li.querySelector(':scope > .dropdown-menu');
                if (!dropdown) return; // normal link

                // click toggles dropdown (avoid navigating away)
                e.preventDefault();
                e.stopPropagation();

                const willOpen = !li.classList.contains('is-open');
                closeAll(li);
                li.classList.toggle('is-open', willOpen);
            });

            // Close behavior: add a short delay so user can move into dropdown
            const closeTimers = new WeakMap();
            const scheduleClose = (li, delayMs = 220) => {
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

                // leaving the whole li schedules close; entering cancels it
                li.addEventListener('mouseleave', () => scheduleClose(li));
                li.addEventListener('mouseenter', () => cancelClose(li));

                // also keep it open while interacting inside dropdown
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
        })();
    </script>
</header>
