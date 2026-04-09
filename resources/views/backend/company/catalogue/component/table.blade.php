<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th style="width:50px;">
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th>Tên nhóm dịch vụ</th>
        @include('backend.dashboard.component.languageTh')
        <th class="text-right">Sắp xếp</th>
        <th class="text-center" style="width:100px;">Trạng thái </th>
        <th class="text-center" style="width:100px;">Thao tác </th>
    </tr>
    </thead>
    <tbody>
        @if(isset($serviceCatalogues) && is_object($serviceCatalogues))
            @foreach($serviceCatalogues as $serviceCatalogue)
            <tr >
                <td>
                    <input type="checkbox" value="{{ $serviceCatalogue->id }}" class="input-checkbox checkBoxItem">
                </td>
               
                <td>
                    {{ str_repeat('|----', (($serviceCatalogue->level > 0)?($serviceCatalogue->level - 1):0)).$serviceCatalogue->name }}
                </td>
                @include('backend.dashboard.component.languageTd', ['model' => $serviceCatalogue, 'modeling' => 'ServiceCatalogue'])
                <td class="sort">
                    <input type="text" name="order" value="{{ $serviceCatalogue->order }}" class="form-control sort-order text-right" data-id="{{ $serviceCatalogue->id }}" data-model="{{ $config['model'] }}">
                </td>
                <td class="text-center js-switch-{{ $serviceCatalogue->id }}"> 
                    <input type="checkbox" value="{{ $serviceCatalogue->publish }}" class="js-switch status " data-field="publish" data-model="{{ $config['model'] }}" {{ ($serviceCatalogue->publish == 2) ? 'checked' : '' }} data-modelId="{{ $serviceCatalogue->id }}" />
                </td>
                <td class="text-center"> 
                    <a href="{{ route('service.catalogue.edit', $serviceCatalogue->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('service.catalogue.delete', $serviceCatalogue->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{  $serviceCatalogues->links('pagination::bootstrap-4') }}
