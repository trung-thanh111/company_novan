
@include('backend.dashboard.component.breadcrumb', ['title' => 'Quản lý nhóm dịch vụ'])
<div class="row mt20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Danh sách nhóm dịch vụ </h5>
                @include('backend.dashboard.component.toolbox', ['model' => 'ServiceCatalogue'])
            </div>
            <div class="ibox-content">
                @include('backend.company.catalogue.component.filter')
                @include('backend.company.catalogue.component.table')
            </div>
        </div>
    </div>
</div>
