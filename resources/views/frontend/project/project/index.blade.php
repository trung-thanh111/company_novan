@extends('frontend.homepage.layout')
@section('header-class', 'bn-header--white')

@push('styles')
    <style>
        :root {
            --bn-primary: #0f172a;
            --bn-accent: #e65c00;
            --bn-slate-50: #f8fafc;
            --bn-slate-400: #94a3b8;
            --bn-slate-600: #475569;
            --bn-slate-900: #0f172a;
        }

        /* ── Project Header ── */
        .bn-project-header {
            padding: 120px 0 40px;
            background: #fff;
        }
        
        /* ── Breadcrumb Custom ── */
        .bn-project-detail .page-breadcrumb {
            width: 100%;
            background: #fff !important;
            padding: 10px 24px !important;
            border-radius: 5px !important;
            box-shadow: 0 5px 10px rgba(0,0,0,0.06) !important;
            margin-bottom: 20px !important;
            border: 1px solid rgba(0,0,0,0.03) !important;
            display: inline-block !important;
        }
        .bn-project-detail .page-breadcrumb .uk-container {
            padding: 0 !important;
        }
        .bn-project-header__top {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 40px;
        }
        .bn-project-header__title {
            font-size: 40px;
            font-weight: 700;
            color: var(--bn-slate-900);
            margin: 0;
            line-height: 1.1;
            letter-spacing: -0.02em;
        }
        .bn-project-header__desc {
            max-width: 400px;
            color: var(--bn-slate-600);
            font-size: 16px;
            line-height: 1.6;
        }
        .bn-project-feature__img {
            width: 100%;
            height: auto;
            border-radius: 4px; /* Minimal radius for premium look */
            object-fit: cover;
            aspect-ratio: 21 / 9;
        }

        /* ── Meta Info ── */
        .bn-project-meta {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            padding: 30px 0;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 30px;
        }
        .bn-project-meta__item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .bn-project-meta__label {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--bn-slate-900);
            font-weight: 700;
        }
        .bn-project-meta__value {
            font-size: 15px;
            color: var(--bn-slate-600);
        }

        /* ── About & Value Section ── */
        .bn-project-details {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 80px;
            margin-bottom: 80px;
        }
        .bn-project-details__value-box {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .bn-project-details__value-label {
            font-size: 14px;
            font-weight: 700;
            color: var(--bn-slate-900);
        }
        .bn-project-details__value-amount {
            font-size: 36px;
            font-weight: 700;
            color: var(--bn-accent);
        }
        .bn-project-details__content {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }
        .bn-project-details__title {
            font-size: 28px;
            font-weight: 700;
            color: var(--bn-slate-900);
            margin-bottom: 15px;
        }
        .bn-project-details__text {
            font-size: 16px;
            color: var(--bn-slate-600);
            line-height: 1.8;
        }

        /* ── Gallery ── */
        .bn-project-gallery {
            margin-bottom: 80px;
        }
        .bn-project-gallery__main {
            width: 100%;
            height: auto;
            margin-bottom: 80px;
            border-radius: 4px;
        }
        .bn-project-process__title {
            font-size: 28px;
            font-weight: 700;
            color: var(--bn-slate-900);
            margin-bottom: 30px;
        }
        .bn-project-process__list {
            list-style: none;
            padding: 0;
            margin: 0 0 40px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }
        .bn-project-process__item {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }
        .bn-project-process__bullet {
            width: 8px;
            height: 8px;
            background: var(--bn-accent);
            border-radius: 50%;
            margin-top: 8px;
            flex-shrink: 0;
        }
        .bn-project-process__item-content {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .bn-project-process__item-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--bn-slate-900);
        }
        .bn-project-process__item-desc {
            font-size: 15px;
            color: var(--bn-slate-600);
            line-height: 1.6;
        }

        /* ── Completed Highlights Grid ── */
        .bn-project-highlights {
            margin-bottom: 80px;
        }
        .bn-project-highlights__title {
            font-size: 28px;
            font-weight: 700;
            color: var(--bn-slate-900);
            margin-bottom: 15px;
        }
        .bn-project-highlights__desc {
            font-size: 15px;
            color: var(--bn-slate-500);
            margin-bottom: 40px;
        }
        .bn-project-highlights__grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto auto;
            gap: 20px;
        }
        .bn-project-highlights__img {
            width: 100%;
            height: auto;
            object-fit: cover;
            aspect-ratio: 4 / 3;
            border-radius: 4px;
        }

        /* ── Testimonial ── */
        .bn-project-testimonial {
            background: #fff5f0;
            padding: 40px 60px;
            margin-bottom: 80px;
            border-radius: 4px;
        }
        .bn-project-testimonial__content {
            font-size: 20px;
            font-style: italic;
            color: var(--bn-slate-900);
            line-height: 1.8;
            margin-bottom: 30px;
            position: relative;
        }
        .bn-project-testimonial__author {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .bn-project-testimonial__name {
            font-size: 18px;
            font-weight: 700;
            color: var(--bn-slate-900);
        }
        .bn-project-testimonial__pos {
            font-size: 14px;
            color: var(--bn-slate-600);
        }

        /* ── Related Projects ── */
        .bn-project-related {
            padding: 100px 0;
            background: #fff;
        }
        .bn-project-related__title {
            font-size: 32px;
            font-weight: 700;
            color: var(--bn-slate-900);
            text-align: center;
            margin-bottom: 60px;
        }
        .bn-project-related__grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }
        .bn-related-card {
            display: flex;
            flex-direction: column;
            gap: 20px;
            text-decoration: none;
        }
        .bn-related-card__img-wrapper {
            position: relative;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            border-radius: 4px;
        }
        .bn-related-card__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .bn-related-card:hover .bn-related-card__img {
            transform: scale(1.05);
        }
        .bn-related-card__title {
            font-size: 20px;
            font-weight: 700;
            color: var(--bn-slate-900);
            margin: 0;
        }
        .bn-related-card__meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #f1f5f9;
            padding-top: 15px;
        }
        .bn-related-card__cat {
            font-size: 13px;
            color: var(--bn-slate-600);
        }
        .bn-related-card__link {
            font-size: 13px;
            font-weight: 700;
            color: var(--bn-accent);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* ── Responsive ── */
        @media (max-width: 991px) {
            .bn-project-header__top {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            .bn-project-meta {
                grid-template-columns: repeat(2, 1fr);
            }
            .bn-project-details {
                grid-template-columns: 1fr;
                gap: 50px;
            }
            .bn-project-related__grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <article class="bn-project-detail">
        {{-- Section 1: Header --}}
        <div class="bn-project-header">
            <div class="bn-container">
                @include('frontend.component.breadcrumb', ['breadcrumb' => $breadcrumb, 'model' => $project])
                <div class="bn-project-header__top">
                    <h1 class="bn-project-header__title">{{ $project->name }}</h1>
                    <div class="bn-project-header__desc">
                        {{ $project->description }}
                    </div>
                </div>
                
                {{-- Feature Image --}}
                <div class="bn-project-feature">
                    <img src="{{ $project->image }}" alt="{{ $project->name }}" class="bn-project-feature__img">
                </div>

                {{-- Meta Info --}}
                <div class="bn-project-meta">
                    <div class="bn-project-meta__item">
                        <span class="bn-project-meta__label">DỊCH VỤ</span>
                        <a href="{{ write_url($projectCatalogueCanonical) }}" class="bn-project-meta__value" style="text-decoration: none; color: inherit;">{{ $projectCatalogue->name }}</a>
                    </div>
                    <div class="bn-project-meta__item">
                        <span class="bn-project-meta__label">THỜI GIAN</span>
                        <span class="bn-project-meta__value">{{ $project->start_date ? date('d/m/Y', strtotime($project->start_date)) : 'N/A' }}</span>
                    </div>
                    <div class="bn-project-meta__item">
                        <span class="bn-project-meta__label">ĐỊA ĐIỂM</span>
                        <span class="bn-project-meta__value">{{ $project->location ?? 'N/A' }}</span>
                    </div>
                    <div class="bn-project-meta__item">
                        <span class="bn-project-meta__label">KHÁCH HÀNG</span>
                        <span class="bn-project-meta__value">{{ $project->customer ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 2: Details --}}
        <div class="bn-project-body">
            <div class="bn-container">
                <div class="bn-project-details">
                    <div class="bn-project-details__value-box">
                        <span class="bn-project-details__value-label">GIÁ TRỊ DỰ ÁN</span>
                        <div class="bn-project-details__value-amount">{{ number_format($project->value) }} VNĐ</div>
                    </div>
                    <div class="bn-project-details__content">
                        <div class="bn-project-details__about">
                            <h2 class="bn-project-details__title">Về dự án</h2>
                            <div class="bn-project-details__text">
                                {!! $project->content !!}
                            </div>
                        </div>

                        {{-- Gallery Main (Secondary Image) --}}
                        <div class="bn-project-gallery">
                            @php
                                $album = json_decode($project->album);
                            @endphp
                            @if(!empty($album) && isset($album[0]))
                                <img src="{{ $album[0] }}" alt="Gallery image" class="bn-project-gallery__main">
                            @endif
                        </div>

                        {{-- Work Process --}}
                        <div class="bn-project-process">
                            <h2 class="bn-project-process__title">Quy trình triển khai</h2>
                            <ul class="bn-project-process__list">
                                @foreach($mockData['work_process'] as $step)
                                    <li class="bn-project-process__item">
                                        <span class="bn-project-process__bullet"></span>
                                        <div class="bn-project-process__item-content">
                                            <span class="bn-project-process__item-title">{{ $step['title'] }}</span>
                                            <span class="bn-project-process__item-desc">{{ $step['desc'] }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- <div class="bn-project-testimonial">
                            <div class="bn-project-testimonial__content">
                                "{{ $mockData['testimonial']['content'] }}"
                            </div>
                            <div class="bn-project-testimonial__author">
                                <span class="bn-project-testimonial__name">{{ $mockData['testimonial']['author'] }}</span>
                                <span class="bn-project-testimonial__pos">{{ $mockData['testimonial']['position'] }}</span>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        @if($relatedProjects->isNotEmpty())
        <div class="bn-project-related">
            <div class="bn-container">
                <h2 class="bn-project-related__title">Dự án liên quan</h2>
                <div class="bn-project-related__grid">
                    @foreach($relatedProjects as $rel)
                        @php
                            $relCanonical = $rel->languages->first()->pivot->canonical ?? '#';
                        @endphp
                        <a href="{{ write_url($relCanonical) }}" class="bn-related-card">
                            <div class="bn-related-card__img-wrapper">
                                <img src="{{ $rel->image }}" alt="{{ $rel->name }}" class="bn-related-card__img">
                            </div>
                            <h3 class="bn-related-card__title">{{ $rel->name }}</h3>
                            <div class="bn-related-card__meta">
                                <span class="bn-related-card__cat">{{ $rel->project_catalogue->languages->first()->pivot->name ?? 'Dự án' }}</span>
                                <span class="bn-related-card__link">
                                    Chi tiết
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        @include('frontend.component.cta', ['album' => $album])
    </article>
@endsection
