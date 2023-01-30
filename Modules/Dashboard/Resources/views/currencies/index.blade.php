@extends('dashboard::layouts.app')

@section('title')
    @lang('shared.currencies')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.currencies.index') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6 mb-0 mb-sm-0">
                            </div>
                            <div class="col-sm-6 text-sm-right">
                                @can('create', \App\Models\Currency::class)
                                <a href="{{route('dashboard.admin.currencies.create')}}" class="btn btn-sm btn-success">
                                    <i class="fas fa-plus"></i> @lang('shared.add')
                                </a>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('dashboard::currencies._list')
                    </div>

                    <div class="card-footer clearfix">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                @include('dashboard::partials._per_page')
                                &nbsp;
                                @lang('shared.show_page_from_to_total', [
                                    'first' => $currencies->firstItem(),
                                    'last' => $currencies->lastItem(),
                                    'total' => $currencies->total()
                                ])
                            </div>
                            <div class="col-12 col-sm-6">
                                {{ $currencies->appends(request()->except('page'))->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
