<div class="ibox">
    <div class="ibox-title">
        <h5>Cài đặt nâng cao</h5>
    </div>
    <div class="ibox-content">
        <div class="row mb15">
            <div class="col-lg-12">
                <div class="form-row">
                    <label class="control-label text-left">Chọn danh mục dự án <span class="text-danger">(*)</span></label>
                    <select name="project_catalogue_id" class="form-control setupSelect2">
                        <option value="0">Chọn danh mục</option>
                        @if(isset($dropdown))
                            @foreach($dropdown as $key => $val)
                            <option {{ $key == old('project_catalogue_id', (isset($project->project_catalogue_id)) ? $project->project_catalogue_id : '') ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
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
                        <span class="image img-cover image-target">
                            <img src="{{ (old('image', (isset($project->image)) ? $project->image : '')) ? old('image', (isset($project->image)) ? $project->image : '') : '/vendor/backend/img/not-found.jpg' }}" class="img-fluid upload-image w-100" data-type="Images" style="width: 100%">
                        </span>
                        <input type="hidden" name="image" value="{{ old('image', (isset($project->image)) ? $project->image : '') }}">
                    </div>
                </div>
            </div>
        </div>
        @include('backend.dashboard.component.publish', ['model' => ($project) ?? null, 'hideImage' => true])
        <div class="ibox w">
            <div class="ibox-title">
                <h5>Cài đặt nổi bật</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <select name="is_featured" class="form-control setupSelect2">
                            <option value="1" {{ old('is_featured', (isset($project->is_featured)) ? $project->is_featured : '') == 1 ? 'selected' : '' }}>Không nổi bật</option>
                            <option value="2" {{ old('is_featured', (isset($project->is_featured)) ? $project->is_featured : '') == 2 ? 'selected' : '' }}>Dự án nổi bật</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="ibox w">
            <div class="ibox-title">
                <h5>Cài đặt điều hướng</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <select name="follow" class="form-control setupSelect2">
                            <option value="1" {{ old('follow', (isset($project->follow)) ? $project->follow : '') == 1 ? 'selected' : '' }}>No Follow</option>
                            <option value="2" {{ old('follow', (isset($project->follow)) ? $project->follow : '') == 2 ? 'selected' : '' }}>Follow</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
