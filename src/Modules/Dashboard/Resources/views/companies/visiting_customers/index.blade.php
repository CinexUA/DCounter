@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.company', ['name' => $company->getName()])
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('companies.visiting-customers', $company) }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6 mb-0 mb-sm-0"></div>
                            <div class="col-sm-6 text-sm-right">
                                <a href="{{route('dashboard.companies.create')}}" class="btn btn-sm btn-success">
                                    <i class="fas fa-plus"></i> @lang('shared.add')
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('dashboard::companies.visiting_customers._list')
                    </div>

                    <div class="card-footer clearfix">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                @include('dashboard::partials._per_page')
                                &nbsp;
                                @lang('shared.show_page_from_to_total', [
                                    'first' => $visitingList->firstItem(),
                                    'last' => $visitingList->lastItem(),
                                    'total' => $visitingList->total()
                                ])
                            </div>
                            <div class="col-12 col-sm-6">
                                {{ $visitingList->appends(request()->except('page'))->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
