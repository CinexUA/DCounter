@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.edit_currency')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.currencies.edit', $currency) }}
@endsection

@section('content')
    <div class="container-fluid">
        {!! Form::model($currency,
            [
                'method' => 'PATCH',
                'files' => true,
                'route' => ['dashboard.admin.currencies.update', $currency]
            ]
        ) !!}
        @include('dashboard::currencies._form')
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('dashboard.admin.currencies.index')}}"
                   class="btn btn-secondary">@lang('shared.cancel')</a>
                {{Form::submit(trans('shared.update'), ['class' => 'btn btn-success float-right'])}}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
