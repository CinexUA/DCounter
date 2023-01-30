@extends('dashboard::layouts.app')

@section('title')
    @lang('shared.permissions')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.permissions.index') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        @include('dashboard::permissions._list')
                    </div>

                    <div class="card-footer clearfix">
                        <div class="row">
                            <div class="col-12 offset-sm-6 col-sm-6">
                                {{ $permissions->appends(request()->except('page'))->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
