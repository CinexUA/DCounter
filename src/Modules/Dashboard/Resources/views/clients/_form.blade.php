<div class="row">
    <div class="col-12 col-sm-6 col-md-6">
        <div class="card card-info">
            <div class="card-body">

                <div class="form-group">
                    <label for="input-name">@lang('shared.name')</label>
                    {{ Form::text('name', null,
                        [
                            'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                            'placeholder' => trans('shared.name'),
                            'id' => 'input-name'
                        ]
                    ) }}
                    @error("name")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input-email">@lang('shared.email')</label>
                    {{ Form::email('email', null,
                        [
                            'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                            'placeholder' => trans('shared.email'),
                            'id' => 'input-email'
                        ]
                    ) }}
                    @error("email")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input-password">@lang('shared.password')</label>
                    @if(isset($client))
                        <small class="text-muted">
                            ({{__('Leave blank if you do not want to change')}})
                        </small>
                    @endif
                    {{ Form::password('password',
                        [
                            'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''),
                            'placeholder' => trans('shared.password'),
                            'id' => 'input-password'
                        ]
                    ) }}
                    @error("password")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input-password-confirmed">@lang('shared.password_confirmation')</label>
                    {{ Form::password('password_confirmation',
                        [
                            'class' => 'form-control' . ($errors->has('password-confirmation') ? ' is-invalid' : ''),
                            'placeholder' => trans('shared.password_confirmation'),
                            'id' => 'input-password-confirmed'
                        ]
                    ) }}
                </div>

            </div>

        </div>
    </div>
</div>

