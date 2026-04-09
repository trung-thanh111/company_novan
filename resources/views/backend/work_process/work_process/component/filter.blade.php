<form action="{{ route('work_process.index') }}">
    <div class="filter-wrapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <div class=" uk-flex uk-flex-middle">
                @php
                    $publish = request('publish') ?: 0;
                @endphp
                <select name="publish" class="form-control setupSelect2 ml10">
                    @foreach(config('apps.general.publish') as $key => $val)
                        <option {{ ($publish == $key) ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
                <div class="uk-search uk-flex uk-flex-middle ml10">
                    <div class="input-group">
                        <input 
                            type="text" 
                            name="keyword" 
                            value="{{ request('keyword') }}" 
                            placeholder="Nhập từ khóa bạn muốn tìm kiếm..." 
                            class="form-control"
                        >
                        <span class="input-group-btn">
                            <button type="submit" name="search" value="search" class="btn btn-primary mb0 btn-sm">Tìm Kiếm
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="uk-flex uk-flex-middle">
                <a href="{{ route('work_process.create') }}" class="btn btn-success"><i class="fa fa-plus mr5"></i>Thêm mới quy trình</a>
            </div>
        </div>
    </div>
</form>
