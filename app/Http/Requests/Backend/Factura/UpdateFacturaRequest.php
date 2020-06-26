<?php

namespace App\Http\Requests\Backend\Factura;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRoleRequest.
 */
class UpdateFacturaRequest extends FormRequest
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
            'fecha'       => 'required',
            'cliente_id'=>'required',
            'validez'=>'required',
        ];
    }
}
