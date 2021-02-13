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
            <div class="col-12 col-sm-8 col-md-6">
                <div class="card card-info">
                    <div class="card-body">

                        @can('update', $user)
                        <a href="{{route('dashboard.admin.users.edit', $user)}}">{{__('Edit')}}</a>
                        <hr>
                        @endcan

                        <strong>{{__('Username')}}</strong>
                        <p class="text-muted">
                            {{$user->getName()}}
                        </p>
                        <hr>

                        <strong>{{__('Email')}}</strong>
                        <p class="text-muted">
                            {{$user->getEmail()}}
                        </p>
                        <hr>

                        <strong>{{__('Roles')}}</strong>
                        <p class="text-muted">
                            {!! $user->getUserRolesAsStringWrap() !!}
                        </p>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
