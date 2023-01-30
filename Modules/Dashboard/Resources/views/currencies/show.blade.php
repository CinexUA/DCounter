@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.currency_detail')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.currencies.show', $currency) }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="card card-info">
                    <div class="card-body">

                        @foreach($languages as $langKey)
                        <strong>@lang('shared.name') {{strtoupper($langKey)}}</strong>
                        <p class="text-muted">
                            {{$currency->getTranslation('name', $langKey)}}
                        </p>
                        @if(!$loop->last)
                        <hr>
                        @endif
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('dashboard.admin.currencies.index')}}"
                   class="btn btn-secondary">@lang('shared.back')</a>
                @can('update', $currency)
                <a
                    href="{{route('dashboard.admin.currencies.edit', $currency)}}"
                    class="btn btn-success float-right"
                >
                    @lang('shared.edit')
                </a>
                @endcan
            </div>
        </div>
    </div>
@endsection
