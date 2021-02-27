@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.edit_client')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('company.clients.edit', $company, $client) }}
@endsection

@section('content')
    <div class="container-fluid">
        {!! Form::model($client,
            [
                'method' => 'PATCH',
                'files' => true,
                'route' => ['dashboard.company.clients.update', [$client, $company]]
            ]
        ) !!}
        @include('dashboard::clients._form')
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('dashboard.company.clients.index', [$company, $client])}}"
                   class="btn btn-secondary">@lang('shared.cancel')</a>
                {{Form::submit(trans('shared.update'), ['class' => 'btn btn-success float-right'])}}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
