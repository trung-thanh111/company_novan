<form action="{{ route('service.index') }}">
    <div class="filter-wrapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            @include('backend.dashboard.component.perpage')
            <div class="action">
                <div class="uk-flex uk-flex-middle">
                    @include('backend.dashboard.component.filterPublish')
                    @php
                        $serviceCatalogueId = request('service_catalogue_id') ?: old('service_catalogue_id');
                    @endphp
                    <select name="service_catalogue_id" class="form-control setupSelect2 ml10">
                        @foreach($dropdown as $key => $val)
                        <option {{ ($serviceCatalogueId == $key)  ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                    @include('backend.dashboard.component.keyword')
                    <a href="{{ route('service.create') }}" class="btn btn-danger"><i class="fa fa-plus mr5"></i>Thêm mới dịch vụ</a>
                </div>
            </div>
        </div>
    </div>
</form>
