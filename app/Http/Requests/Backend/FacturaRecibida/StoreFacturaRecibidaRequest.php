<?php

namespace App\Http\Requests\Backend\FacturaRecibida;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRoleRequest.
 */
class StoreFacturaRecibidaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->hasRole('administrator')||$this->user()->hasRole('executive')||$this->user()->hasRole('user')) {
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
            'ref' => 'required',
            'ref_vendedor' => 'required',
            'monto_neto' => 'required|numeric|min:1,00|between:0,9999999999999999.99',
        ];
    }
}
