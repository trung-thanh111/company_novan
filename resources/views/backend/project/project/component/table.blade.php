<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th style="width: 50px;">
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th>Tên dự án</th>
        <th class="text-right" style="width: 150px;">Giá trị/Ngân sách</th>
        <th class="text-right" style="width: 120px;">Quy mô</th>
        <th class="text-center" style="width: 80px;">Nổi bật</th>
        <th class="text-center" style="width: 80px;">Trạng thái</th>
        <th class="text-center" style="width: 100px;">Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($projects) && is_object($projects))
        @foreach($projects as $project)
        <tr>
            <td>
                <input type="checkbox" value="{{ $project->id }}" class="input-checkbox checkBoxItem">
            </td>
            <td>
                <div class="uk-flex uk-flex-middle">
                    <div class="image mr5">
                        <span class="img-cover"><img src="{{ (isset($project->image) && !empty($project->image)) ? $project->image : '/vendor/backend/img/not-found.jpg' }}" alt=""></span>
                    </div>
                    <div class="main-info">
                        <div class="name"><span class="main-title">{{ $project->name }}</span></div>
                        <div class="catalogue">
                            <span class="text-danger">Nhóm: </span>
                            <a href="{{ route('project.index', ['project_catalogue_id' => $project->project_catalogue_id]) }}" title="">{{ $project->catalogue_name }}</a>
                        </div>
                    </div>
                </div>
            </td>
            <td class="text-right">
                {{ ($project->value > 0) ? number_format($project->value, 0, ',', '.') . ' đ' : 'Liên hệ' }}
            </td>
            <td class="text-right">
                {{ $project->scale ?? 'N/A' }}
            </td>
            <td class="text-center js-switch-{{ $project->id }}">
                <input type="checkbox" value="{{ $project->is_featured }}" class="js-switch setup-is_featured" data-field="is_featured" data-model="Project" data-id="{{ $project->id }}" {{ ($project->is_featured == 2) ? 'checked' : '' }}>
            </td>
            <td class="text-center js-switch-{{ $project->id }}">
                <input type="checkbox" value="{{ $project->publish }}" class="js-switch setup-publish" data-field="publish" data-model="Project" data-id="{{ $project->id }}" {{ ($project->publish == 2) ? 'checked' : '' }}>
            </td>
            <td class="text-center"> 
                <a href="{{ route('project.edit', $project->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="{{ route('project.delete', $project->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    @endif
    </tbody>
</table>
{{  $projects->links('pagination::bootstrap-4') }}
