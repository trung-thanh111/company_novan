@include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['index']['title']])
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $config['seo']['index']['table'] }} </h5>
                    @include('backend.dashboard.component.toolbox', ['model' => 'FaqCatalogue'])
                </div>
                <div class="ibox-content">
                    @include('backend.faq.catalogue.component.filter')
                    @include('backend.faq.catalogue.component.table')
                </div>
            </div>
        </div>
    </div>
</div>
