<?php

namespace App\Http\Requests\Backend\Empresa;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRoleRequest.
 */
class UpdateEmpresaPerfilRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->hasRole('user')||$this->user()->hasRole('executive')||$this->user()->hasRole('administrator')) {
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
            'nombre'       => 'required|max:191' ,
            'rut_dni' => 'required',
            'direccion'    => 'required|max:191',
            'comuna'    => 'required|max:191',
            'ciudad'    => 'required|max:191',
            'pais_id'    => 'required',

            
        ];
    }
}
