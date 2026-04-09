@include('backend.dashboard.component.breadcrumb', ['title' => ($config['method'] == 'create') ? $config['seo']['create']['title'] : $config['seo']['edit']['title']])
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
    $url = ($config['method'] == 'create') ? route('core_value.store') : route('core_value.update', $record->id);
@endphp

<form action="{{ $url }}" method="post" class="box" >
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Thông tin chung</h5>
                    </div>
                    <div class="ibox-content">
                        @include('backend.dashboard.component.formError')
                        <div class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Tiêu đề <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="name"
                                        value="{{ old('name', (isset($record) && $record->languages->first() ? $record->languages->first()->pivot->name : '')) }}"
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
                                    <label for="" class="control-label text-left">Mô tả ngắn</label>
                                    <textarea 
                                        name="description" 
                                        class="form-control" 
                                        style="min-height: 100px;"
                                    >{{ old('description', (isset($record) && $record->languages->first() ? $record->languages->first()->pivot->description : '')) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Nội dung chi tiết</label>
                                    <textarea 
                                        name="content" 
                                        class="form-control ck-editor" 
                                        id="ckContent"
                                        style="min-height: 200px;"
                                        data-height="200"
                                    >{{ old('content', (isset($record) && $record->languages->first() ? $record->languages->first()->pivot->content : '')) }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Image / Icon</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <span class="image img-cover image-target"><img src="{{ old('image', (isset($record->image) ? $record->image : 'backend/img/not-found.png')) }}" alt=""></span>
                                    <input type="hidden" name="image" value="{{ old('image', (isset($record->image) ? $record->image : '')) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Cấu hình chung</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Vị trí (Order)</label>
                                    <input 
                                        type="number"
                                        name="order"
                                        value="{{ old('order', (isset($record->order) ? $record->order : 0)) }}"
                                        class="form-control int"
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <select name="publish" class="form-control setupSelect2" id="">
                                        @foreach(config('apps.general.publish') as $key => $val)
                                            <option {{ $key == old('publish', (isset($record->publish) ? $record->publish : '')) ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
