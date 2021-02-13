@extends('dashboard::layouts.app')

@section('title')
    {{__('Users')}}
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
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6 text-sm-right">
                                <a href="{{route('dashboard.admin.users.create')}}" class="btn btn-sm btn-success">
                                    @lang('shared.add')
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('dashboard::users._list')
                    </div>

                    <div class="card-footer clearfix">
                        {{ $users->appends(request()->except('page'))->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
