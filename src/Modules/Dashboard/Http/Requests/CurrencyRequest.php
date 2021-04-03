<?php

namespace Modules\Dashboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Dashboard\Services\CurrenciesService;
use Modules\Dashboard\Services\LanguageService;

class CurrencyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @param LanguageService $languageService
     * @return array
     */
    public function rules(LanguageService $languageService)
    {
        $rules = [];

        foreach ($languageService->languagesKeysList() as $langKey){
            $rules["name.{$langKey}"] = 'required|max:20';
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
