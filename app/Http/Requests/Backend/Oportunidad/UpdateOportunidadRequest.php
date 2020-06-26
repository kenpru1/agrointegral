<?php

namespace App\Http\Requests\Backend\Oportunidad;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRoleRequest.
 */
class UpdateOportunidadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->hasRole('administrator')||$this->user()->hasRole('executive')) {
            //return $this->user()->isAdmin();
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'monto' => 'required|min:1,00|between:0,9999999999999999.99',
        ];
    }
}
