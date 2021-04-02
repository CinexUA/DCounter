<?php

namespace Modules\Dashboard\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'status' => [
                'required',
                'integer',
                Rule::in(array_keys((new Client())->getStatusValues()))
            ],
            'phone' => 'nullable|max:15'
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
