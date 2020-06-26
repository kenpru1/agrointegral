<?php

namespace App\Http\Requests\Backend\TipoCultivo;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRoleRequest.
 */
class UpdateTipoCultivoRequest extends FormRequest
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
            //'nombre'       => 'required|max:191|unique:tipos_cultivos,nombre,' . $this->tipo_cultivo->id,
            'nombre'       => 'required|max:191' . $this->tipo_cultivo->id,
            
        ];
    }
}
