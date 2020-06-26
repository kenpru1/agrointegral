<?php

namespace App\Http\Requests\Backend\Cuartel;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRoleRequest.
 */
class UpdateCuartelRequest extends FormRequest
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
            //'nombre'       => 'required|max:191|unique:cuarteles,nombre,' . $this->cuartel->id,
            'nombre'       => 'required|max:191' . $this->cuartel->id,
            'provincia_id' => 'required',
            'comuna_id'    => 'required',
            'campo_id'    => 'required',
            'tamanno'      => 'required|numeric',
        ];
    }
}
