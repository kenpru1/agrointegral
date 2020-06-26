<?php

namespace App\Http\Requests\Backend\Actividad;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRoleRequest.
 */
class StoreGastoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //if ($this->user()->hasRole('administrator')||$this->user()->hasRole('executive')) {
            
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
            'fecha'      => 'required',
            'cliente_proveedor_id'      => 'required',
            'total_labores'      => 'required',
        ];
    }
}
