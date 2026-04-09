<form action="{{ route('project.index') }}">
    <div class="filter-wrapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            @include('backend.dashboard.component.perpage')
            <div class="action">
                <div class="uk-flex uk-flex-middle">
                    @php
                        $projectCatalogueId = request('project_catalogue_id') ?: old('project_catalogue_id');
                    @endphp
                    <select name="project_catalogue_id" class="form-control mr10 setupSelect2">
                        <option value="0">Chọn nhóm dự án</option>
                        @if(isset($dropdown))
                            @foreach($dropdown as $key => $val)
                            <option {{ ($projectCatalogueId == $key) ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        @endif
                    </select>
                    @include('backend.dashboard.component.filterPublish')
                    @include('backend.dashboard.component.keyword')
                    <a href="{{ route('project.create') }}" class="btn btn-danger"><i class="fa fa-plus mr5"></i>Thêm mới dự án</a>
                </div>
            </div>
        </div>
    </div>
</form>
