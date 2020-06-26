<?php

namespace App\Http\Requests\Backend\RendimientoCuartel;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRoleRequest.
 */
class UpdateRendimientoCuartelRequest extends FormRequest
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
            'toneladas_brutas' => 'required|numeric|min:0|between:0,9999999999999999.99',
            'produccion' => 'required|numeric|min:0|between:0,9999999999999999.99',
            'descarte_bruto' => 'required|numeric|min:0|between:0,9999999999999999.99',
            'total_produccion' => 'required|numeric|min:0|between:0,9999999999999999.99',
            'exportacion' => 'required|numeric|min:0|between:0,9999999999999999.99',
            'descarte_produccion' => 'required|numeric|min:0|between:0,9999999999999999.99',
        ];
    }
}
