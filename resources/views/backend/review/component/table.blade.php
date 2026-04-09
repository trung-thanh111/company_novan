<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th style="width:50px;">
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th class="text-center" style="width: 260px;">Khách hàng</th>
        <th>Nội dung</th>
        <th class="text-center" style="width: 120px;">Điểm</th>
        <th class="text-center" style="width: 120px;">Trạng thái</th>
        <th class="text-center" style="width: 140px;">Ngày tạo</th>
        <th class="text-center" style="width: 150px;">Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($reviews) && is_object($reviews))
        @foreach($reviews as $review)
            <tr>
                <td>
                    <input type="checkbox" value="{{ $review->id }}" class="input-checkbox checkBoxItem">
                </td>
                <td>
                    <div class="info-item">
                        <div class="name">
                            {{ $review->fullname ?? 'Khách hàng ẩn danh' }}
                        </div>
                        @if(!empty($review->email))
                            <div style="font-size: 12px; color:#6b7280;">{{ $review->email }}</div>
                        @endif
                        @if(!empty($review->phone))
                            <div style="font-size: 12px; color:#6b7280;">{{ $review->phone }}</div>
                        @endif
                    </div>
                </td>
                <td>
                    {{ \Illuminate\Support\Str::limit($review->description, 120) }}
                </td>
                <td class="text-center">
                    {{ $review->score }}/5
                </td>
                <td class="text-center js-switch-{{ $review->id }}">
                    <input type="checkbox"
                           class="js-switch status"
                           data-field="status"
                           data-model="{{ $config['model'] }}"
                           data-value="{{ $review->status }}"
                           data-id="{{ $review->id }}"
                           {{ ($review->status == 1) ? 'checked' : '' }}>
                </td>
                <td class="text-center">
                    {{ $review->created_at }}
                </td>
                <td class="text-center">
                    <a href="{{ route('review.edit', $review->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('review.delete', $review->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
{{  $reviews->links('pagination::bootstrap-4') }}

