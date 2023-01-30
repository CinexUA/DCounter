@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.cron_logs_list')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.cron-logs.index') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        @include('dashboard::cron-logs._list')
                    </div>

                    <div class="card-footer clearfix">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                @include('dashboard::partials._per_page')
                                &nbsp;
                                @lang('shared.show_page_from_to_total', [
                                    'first' => $cronLogs->firstItem(),
                                    'last' => $cronLogs->lastItem(),
                                    'total' => $cronLogs->total()
                                ])
                            </div>
                            <div class="col-12 col-sm-6">
                                {{ $cronLogs->appends(request()->except('page'))->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
