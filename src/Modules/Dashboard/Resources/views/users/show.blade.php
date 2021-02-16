@extends('dashboard::layouts.app')

@section('title')
    @lang('shared.user_detail')
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.users.show', $user) }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="card card-info">
                    <div class="card-body">

                        <strong>@lang('shared.username')</strong>
                        <p class="text-muted">
                            {{$user->getName()}}
                        </p>
                        <hr>

                        <strong>@lang('shared.email')</strong>
                        <p class="text-muted">
                            {{$user->getEmail()}}
                        </p>

                    </div>

                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6">
                <div class="card card-info">
                    <div class="card-body">

                        <strong>@lang('shared.roles')</strong>
                        <p class="text-muted">
                            {!! $user->getUserRolesAsStringWrap() !!}
                        </p>
                        <hr>

                        <strong>@lang('shared.avatar')</strong>
                        <p class="text-muted">
                            @if($user->hasMedia('avatar'))
                                <a href="{{$user->getFirstMediaUrl('avatar')}}">
                                    <img
                                        width="128"
                                        height="128"
                                        src="{{$user->getFirstMediaUrl('avatar', 'thumb')}}"
                                        alt="avatar"
                                    >
                                </a>
                            @else
                                <img width="100" src="{{asset('images/no-image.jpg')}}" alt="no-image">
                            @endif
                        </p>

                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <a href="{{route('dashboard.admin.users.index')}}"
                   class="btn btn-secondary">@lang('shared.cancel')</a>
                @can('update', $user)
                <a
                    href="{{route('dashboard.admin.users.edit', $user)}}"
                    class="btn btn-success float-right"
                >
                    @lang('shared.edit')
                </a>
                @endcan
            </div>
        </div>
    </div>
@endsection
