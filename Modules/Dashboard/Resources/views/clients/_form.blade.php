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
                    <label for="input-phone">@lang('shared.phone')</label>
                    {{ Form::text('phone', null,
                        [
                            'class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''),
                            'placeholder' => trans('shared.phone'),
                            'id' => 'input-phone'
                        ]
                    ) }}
                    @error("phone")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input-status">@lang('shared.status')</label>
                    {{ Form::select('status', $statues, null,
                        [
                            'class' => 'form-control custom-select rounded-0'
                                            . ($errors->has('status') ? ' is-invalid' : ''),
                            'placeholder' => trans('shared.status'),
                            'id' => 'input-status'
                        ]
                    ) }}
                    @error("status")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input-preferred_language">@lang('shared.language_client_spoken')</label>
                    {{ Form::select('preferred_language', $languageList, null,
                        [
                            'class' => 'form-control custom-select rounded-0'
                                            . ($errors->has('preferred_language') ? ' is-invalid' : ''),
                            'placeholder' => trans('shared.does_not_matter'),
                            'id' => 'input-preferred_language'
                        ]
                    ) }}
                    @error("preferred_language")
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

