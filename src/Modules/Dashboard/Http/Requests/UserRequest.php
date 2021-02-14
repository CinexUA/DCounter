<?php

namespace Modules\Dashboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'roles' => 'required|exists:roles,id',
            'avatar' => 'nullable|image|max:2048'
        ];

        switch ($this->method()){
            case 'POST':
                $rules['email'] = 'required|string|email|max:255|unique:users';
                $rules['password'] = 'required|string|min:8|confirmed';
                break;
            case 'PUT':
            case 'PATCH':
                $rules['email'] = [
                    'required',
                    'email',
                    'string',
                    'max:255',
                    Rule::unique('users')->ignore($this->user->id, 'id')
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
