<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th style="width:50px;">
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th>Tiêu đề dịch vụ</th>
        <th class="text-right" style="width:120px;">Giá</th>
        @include('backend.dashboard.component.languageTh')
        <th style="width:80px;" class="text-center">Số thứ tự</th>
        <th class="text-center" style="width:100px;">Trạng thái</th>
        <th class="text-center" style="width:100px;">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($services) && is_object($services))
            @foreach($services as $service)
            <tr id="{{ $service->id }}">
                <td>
                    <input type="checkbox" value="{{ $service->id }}" class="input-checkbox checkBoxItem">
                </td>
                <td>
                    <div class="uk-flex uk-flex-middle">
                        <div class="image mr5">
                            <div class="img-cover image-post"><img src="{{ thumb(image($service->image), 80, 50) }}" alt=""></div>
                        </div>
                        <div class="main-info">
                            <div class="name"><span class="maintitle">{{ $service->name }} ({{ $service->viewed ?? 0 }})</span></div>
                            <div class="catalogue">
                                <span class="text-danger">Nhóm: </span>
                                @foreach($service->service_catalogues as $val)
                                @foreach($val->service_catalogue_language as $cat)
                                <a href="{{ route('service.index', ['service_catalogue_id' => $val->id]) }}" title="">{{ $cat->name }}</a>
                                @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </td>
                <td class="text-right">
                    {{ !empty($service->price) ? number_format($service->price, 0, ',', '.') : '0' }}đ
                </td>
                @include('backend.dashboard.component.languageTd', ['model' => $service, 'modeling' => 'Service'])
                <td>
                    <input type="text" name="order" value="{{ $service->order }}" class="form-control sort-order text-right" data-id="{{ $service->id }}" data-model="{{ $config['model'] }}">
                </td>
                <td class="text-center js-switch-{{ $service->id }}"> 
                    <input type="checkbox" value="{{ $service->publish }}" class="js-switch status " data-field="publish" data-model="{{ $config['model'] }}" {{ ($service->publish == 2) ? 'checked' : '' }} data-modelId="{{ $service->id }}" />
                </td>
                <td class="text-center"> 
                    <a href="{{ route('service.edit', $service->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('service.delete', $service->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{  $services->links('pagination::bootstrap-4') }}
