@extends('dashboard::layouts.app')

@section('title')
    {{__('User Profile')}}
@endsection

@section('breadcrumbs')
@endsection

@section('content')
    <div class="container-fluid">
        {!! Form::model($user,
            [
                'method' => 'PATCH',
                'files' => true,
                'route' => ['dashboard.profile.update', $user]
            ]
        ) !!}

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if($user->hasMedia('avatar'))
                            <img class="profile-user-img img-fluid img-circle"
                                 src="{{$user->getFirstMediaUrl('avatar', 'thumb')}}"
                                 alt="User profile picture">
                            @else
                            <img class="profile-user-img img-fluid img-circle"
                                 src="{{asset('images/no-image.jpg')}}"
                                 alt="no-image">
                            @endif
                        </div>

                        <h3 class="profile-username text-center">
                            {{$user->getName()}}
                        </h3>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="settings">
                                {!! Form::model($user,
                                    [
                                        'method' => 'PATCH',
                                        'class' => 'form-horizontal',
                                        'files' => true,
                                        'route' => ['dashboard.profile.update', $user]
                                    ]
                                ) !!}
                                    <div class="form-group row">
                                        <label for="input-name" class="col-sm-2 col-form-label">{{__('Username')}}</label>
                                        <div class="col-sm-10">
                                            {{ Form::text('name', null,
                                                [
                                                    'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                                                    'placeholder' => __('Username'),
                                                    'id' => 'input-name'
                                                ]
                                            ) }}
                                            @error("name")
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="input-email" class="col-sm-2 col-form-label">{{__('Email')}}</label>
                                        <div class="col-sm-10">
                                            {{ Form::email('email', null,
                                                [
                                                    'disabled',
                                                    'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                                                    'placeholder' => __('Email'),
                                                    'id' => 'input-email'
                                                ]
                                            ) }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="input-password" class="col-sm-2 col-form-label">{{__('Password')}}</label>
                                        <div class="col-sm-10">
                                            <small class="text-muted">
                                                {{__('Leave blank if you do not want to change')}}
                                            </small>
                                            {{ Form::password('password',
                                                [
                                                    'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''),
                                                    'placeholder' => __('Password'),
                                                    'id' => 'input-password'
                                                ]
                                            ) }}
                                            @error("password")
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="input-password-confirmed" class="col-sm-2 col-form-label">
                                            {{__('Password confirmation')}}
                                        </label>
                                        <div class="col-sm-10">
                                            {{ Form::password('password_confirmation',
                                                [
                                                    'class' => 'form-control' . ($errors->has('password-confirmation') ? ' is-invalid' : ''),
                                                    'placeholder' => __('Password confirmation'),
                                                    'id' => 'input-password-confirmed'
                                                ]
                                            ) }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="input-avatar" class="col-sm-2 col-form-label">{{__('Avatar')}}</label>
                                        <div class="col-sm-10">
                                            <div class="input-group @error('avatar') is-invalid @enderror">
                                                <div class="custom-file">
                                                    <input
                                                        name="avatar"
                                                        type="file"
                                                        accept="image/*"
                                                        class="custom-file-input @error('avatar') is-invalid @enderror"
                                                        id="input-avatar"
                                                    />
                                                    <label class="custom-file-label" for="input-avatar">{{__('Choose avatar')}}</label>
                                                </div>
                                            </div>
                                            @error('avatar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            {{Form::submit(__('Update'), ['class' => 'btn btn-success'])}}
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

        {!! Form::close() !!}
    </div>
@endsection

@push('inline_scripts')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('vendor/dashboard/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endpush
