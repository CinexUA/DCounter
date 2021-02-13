@extends('dashboard::layouts.app')

@section('title')
    {{__('Add new user')}}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.users.edit', $user) }}
@endsection

@section('content')
    <div class="container-fluid">
        {!! Form::model($user, ['method' => 'PATCH', 'route' => ['dashboard.admin.users.update', $user]]) !!}
        @include('dashboard::users._form')
        {!! Form::close() !!}
    </div>
@endsection
