@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.company', ['name' => $company->getName()]), @lang('dashboard::shared.clients_list')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('company.clients.index', $company) }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6 mb-2 mb-sm-0">
                                <a href="#" class="btn btn-sm btn-primary btn-filter">
                                    <i class="fas fa-filter"></i> @lang('shared.filter')
                                </a>
                            </div>
                            <div class="col-sm-6 text-sm-right">
                                @can('create', App\Models\Client::class)
                                <a href="{{route('dashboard.company.clients.create', $company)}}" class="btn btn-sm btn-success">
                                    <i class="fas fa-plus"></i> @lang('shared.add')
                                </a>
                                @endcan
                            </div>
                        </div>
                    </div>

                    @include('dashboard::clients._filter')

                    <div class="card-body">
                        @include('dashboard::clients._list')
                    </div>

                    <div class="card-footer clearfix">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                @include('dashboard::partials._per_page')
                                &nbsp;
                                @lang('shared.show_page_from_to_total', [
                                    'first' => $clients->firstItem(),
                                    'last' => $clients->lastItem(),
                                    'total' => $clients->total()
                                ])
                            </div>
                            <div class="col-12 col-sm-6">
                                {{ $clients->appends(request()->except('page'))->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
