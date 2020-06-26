<?php

namespace App\Http\Requests\Backend\Plan;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRoleRequest.
 */
class StorePlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //if ($this->user()->hasRole('administrator')) {
            
            return true;
        //}
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'       => 'required|unique:planes|max:191',
            'cantidad_uf'       => 'required',

        ];
    }
}
