@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.permission_detail')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.permissions.show', $permission) }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="card card-info">
                    <div class="card-body">

                        <strong>@lang('shared.name')</strong>
                        <p class="text-muted">
                            {{$permission->getName()}}
                        </p>
                        <hr>

                        <strong>@lang('shared.display_name')</strong>
                        <p class="text-muted">
                            {{$permission->getDescription()}}
                        </p>
                        <hr>

                        <strong>@lang('shared.created_at')</strong>
                        <p class="text-muted">
                            {{$permission->getCreatedAt()}}
                        </p>
                        <hr>

                        <strong>@lang('shared.updated_at')</strong>
                        <p class="text-muted">
                            {{$permission->getUpdatedAt()}}
                        </p>

                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('dashboard.admin.permissions.index')}}"
                   class="btn btn-secondary">@lang('shared.cancel')</a>
                @can('update', $permission)
                    <a
                        href="{{route('dashboard.admin.permissions.edit', $permission)}}"
                        class="btn btn-success float-right"
                    >
                        @lang('shared.edit')
                    </a>
                @endcan
            </div>
        </div>
    </div>
@endsection
