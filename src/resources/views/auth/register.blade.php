@extends('layouts.app')

@section('content')
<div class="card-body login-card-body">
    <p class="login-box-msg">@lang('auth.register_a_new_membership')</p>

    {!! Form::open(['route' => 'register', 'files' => true]) !!}


        <div class="input-group mb-3">
            <input type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="@lang('shared.name')"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   autocomplete="name"
                   autofocus
            >
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="@lang('shared.email')"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autocomplete="email"
                   autofocus
            >
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="@lang('shared.password')"
                   name="password"
                   required
                   autocomplete="new-password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="password"
                   class="form-control"
                   placeholder="@lang('auth.password_confirmation')"
                   name="password_confirmation"
                   required
                   autocomplete="new-password"
            >
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
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

        <div class="row">

            <div class="offset-md-6 col-md-6 col-12">
                <button type="submit" class="btn btn-primary btn-block">@lang('auth.register')</button>
            </div>

        </div>
    {!! Form::close() !!}

    <p class="mt-2 mb-1">
        @lang('auth.already_have_an_account', ['url' => route('login')])
    </p>
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
