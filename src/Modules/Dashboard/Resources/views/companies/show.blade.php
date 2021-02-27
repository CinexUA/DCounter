@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.detail_company')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('companies.show', $company) }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="card card-info">
                    <div class="card-body">

                        <strong>@lang('shared.name')</strong>
                        <p class="text-muted">
                            {{$company->getName()}}
                        </p>
                        <hr>

                        @if(!empty($company->getDescription()))
                        <strong>@lang('shared.description')</strong>
                        <p class="text-muted">
                            {{$company->getDescription()}}
                        </p>
                        <hr>
                        @endif

                        <strong>@lang('dashboard::shared.price_per_month')</strong>
                        <p class="text-muted">
                            {{$company->getPricePerMonth()}}
                        </p>

                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('dashboard.companies.index')}}"
                   class="btn btn-secondary">@lang('shared.back')</a>
                @can('update', $company)
                <a
                    href="{{route('dashboard.companies.edit', $company)}}"
                    class="btn btn-success float-right"
                >
                    @lang('shared.edit')
                </a>
                @endcan
            </div>
        </div>
    </div>
@endsection
