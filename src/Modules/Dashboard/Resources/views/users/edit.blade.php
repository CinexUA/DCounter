@extends('dashboard::layouts.app')

@section('title')
    {{__('Add new user')}}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.users.edit', $user) }}
@endsection

@section('content')
    <div class="container-fluid">
        {!! Form::model($user,
            [
                'method' => 'PATCH',
                'files' => true,
                'route' => ['dashboard.admin.users.update', $user]
            ]
        ) !!}
        @include('dashboard::users._form')
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('dashboard.admin.users.index')}}"
                   class="btn btn-secondary">{{__('Cancel')}}</a>
                {{Form::submit(__('Update'), ['class' => 'btn btn-success float-right'])}}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
