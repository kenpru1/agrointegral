<?php

namespace App\Http\Requests\Backend\Maquinaria;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRoleRequest.
 */
class StoreMaquinariaRequest extends FormRequest
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
            'nombre'       => 'required|unique:maquinarias|max:100',
            'maquinaria_tipo_id'       => 'required',
            
        ];
    }
}
