<div class="form-group">
    <label for="input-name">@lang('shared.name') ({{ strtoupper($langKey) }})</label>

    {{ Form::text("name[{$langKey}]",
                           old("name[{$langKey}]", isset($currency) ? $currency->getTranslation('name', $langKey) : ''),
        [
            'class' => 'form-control' . ($errors->has("name.{$langKey}") ? ' is-invalid' : ''),
            'placeholder' => (trans('shared.name') . ' ' . strtoupper($langKey)),
            'id' => 'input-name'
        ]
    ) }}

    @error("name.{$langKey}")
    <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>
