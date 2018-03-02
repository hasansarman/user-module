<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $baseRules = [
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:3',
        ];
        $additionalRules = config('asgard.user.config.requests.register.rules');
        return is_array($additionalRules) ? $baseRules + $additionalRules : $baseRules;
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

    public function messages()
    {
        $baseMessages = [
            'email.required' => trans('user::auth.email is required'),
            'password.required' => trans('user::auth.password is required'),
        ];
        $additionalMessages = config('asgard.user.config.requests.register.messages');
        return is_array($additionalMessages) ? $baseMessages + $additionalMessages : $baseMessages;
    }
}
