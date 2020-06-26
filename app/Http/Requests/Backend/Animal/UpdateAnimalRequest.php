<?php

namespace App\Http\Requests\Backend\Animal;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRoleRequest.
 */
class UpdateAnimalRequest extends FormRequest
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
            //'caravana'       => 'required|max:20|unique:animales,caravana,' . $this->animal->id,
            'caravana'       => 'required|max:20' . $this->animal->id,
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
        /*return [
            'nombre'       => 'required|max:191|unique:campos,nombre,' . $this->campo->id,
            'provincia_id' => 'required',
            'comuna_id'    => 'required',
            
        ];*/
    }
}
