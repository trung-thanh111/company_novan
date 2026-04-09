@include('backend.dashboard.component.breadcrumb', ['title' => $config['title']])
<div class="row mt20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{ $config['title'] }} </h5>
                @include('backend.dashboard.component.toolbox', ['model' => 'Project'])
            </div>
            <div class="ibox-content">
                @include('backend.project.project.component.filter')
                @include('backend.project.project.component.table')
            </div>
        </div>
    </div>
</div>
