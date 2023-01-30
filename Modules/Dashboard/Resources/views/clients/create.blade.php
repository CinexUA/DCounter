@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.add_new_client')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('company.clients.create', $company) }}
@endsection

@section('content')
    <div class="container-fluid">
        {!! Form::open(['route' => ['dashboard.company.clients.store', $company]]) !!}
        @include('dashboard::clients._form')
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('dashboard.company.clients.index', $company)}}"
                   class="btn btn-secondary">@lang('shared.cancel')</a>
                {{Form::submit(trans('shared.create'), ['class' => 'btn btn-success float-right'])}}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
