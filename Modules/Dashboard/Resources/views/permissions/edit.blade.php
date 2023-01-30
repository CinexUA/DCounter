@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.permission_edit')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.permissions.edit', $permission) }}
@endsection

@section('content')
    <div class="container-fluid">
        {!! Form::model($permission,
            [
                'method' => 'PATCH',
                'files' => true,
                'route' => ['dashboard.admin.permissions.update', $permission],
                'id' => 'form-role'
            ]
        ) !!}
        @include('dashboard::permissions._form')
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('dashboard.admin.permissions.index')}}"
                   class="btn btn-secondary">@lang('shared.cancel')</a>
                {{Form::submit(trans('shared.update'), ['class' => 'btn btn-success float-right'])}}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
