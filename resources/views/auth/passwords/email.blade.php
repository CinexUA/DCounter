@extends('layouts.app')

@section('content')
<div class="card-body login-card-body">
    <p class="login-box-msg">@lang('auth.reset_password')</p>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('password.email') }}" method="post">
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

        <div class="row">

            <div class="offset-md-4 col-md-8 col-12">
                <button type="submit" class="btn btn-primary btn-block">@lang('auth.send_password_reset_link')</button>
            </div>

        </div>
    </form>

    <p class="mt-2 mb-1">
        @lang('auth.remember_the_password', ['url' => route('login')])
    </p>

</div>
@endsection
