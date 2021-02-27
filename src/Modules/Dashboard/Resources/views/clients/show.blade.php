@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.detail_client')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('company.clients.show', $company, $client) }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="card card-info">
                    <div class="card-body">

                        <strong>@lang('shared.name')</strong>
                        <p class="text-muted">
                            {{$client->getName()}}
                        </p>
                        <hr>

                        <strong>@lang('shared.email')</strong>
                        <p class="text-muted">
                            {{$client->getEmail()}}
                        </p>
                        <hr>

                        <strong>@lang('shared.company')</strong>
                        <p class="text-muted">
                            {{$company->getName()}}
                        </p>
                        <hr>

                        <strong>@lang('shared.balance')</strong>
                        <p class="text-muted">
                            {{$client->balanceFloat}}
                        </p>

                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('dashboard.company.clients.index', $company)}}"
                   class="btn btn-secondary">@lang('shared.cancel')</a>
                @can('update', $company)
                <a
                    href="{{route('dashboard.company.clients.edit', [$company, $client])}}"
                    class="btn btn-success float-right"
                >
                    @lang('shared.edit')
                </a>
                @endcan
            </div>
        </div>
    </div>
@endsection
