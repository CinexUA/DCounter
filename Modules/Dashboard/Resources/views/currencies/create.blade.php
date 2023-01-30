@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.add_new_currency')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.currencies.create') }}
@endsection

@section('content')
    <div class="container-fluid">
        {!! Form::open(['route' => 'dashboard.admin.currencies.store']) !!}
        @include('dashboard::currencies._form')
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('dashboard.admin.currencies.index')}}"
                   class="btn btn-secondary">@lang('shared.cancel')</a>
                {{Form::submit(trans('shared.create'), ['class' => 'btn btn-success float-right'])}}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
