<?php

namespace Modules\Dashboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge(['sms_notification' => (bool)$this->get('sms_notification')]);
        $this->merge(['visiting_clients_log' => (bool)$this->get('visiting_clients_log')]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'description' => 'nullable|string|max:65535',
            'currency_id' => 'required|exists:currencies,id',
            'price_per_month' => 'required|numeric|min:1',
            'sms_notification' => 'boolean',
            'visiting_clients_log' => 'boolean',
        ];
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
