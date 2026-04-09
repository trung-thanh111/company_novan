<div class="ibox">
    <div class="ibox-title">
        <h5>Cấu hình chung</h5>
    </div>
    <div class="ibox-content">
        <div class="row mb15">
            <div class="col-lg-12">
                <div class="form-row">
                    <label for="" class="control-label text-left">Sắp xếp</label>
                    <input 
                        type="text"
                        name="order"
                        value="{{ old('order', ($record->order) ?? 0 ) }}"
                        class="form-control"
                        placeholder=""
                        autocomplete="off"
                    >
                </div>
            </div>
        </div>
        <div class="row mb15">
            <div class="col-lg-12">
                <div class="form-row">
                    <label for="" class="control-label text-left">Tình trạng</label>
                    <select name="publish" class="form-control setupSelect2">
                        @foreach(__('messages.publish') as $key => $val)
                        <option {{ ($key == old('publish', (isset($record->publish)) ? $record->publish : '')) ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ibox">
    <div class="ibox-title">
        <h5>Ảnh minh họa / Icon</h5>
    </div>
    <div class="ibox-content text-center">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-row">
                    <span class="image img-cover image-target"><img src="{{ old('image', ($record->image) ?? 'backend/img/not-found.png') }}" alt=""></span>
                    <input type="hidden" name="image" value="{{ old('image', ($record->image) ?? '') }}">
                </div>
            </div>
        </div>
    </div>
</div>
