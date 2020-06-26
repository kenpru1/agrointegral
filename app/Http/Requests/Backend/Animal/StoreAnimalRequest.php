<?php

namespace App\Http\Requests\Backend\Animal;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRoleRequest.
 */
class StoreAnimalRequest extends FormRequest
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
            //'caravana'       => 'required|unique:animales|max:20',
            'caravana'       => 'required|max:20',
            'nombre'       => 'required|max:100',
            'raza'       => 'max:100',
            'categoria_pedigree'       => 'max:100',
            //'fecha_nacimiento'       => 'date',
            'peso_nacer'      => 'numeric',
            'caravana_madre' =>'max:20',
            'nombre_madre' =>'max:50',
            'caravana_progenitor' =>'max:20',
            'nombre_progenitor' =>'max:50',
            'indice_corporal'      => 'numeric',
            'observaciones' =>'max:800',
            'codigo_rfid'=>'max:20',
            //'fecha_muerte'       => 'date',

        ];
    }
}
