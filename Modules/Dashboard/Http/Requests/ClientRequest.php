<?php

namespace Modules\Dashboard\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Dashboard\Services\LanguageService;

class ClientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @param LanguageService $languageService
     * @return array
     */
    public function rules(LanguageService $languageService)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'status' => [
                'required',
                'integer',
                Rule::in(array_keys((new Client())->getStatusValues()))
            ],
            'phone' => 'nullable|max:15',
            'preferred_language' => [
                'nullable',
                Rule::in($languageService->languagesKeysList())
            ]
        ];

        switch ($this->method()){
            case 'POST':
                $rules['email'] = 'required|string|email|max:255|unique:clients';
                $rules['email'] = [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('clients')
                        ->where('company_id', $this->company->id)
                ];
                $rules['password'] = 'required|string|min:8|confirmed';
                break;
            case 'PUT':
            case 'PATCH':
                $rules['email'] = [
                    'required',
                    'email',
                    'string',
                    'max:255',
                    Rule::unique('clients')
                        ->ignore($this->client->id, 'id')
                        ->where('company_id', $this->company->id)
                ];
                $rules['password'] = 'nullable|string|min:8|confirmed';
                break;
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
