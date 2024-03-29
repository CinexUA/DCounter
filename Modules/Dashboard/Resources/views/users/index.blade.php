@extends('dashboard::layouts.app')

@section('title')
    @lang('shared.users')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.users.index') }}
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
                                @can('create', \App\Models\User::class)
                                <a href="{{route('dashboard.admin.users.create')}}" class="btn btn-sm btn-success">
                                    <i class="fas fa-plus"></i> @lang('shared.add')
                                </a>
                                @endcan
                            </div>
                        </div>
                    </div>

                    @include('dashboard::users._filter')

                    <div class="card-body">
                        @include('dashboard::users._list')
                    </div>

                    <div class="card-footer clearfix">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                @include('dashboard::partials._per_page')
                                &nbsp;
                                @lang('shared.show_page_from_to_total', [
                                    'first' => $users->firstItem(),
                                    'last' => $users->lastItem(),
                                    'total' => $users->total()
                                ])
                            </div>
                            <div class="col-12 col-sm-6">
                                {{ $users->appends(request()->except('page'))->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
