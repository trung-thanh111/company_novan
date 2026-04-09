@include('backend.dashboard.component.breadcrumb', ['title' => $config['title']])
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@php
    $url = ($config['method'] == 'create') ? route('project.catalogue.store') : route('project.catalogue.update', $projectCatalogue->id);
@endphp
<form action="{{ $url }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Thông tin chung</h5>
                    </div>
                    <div class="ibox-content">
                        @include('backend.dashboard.component.content', ['model' => ($projectCatalogue) ?? null])
                    </div>
                </div>
                @include('backend.dashboard.component.seo', ['model' => ($projectCatalogue) ?? null])
            </div>
            <div class="col-lg-3">
                @include('backend.project.catalogue.component.aside')
            </div>
        </div>
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">{{ __('messages.save') }}</button>
        </div>
    </div>
</form>
