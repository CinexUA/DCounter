@extends('layouts.app')

@section('content')
<div class="card-body login-card-body">
    <p class="login-box-msg">@lang('auth.reset_password')</p>

    <form action="{{ route('password.update') }}" method="post">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="input-group mb-3">
            <input type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="@lang('shared.email')"
                   name="email"
                   value="{{ $email ?? old('email') }}"
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
                   autocomplete="current-password">
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
        <div class="row">

            <div class="offset-md-4 col-md-8 col-12">
                <button type="submit" class="btn btn-primary btn-block">@lang('auth.reset_password')</button>
            </div>

        </div>
    </form>
</div>
@endsection
