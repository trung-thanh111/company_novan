<div class="ibox">
    <div class="ibox-title">
        <h5>Cài đặt nâng cao</h5>
    </div>
    <div class="ibox-content">
        <div class="row mb15">
            <div class="col-lg-12">
                <div class="form-row">
                    <label class="control-label text-left">Chọn danh mục cha <span class="text-danger">(*)</span></label>
                    <span class="text-danger block font-size-12">Chọn Root nếu không có danh mục cha</span>
                    <select name="parent_id" class="form-control setupSelect2">
                        <option value="0">Root</option>
                        @if(isset($dropdown))
                            @foreach($dropdown as $key => $val)
                                <option {{ $key == old('parent_id', (isset($projectCatalogue->parent_id)) ? $projectCatalogue->parent_id : '') ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-row">
                    <label class="control-label text-left">Ảnh đại diện</label>
                    <div class="img-thumbnail" style="cursor: pointer;">
                        <img src="{{ (old('image', (isset($projectCatalogue->image)) ? $projectCatalogue->image : '')) ? old('image', (isset($projectCatalogue->image)) ? $projectCatalogue->image : '') : '/vendor/backend/img/not-found.jpg' }}" class="img-fluid upload-image w-100" data-type="Images" style="width: 100%">
                        <input type="hidden" name="image" value="{{ old('image', (isset($projectCatalogue->image)) ? $projectCatalogue->image : '') }}">
                    </div>
                </div>
            </div>
        </div>
        @include('backend.dashboard.component.publish', ['model' => ($projectCatalogue) ?? null, 'hideImage' => true])
    </div>
</div>
