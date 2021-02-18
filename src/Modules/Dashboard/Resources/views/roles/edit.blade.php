@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.role_edit')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.roles.edit', $role) }}
@endsection

@section('content')
    <div class="container-fluid">
        {!! Form::model($role,
            [
                'method' => 'PATCH',
                'files' => true,
                'route' => ['dashboard.admin.roles.update', $role],
                'id' => 'form-role'
            ]
        ) !!}
        @include('dashboard::roles._form')
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('dashboard.admin.roles.index')}}"
                   class="btn btn-secondary">@lang('shared.cancel')</a>
                {{Form::submit(trans('shared.update'), ['class' => 'btn btn-success float-right'])}}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
