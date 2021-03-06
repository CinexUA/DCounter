@extends('dashboard::layouts.app')

@section('title')
    @lang('dashboard::shared.role_detail')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.roles.show', $role) }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="card card-info">
                    <div class="card-body">

                        <strong>@lang('shared.name')</strong>
                        <p class="text-muted">
                            {{$role->getName()}}
                        </p>
                        <hr>

                        <strong>@lang('shared.display_name')</strong>
                        <p class="text-muted">
                            {{$role->getDescription()}}
                        </p>
                        <hr>

                        <strong>@lang('shared.created_at')</strong>
                        <p class="text-muted">
                            {{$role->getCreatedAt()}}
                        </p>
                        <hr>

                        <strong>@lang('shared.updated_at')</strong>
                        <p class="text-muted">
                            {{$role->getUpdatedAt()}}
                        </p>

                    </div>

                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6">
                <div class="card card-info">
                    <div class="card-body">

                        <strong>@lang('shared.permissions')</strong>
                        <p class="text-muted">
                            {!! $role->getRolesPermissionsAsStringWrap() !!}
                        </p>

                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('dashboard.admin.roles.index')}}"
                   class="btn btn-secondary">@lang('shared.back')</a>
                @can('update', $role)
                    <a
                        href="{{route('dashboard.admin.roles.edit', $role)}}"
                        class="btn btn-success float-right"
                    >
                        @lang('shared.edit')
                    </a>
                @endcan
            </div>
        </div>
    </div>
@endsection
