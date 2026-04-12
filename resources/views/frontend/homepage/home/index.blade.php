@extends('frontend.homepage.layout')

@section('content')
    <main class="bn-page">
        @include('frontend.homepage.bricknet.components.hero')
        @include('frontend.homepage.bricknet.components.partner')
        @include('frontend.homepage.bricknet.components.about')
        @include('frontend.homepage.bricknet.components.services')
        @include('frontend.homepage.bricknet.components.features')
        @include('frontend.homepage.bricknet.components.projects')
        @include('frontend.homepage.bricknet.components.process')
        @include('frontend.homepage.bricknet.components.testimonials')
        @include('frontend.homepage.bricknet.components.pricing')
        @include('frontend.homepage.bricknet.components.blog')
        @include('frontend.component.cta')
    </main>
@endsection
