@extends('dashboard::layouts.app')

@section('title')
    {{__('Add new user')}}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.users.create') }}
@endsection

@section('content')
    <div class="container-fluid">
        {!! Form::open(['route' => 'dashboard.admin.users.store']) !!}
        @include('dashboard::users._form')
        {!! Form::close() !!}
    </div>
@endsection
