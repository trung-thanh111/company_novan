<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th style="width:50px;">
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th>Tên nhóm</th>
        <th class="text-center" style="width:100px;">Sắp xếp</th>
        <th class="text-center" style="width:100px;">Tình trạng</th>
        <th class="text-center" style="width:100px;">Thao tác</th>
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
                {{ str_repeat('|-----', (($record->level > 0)?($record->level - 1):0)).$record->name }}
            </td>
            <td>
                <input type="text" name="order" value="{{ $record->order }}" class="form-control sort-order text-right" data-id="{{ $record->id }}" data-model="FaqCatalogue">
            </td>
            <td class="text-center js-switch-{{ $record->id }}">
                <input type="checkbox" value="{{ $record->publish }}" class="js-switch status " data-field="publish" data-model="FaqCatalogue" data-modelId="{{ $record->id }}" {{ ($record->publish == 2) ? 'checked' : '' }} />
            </td>
            <td class="text-center">
                <a href="{{ route('faq.catalogue.edit', $record->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="{{ route('faq.catalogue.delete', $record->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    @endif
    </tbody>
</table>
{{  $records->links('pagination::bootstrap-4') }}
