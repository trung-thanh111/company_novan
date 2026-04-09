<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th style="width: 50px;">
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th class="text-center" style="width: 100px;">Ảnh</th>
        <th>Tiêu đề Quy trình</th>
        <th class="text-center" style="width: 100px;">Sắp xếp</th>
        <th class="text-center" style="width: 100px;">Trạng thái</th>
        <th class="text-center" style="width: 100px;">Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($records) && is_object($records))
        @foreach($records as $record)
            @php
                $name = $record->name ?? 'N/A';
            @endphp
            <tr >
                <td>
                    <input type="checkbox" value="{{ $record->id }}" class="input-checkbox checkBoxItem">
                </td>
                <td class="text-center">
                    <span class="image img-cover"><img src="{{ asset($record->image ?? 'backend/img/not-found.png') }}" alt=""></span>
                </td>
                <td>
                    {{ $name }}
                </td>
                <td class="text-center">
                    <input type="text" name="order" value="{{ $record->order }}" class="form-control sort-order text-right" data-id="{{ $record->id }}" data-model="WorkProcess">
                </td>
                <td class="text-center js-switch-{{ $record->id }}">
                    <input 
                        type="checkbox" 
                        value="{{ $record->publish }}" 
                        class="js-switch status" 
                        data-field="publish" 
                        data-model="WorkProcess" 
                        {{ ($record->publish == 2) ? 'checked' : '' }} 
                        data-modelId="{{ $record->id }}"
                    />
                </td>
                <td class="text-center">
                    <a href="{{ route('work_process.edit', $record->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('work_process.delete', $record->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
{{  $records->links('pagination::bootstrap-4') }}
