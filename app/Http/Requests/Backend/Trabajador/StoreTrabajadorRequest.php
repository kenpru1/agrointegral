<?php

namespace App\Http\Requests\Backend\Trabajador;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRoleRequest.
 */
class StoreTrabajadorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->hasRole('administrator')||$this->user()->hasRole('executive')) {
            
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
            'rut'       => 'required|unique:trabajadores|max:50',
            'nombre'       => 'required|max:100',
            'tipo_trabajador_id' => 'required',
            'nivel_calificacion_id'    => 'required',
            'email'       => 'required|unique:trabajadores|max:50',
            'nacionalidad'      => 'required',
        ];
    }
}
