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
                    <label for="input-description">@lang('shared.description')</label>
                    {{ Form::text('description', null,
                        [
                            'class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''),
                            'placeholder' => trans('shared.description'),
                            'id' => 'input-description'
                        ]
                    ) }}
                    @error("description")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input-currency">@lang('shared.currency')</label>
                    {{ Form::select('currency_id', $currencies, null,
                        [
                            'class' => 'custom-select rounded-0' . ($errors->has('currency_id') ? ' is-invalid' : ''),
                            'id' => 'input-currency'
                        ]
                    ) }}
                    @error("currency_id")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        {{ Form::checkbox('sms_notification', 1, null,
                                            [
                                                'class' => 'custom-control-input',
                                                'id' => 'input-sms_notification'
                                            ])
                        }}
                        <label for="input-sms_notification" class="custom-control-label">
                            @lang('shared.sms_notification')
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        {{ Form::checkbox('visiting_clients_log', 1, null,
                                            [
                                                'class' => 'custom-control-input',
                                                'id' => 'input-log_customer_visits'
                                            ])
                        }}
                        <label for="input-log_customer_visits" class="custom-control-label">
                            @lang('shared.keep_log_customer_visits')
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="input-price-per-month">@lang('dashboard::shared.price_per_month')</label>
                    {{ Form::number('price_per_month', null,
                        [
                            'class' => 'form-control' . ($errors->has('price_per_month') ? ' is-invalid' : ''),
                            'placeholder' => trans('dashboard::shared.price_per_month'),
                            'id' => 'input-price-per-month',
                            'step' => 'any'
                        ]
                    ) }}
                    @error("price_per_month")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

            </div>

        </div>
    </div>
</div>

