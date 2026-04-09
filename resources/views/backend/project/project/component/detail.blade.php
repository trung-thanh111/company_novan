<div class="ibox">
    <div class="ibox-title">
        <h5>Thông tin kỹ thuật dự án</h5>
    </div>
    <div class="ibox-content">
        <div class="row mb15">
            <div class="col-lg-6">
                <div class="form-row">
                    <label class="control-label text-left">Giá trị/Ngân sách (đ)</label>
                    <input type="text" name="value" value="{{ old('value', (isset($project->value)) ? number_format($project->value, 0, ',', '.') : '') }}" class="form-control int text-right" placeholder="0">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-row">
                    <label class="control-label text-left">Quy mô</label>
                    <input type="text" name="scale" value="{{ old('scale', (isset($project->scale)) ? $project->scale : '') }}" class="form-control" placeholder="Ví dụ: 2 block, 30 tầng, hoặc 20 thành viên...">
                </div>
            </div>
        </div>
        <div class="row mb15">
            <div class="col-lg-6">
                <div class="form-row">
                    <label class="control-label text-left">Địa điểm/Vị trí</label>
                    <input type="text" name="location" value="{{ old('location', (isset($project->location)) ? $project->location : '') }}" class="form-control" placeholder="Nhập địa chỉ hoặc khu vực">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-row">
                    <label class="control-label text-left">Khách hàng/Đối tác</label>
                    <input type="text" name="customer" value="{{ old('customer', (isset($project->customer)) ? $project->customer : '') }}" class="form-control" placeholder="Tên khách hàng hoặc chủ đầu tư">
                </div>
            </div>
        </div>
        <div class="row mb15">
            <div class="col-lg-6">
                <div class="form-row">
                    <label class="control-label text-left">Ngày bắt đầu</label>
                    <input type="date" name="start_date" value="{{ old('start_date', (isset($project->start_date)) ? \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') : '') }}" class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-row">
                    <label class="control-label text-left">Ngày kết thúc</label>
                    <input type="date" name="end_date" value="{{ old('end_date', (isset($project->end_date)) ? \Carbon\Carbon::parse($project->end_date)->format('Y-m-d') : '') }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row mb15">
            <div class="col-lg-12">
                <div class="form-row">
                    <label class="control-label text-left">Trạng thái dự án</label>
                    <select name="status" class="form-control setupSelect2">
                        @php
                            $status = ['Đang triển khai', 'Đã hoàn thành', 'Đang tạm dừng', 'Sắp ra mắt', 'Đang mở bán'];
                        @endphp
                        <option value="">Chọn trạng thái</option>
                        @foreach($status as $val)
                            <option {{ old('status', (isset($project->status)) ? $project->status : '') == $val ? 'selected' : '' }} value="{{ $val }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row mb15">
            <div class="col-lg-12">
                <div class="form-row">
                    <label class="control-label text-left">Thông tin bổ sung (Amenities/Features)</label>
                    <input type="text" name="amenities" value="{{ old('amenities', (isset($project->amenities)) ? $project->amenities : '') }}" class="form-control" placeholder="Đặc điểm nổi bật, tính năng... (Phân cách bằng dấu phẩy)">
                </div>
            </div>
        </div>
        <div class="row mb15">
            <div class="col-lg-6">
                <div class="form-row">
                    <label class="control-label text-left">Link Video (Youtube/Vimeo)</label>
                    <input type="text" name="video_url" value="{{ old('video_url', (isset($project->video_url)) ? $project->video_url : '') }}" class="form-control" placeholder="https://youtube.com/watch?v=...">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-row">
                    <label class="control-label text-left">Tài liệu đính kèm (PDF/Doc)</label>
                    <div class="uk-flex uk-flex-middle">
                        <input type="text" name="brochure" value="{{ old('brochure', (isset($project->brochure)) ? $project->brochure : '') }}" class="form-control upload-file" placeholder="Chọn file tài liệu">
                        <button type="button" class="btn btn-primary btn-upload-file" data-type="Files"><i class="fa fa-upload"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-row">
                    <label class="control-label text-left">Bản đồ nhúng (Iframe/Map URL)</label>
                    <textarea name="map" class="form-control" rows="3">{{ old('map', (isset($project->map)) ? $project->map : '') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
