@php
    $modelName = $model->languages->first()->pivot->name;
@endphp
<div class="page-breadcrumb background">      
    <div class="uk-container uk-container-center">
        <ul class="uk-list uk-clearfix uk-flex uk-flex-middle">
            <li>
                <a href="/">{{ __('frontend.home') }}</a>
            </li>
            <li>
                <span class="slash">/</span>
            </li>
            <li>
                <span>{{ $modelName }}</span>
            </li>
        </ul>
    </div>
</div>