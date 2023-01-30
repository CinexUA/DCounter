@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.edit_company')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('companies.edit', $company) }}
@endsection

@section('content')
    <div class="container-fluid">
        {!! Form::model($company,
            [
                'method' => 'PATCH',
                'files' => true,
                'route' => ['dashboard.companies.update', $company]
            ]
        ) !!}
        @include('dashboard::companies._form')
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('dashboard.companies.index')}}"
                   class="btn btn-secondary">@lang('shared.cancel')</a>
                {{Form::submit(trans('shared.update'), ['class' => 'btn btn-success float-right'])}}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
