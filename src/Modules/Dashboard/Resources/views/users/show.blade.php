@extends('dashboard::layouts.app')

@section('title')
    {{__('User detail')}}
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

                        <strong>{{__('Username')}}</strong>
                        <p class="text-muted">
                            {{$user->getName()}}
                        </p>
                        <hr>

                        <strong>{{__('Email')}}</strong>
                        <p class="text-muted">
                            {{$user->getEmail()}}
                        </p>

                    </div>

                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6">
                <div class="card card-info">
                    <div class="card-body">

                        <strong>{{__('Roles')}}</strong>
                        <p class="text-muted">
                            {!! $user->getUserRolesAsStringWrap() !!}
                        </p>
                        <hr>

                        <strong>{{__('Avatar')}}</strong>
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
                   class="btn btn-secondary">{{__('Cancel')}}</a>
                @can('update', $user)
                <a
                    href="{{route('dashboard.admin.users.edit', $user)}}"
                    class="btn btn-success float-right"
                >
                    {{__('Edit')}}
                </a>
                @endcan
            </div>
        </div>
    </div>
@endsection
