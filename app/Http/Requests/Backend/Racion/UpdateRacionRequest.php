<?php

namespace App\Http\Requests\Backend\Racion;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRoleRequest.
 */
class UpdateRacionRequest extends FormRequest
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
            'tipo_racion_id'      => 'required|numeric',
            'tipo_racion_id'      => 'required|numeric',
            'trabajador_id'      => 'required|numeric',
            'fecha'      => 'required',
            'nombre'       => 'max:100',
            'comentario'  => 'max:800',
           
        ];
    }
}
