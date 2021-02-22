<div class="row">
    <div class="col-12">
        <div class="card card-info">
            <div class="card-body">

                <div class="form-group">
                    <label for="input-name">@lang('dashboard::shared.permission_name_code')</label>
                    {{ Form::text('name', null,
                        [
                            'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                            'placeholder' => trans('dashboard::shared.permission_name_code'),
                            'id' => 'input-name',
                            'disabled'
                        ]
                    ) }}
                    @error("name")
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="input-display-name">@lang('shared.display_name')</label>
                    {{ Form::text('display_name', null,
                        [
                            'class' => 'form-control' . ($errors->has('display_name') ? ' is-invalid' : ''),
                            'placeholder' => trans('shared.display_name'),
                            'id' => 'input-display-name'
                        ]
                    ) }}
                    @error("display_name")
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

            </div>

        </div>
    </div>
</div>
