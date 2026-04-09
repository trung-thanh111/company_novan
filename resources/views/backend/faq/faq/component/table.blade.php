<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th style="width:50px;">
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th>Câu hỏi</th>
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
                <div class="uk-flex uk-flex-middle">
                    <div class="image mr5">
                        <div class="img-cover"><img src="{{ (asset($record->image)) ? asset($record->image) : asset('vendor/backend/img/not-found.jpg') }}" alt="" style="width:40px;height:40px;object-fit:cover"></div>
                    </div>
                    <div class="main-info">
                        <div class="name"><span class="main-title">{{ $record->name }}</span></div>
                        <div class="catalogue">
                            <span class="text-danger">Nhóm: </span>
                            @foreach($record->faq_catalogues as $val)
                                @foreach($val->languages as $lang)
                                    @if($lang->pivot->language_id == $thisLanguage)
                                        <a href="{{ route('faq.index', ['faq_catalogue_id' => $val->id]) }}" title="">{{ $lang->pivot->name }}</a>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <input type="text" name="order" value="{{ $record->order }}" class="form-control sort-order text-right" data-id="{{ $record->id }}" data-model="Faq">
            </td>
            <td class="text-center js-switch-{{ $record->id }}">
                <input type="checkbox" value="{{ $record->publish }}" class="js-switch status " data-field="publish" data-model="Faq" data-modelId="{{ $record->id }}" {{ ($record->publish == 2) ? 'checked' : '' }} />
            </td>
            <td class="text-center">
                <a href="{{ route('faq.edit', $record->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="{{ route('faq.delete', $record->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    @endif
    </tbody>
</table>
{{  $records->links('pagination::bootstrap-4') }}
