<?php

namespace App\Http\Requests\Frontend\PreRegistro;

use Illuminate\Validation\Rule;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegisterRequest.
 */
class PreRegistroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'           => ['required', 'string', 'max:100'],
            'email'                => ['required', 'string', 'email', 'max:100'],
            'g-recaptcha-response' => ['required_if:captcha_status,true', new CaptchaRule()],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
        ];
    }
}
