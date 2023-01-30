@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.companies_list')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('companies.index') }}
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
                                @can('create', App\Models\Company::class)
                                <a href="{{route('dashboard.companies.create')}}" class="btn btn-sm btn-success">
                                    <i class="fas fa-plus"></i> @lang('shared.add')
                                </a>
                                @endcan
                            </div>
                        </div>
                    </div>

                    @include('dashboard::companies._filter')

                    <div class="card-body">
                        @include('dashboard::companies._list')
                    </div>

                    <div class="card-footer clearfix">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                @include('dashboard::partials._per_page')
                                &nbsp;
                                @lang('shared.show_page_from_to_total', [
                                    'first' => $companies->firstItem(),
                                    'last' => $companies->lastItem(),
                                    'total' => $companies->total()
                                ])
                            </div>
                            <div class="col-12 col-sm-6">
                                {{ $companies->appends(request()->except('page'))->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
