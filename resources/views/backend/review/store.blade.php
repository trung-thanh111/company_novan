@php
    $breadcrumbTitle = $config['method'] === 'create'
        ? 'Thêm mới đánh giá'
        : 'Chỉnh sửa đánh giá';
@endphp
@include('backend.dashboard.component.breadcrumb', ['title' => $breadcrumbTitle])
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@php
    $url = ($config['method'] == 'create') ? route('review.store') : route('review.update', $record->id);
@endphp
<form action="{{ $url }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Thông tin đánh giá</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label class="control-label text-left">Họ tên khách hàng <span class="text-danger">(*)</span></label>
                                    <input type="text" name="fullname" value="{{ old('fullname', $record->fullname ?? '') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label class="control-label text-left">Email</label>
                                    <input type="text" name="email" value="{{ old('email', $record->email ?? '') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label class="control-label text-left">Số điện thoại</label>
                                    <input type="text" name="phone" value="{{ old('phone', $record->phone ?? '') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label class="control-label text-left">Điểm (1–5) <span class="text-danger">(*)</span></label>
                                    <input type="number" min="1" max="5" name="score" value="{{ old('score', $record->score ?? 5) }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label class="control-label text-left">Nội dung đánh giá <span class="text-danger">(*)</span></label>
                                    <textarea name="description" rows="4" class="form-control">{{ old('description', $record->description ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Cấu hình</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="form-row mb15">
                            <label class="control-label text-left">Trạng thái</label>
                            @php
                                $status = old('status', $record->status ?? 1);
                            @endphp
                            <select name="status" class="form-control">
                                <option value="1" {{ $status == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ $status == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>

