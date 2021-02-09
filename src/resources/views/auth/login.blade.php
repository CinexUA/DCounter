@extends('layouts.app')

@section('content')
<div class="card-body login-card-body">
    <p class="login-box-msg">@lang('auth.sign_in_to_start_your_session')</p>

    <form action="{{ route('login') }}" method="post">
        @csrf

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
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">
                        @lang('auth.remember_me')
                    </label>
                </div>
            </div>

            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">@lang('auth.sign_in')</button>
            </div>

        </div>
    </form>

    @if (Route::has('password.request'))
    <p class="mb-1">
        <a href="{{ route('password.request') }}">@lang('auth.i_forgot_my_password')</a>
    </p>
    @endif
    @if (Route::has('register'))
    <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">@lang('auth.register_a_new_membership')</a>
    </p>
    @endif
</div>
@endsection
