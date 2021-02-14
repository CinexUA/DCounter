@extends('dashboard::layouts.app')

@section('title')
    {{__('Add new user')}}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.users.create') }}
@endsection

@section('content')
    <div class="container-fluid">
        {!! Form::open(['route' => 'dashboard.admin.users.store', 'files' => true]) !!}
        @include('dashboard::users._form')
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('dashboard.admin.users.index')}}"
                   class="btn btn-secondary">{{__('Cancel')}}</a>
                {{Form::submit(__('Create'), ['class' => 'btn btn-success float-right'])}}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
