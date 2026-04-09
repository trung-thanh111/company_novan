@php
    $currentLocale = app()->getLocale();
    $itemLanguage = ($menuBread->languages->isNotEmpty()) 
        ? ($menuBread->languages->first(fn($lang) => $lang->canonical == $currentLocale) ?: $menuBread->languages->first())
        : null;
    $menuName = ($itemLanguage && $itemLanguage->pivot) ? $itemLanguage->pivot->name : 'N/A';
@endphp
@include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['create']['children'] . ' ' . $menuName])
@include('backend.dashboard.component.formError')
@php
    $url = ($config['method'] == 'create') ? route('menu.store') : ( ($config['method'] == 'children') ? route('menu.save.children', [$menuBread->id]) : route('menu.update', $menu->id) );
@endphp
<form action="{{ $url }}" method="post" class="box menuContainer">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        @include('backend.menu.menu.component.list')
       
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>

@include('backend.menu.menu.component.popup')
