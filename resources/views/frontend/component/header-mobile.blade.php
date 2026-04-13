@php
    $mobileMenu = $menu['mobile'] ?? $menu['main-menu_array'] ?? [];
@endphp

<style>
    /* Ẩn phần header mobile mặc định vì đã dùng header chính trên mobile */
    .mobile-header {
        display: none !important;
    }

    /* Style cho Offcanvas Sidebar */
    #mobileCanvas .uk-offcanvas-bar {
        background: #0f172a !important; /* Màu nền tối sang trọng */
        width: 320px;
        padding: 30px 24px;
        box-shadow: 10px 0 30px rgba(0,0,0,0.5);
    }

    #mobileCanvas .uk-offcanvas-bar::after {
        display: none;
    }

    .bn-mobile-nav {
        margin-top: 20px;
    }

    .bn-mobile-nav .l1 {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .bn-mobile-nav .l1 > li {
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .bn-mobile-nav .l1 > li > a {
        display: block;
        padding: 15px 0;
        color: #f8fafc;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .bn-mobile-nav .l1 > li > a:hover {
        color: var(--bn-accent, #e65c00);
        padding-left: 10px;
    }

    .bn-mobile-nav .uk-parent > a {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .bn-mobile-nav .uk-nav-sub {
        background: rgba(255, 255, 255, 0.02);
        margin: 0 -24px;
        padding: 10px 24px 15px 44px;
    }

    .bn-mobile-nav .uk-nav-sub li a {
        color: #94a3b8;
        font-size: 14px;
        padding: 8px 0;
        display: block;
        transition: color 0.3s ease;
    }

    .bn-mobile-nav .uk-nav-sub li a:hover {
        color: #fff;
    }

    .bn-sidebar-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 40px;
    }

    .bn-sidebar-logo img {
        height: 32px;
        width: auto;
    }

    .bn-sidebar-close {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        color: #fff;
        cursor: pointer;
    }
</style>

<div id="mobileCanvas" class="uk-offcanvas offcanvas">
    <div class="uk-offcanvas-bar">
        <div class="bn-sidebar-header">
            <a href="/" class="bn-sidebar-logo">
                <img src="{{ $system['homepage_logo'] ?? asset('frontend/resources/images/logo.png') }}" alt="Logo">
            </a>
            <div class="bn-sidebar-close uk-offcanvas-close">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </div>
        </div>

        <nav class="bn-mobile-nav">
            @if (isset($mobileMenu) && count($mobileMenu))
                <ul class="l1 uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav>
                    @foreach ($mobileMenu as $key => $val)
                        @php
                            $item = $val['item'] ?? null;
                            if (!$item) continue;
                            
                            $lang = $item->languages->first() ?? null;
                            if (!$lang) continue;

                            $name = $lang->pivot->name;
                            $canonical = write_url($lang->pivot->canonical, true, true);
                            $hasChildren = isset($val['children']) && count($val['children']);
                        @endphp
                        <li class="l1 {{ $hasChildren ? 'uk-parent' : '' }}">
                            <a href="{{ $hasChildren ? '#' : $canonical }}" title="{{ $name }}" class="l1">
                                {{ $name }}
                                @if($hasChildren)
                                    <span class="uk-icon-chevron-down" style="font-size: 10px; opacity: 0.5;"></span>
                                @endif
                            </a>
                            @if ($hasChildren)
                                <ul class="uk-nav-sub">
                                    @foreach ($val['children'] as $keyItem => $valItem)
                                        @php
                                            $item2 = $valItem['item'] ?? null;
                                            if (!$item2) continue;

                                            $lang2 = $item2->languages->first() ?? null;
                                            if (!$lang2) continue;

                                            $name_2 = $lang2->pivot->name;
                                            $canonical_2 = write_url($lang2->pivot->canonical, true, true);
                                        @endphp
                                        <li>
                                            <a href="{{ $canonical_2 }}" title="{{ $name_2 }}">{{ $name_2 }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </nav>

        <div style="margin-top: 50px;">
            <a href="{{ write_url('lien-he') }}" class="bn-btn bn-btn--shiny" style="width: 100%; text-align: center; display: block; padding: 14px; background: var(--bn-accent, #e65c00); color: #fff; border-radius: 8px; font-weight: 600;">{{ $system['home_header_btn'] ?? 'Đặt lịch tư vấn' }}</a>
        </div>
    </div>
</div>
