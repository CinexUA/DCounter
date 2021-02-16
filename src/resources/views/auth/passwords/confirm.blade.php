@extends('layouts.app')

@section('content')
<div class="card-body login-card-body">
    <p class="login-box-msg">{{ __('Please confirm your password before continuing.') }}</p>

    <form action="{{ route('password.confirm') }}" method="post">
        @csrf

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

            <div class="offset-md-4 col-md-8 col-12">
                <button type="submit" class="btn btn-primary btn-block">@lang('auth.password_confirmation')</button>
            </div>

        </div>
    </form>

    @if (Route::has('password.request'))
        <p class="mb-1">
            <a href="{{ route('password.request') }}">@lang('auth.i_forgot_my_password')</a>
        </p>
    @endif

</div>
@endsection
