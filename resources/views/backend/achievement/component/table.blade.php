<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th style="width:50px;">
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th class="text-center" style="width: 100px;">Ảnh</th>
        <th>Tên thành tựu</th>
        <th class="text-center" style="width: 100px;">Sắp xếp</th>
        <th class="text-center" style="width: 100px;">Tình trạng</th>
        <th class="text-center" style="width: 100px;">Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($records) && is_object($records))
        @foreach($records as $record)
        <tr >
            <td>
                <input type="checkbox" value="{{ $record->id }}" class="input-checkbox checkBoxItem">
            </td>
            <td>
                <span class="image img-cover"><img src="{{ $record->image }}" alt=""></span>
            </td>
            <td>
                <div class="info-item">
                    <div class="name">
                        {{ $record->name }}
                    </div>
                </div>
            </td>
            <td>
                <input type="text" name="order" value="{{ $record->order }}" class="form-control sort-order text-right" data-id="{{ $record->id }}" data-model="{{ $config['model'] }}">
            </td>
            <td class="text-center js-switch-{{ $record->id }}">
                <input type="checkbox" value="{{ $record->publish }}" class="js-switch status " data-field="publish" data-model="{{ $config['model'] }}" data-value="{{ $record->publish }}" data-id="{{ $record->id }}" {{ ($record->publish == 2) ? 'checked' : '' }}>
            </td>
            <td class="text-center"> 
                <a href="{{ route('achievement.edit', $record->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="{{ route('achievement.delete', $record->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    @endif
    </tbody>
</table>
{{  $records->links('pagination::bootstrap-4') }}
