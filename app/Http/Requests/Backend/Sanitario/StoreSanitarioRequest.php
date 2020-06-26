<?php

namespace App\Http\Requests\Backend\Sanitario;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRoleRequest.
 */
class StoreSanitarioRequest extends FormRequest
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
            'animal_id'      => 'required|numeric',
            'tipo_sanitario_id'      => 'required|numeric',
            'nombre'       => 'max:100',
            'tratamiento_utilizado'       => 'max:400',
            'comentario'  => 'max:800',
            'dias'       => 'max:100',
        ];
    }
}
