<?php

namespace App\Http\Requests\Backend\Bodega;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRoleRequest.
 */
class UpdateBodegaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //if ($this->user()->hasRole('administrator')||$this->user()->hasRole('executive')) {
            //return $this->user()->isAdmin();
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
            'nombre'       => 'required|max:191|unique:bodegas,nombre,' . $this->bodega->id,
            'provincia_id' => 'required',
            'comuna_id'    => 'required',
            //'campo_id'    => 'required'
        ];
    }
}
