@include('backend.dashboard.component.breadcrumb', ['title' => ($config['method'] == 'create') ? 'Thêm mới nhóm dịch vụ' : 'Cập nhật nhóm dịch vụ'])
@include('backend.dashboard.component.formError')
@php
    $url = ($config['method'] == 'create') ? route('service.catalogue.store') : route('service.catalogue.update', $serviceCatalogue->id);
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
                        @include('backend.dashboard.component.content', ['model' => ($serviceCatalogue) ?? null])
                    </div>
                </div>
               @include('backend.dashboard.component.album', ['model' => ($serviceCatalogue) ?? null])
               @include('backend.dashboard.component.seo', ['model' => ($serviceCatalogue) ?? null])
            </div>
            <div class="col-lg-3">
                @include('backend.company.catalogue.component.aside')
            </div>
        </div>
        <div class="text-right mb15 fixed-bottom">
            <button class="btn btn-primary" type="submit" name="send" value="send_and_stay">Lưu lại</button>
            <button class="btn btn-success" type="submit" name="send" value="send_and_exit">Đóng</button>
        </div>
    </div>
</form>
