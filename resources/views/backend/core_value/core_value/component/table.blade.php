<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th style="width: 50px;">
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th class="text-center" style="width: 100px;">Icon / Ảnh</th>
        <th>Tiêu đề</th>
        @include('backend.dashboard.component.languageTh')
        <th class="text-center" style="width:80px;">Vị trí</th>
        <th class="text-center" style="width:100px;">Tình trạng</th>
        <th class="text-center" style="width:100px;">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($records) && is_object($records))
            @foreach($records as $coreValue)
            <tr >
                <td>
                    <input type="checkbox" value="{{ $coreValue->id }}" class="input-checkbox checkBoxItem">
                </td>
                <td class="text-center">
                    <span class="image img-cover"><img src="{{ $coreValue->image }}" alt=""></span>
                </td>
                <td>
                    <div class="info-item name">{{ $coreValue->languages->first()->pivot->name ?? 'N/A' }}</div>
                </td>
                @include('backend.dashboard.component.languageTd', ['model' => $coreValue, 'modeling' => 'CoreValue'])
                <td>
                    <input type="text" name="order" value="{{ $coreValue->order }}" class="form-control sort-order text-right" data-id="{{ $coreValue->id }}" data-model="{{ $config['model'] }}">
                </td>
                <td class="text-center js-switch-{{ $coreValue->id }}"> 
                    <input type="checkbox" value="{{ $coreValue->publish }}" class="js-switch status " data-field="publish" data-model="{{ $config['model'] }}" {{ ($coreValue->publish == 2) ? 'checked' : '' }} data-modelId="{{ $coreValue->id }}" />
                </td>
                <td class="text-center"> 
                    <a href="{{ route('core_value.edit', $coreValue->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('core_value.delete', $coreValue->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{  $records->links('pagination::bootstrap-4') }}
