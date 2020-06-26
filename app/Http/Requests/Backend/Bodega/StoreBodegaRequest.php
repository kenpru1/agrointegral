<?php

namespace App\Http\Requests\Backend\Bodega;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRoleRequest.
 */
class StoreBodegaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        
            return true;
       
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'       => 'required|unique:bodegas|max:191',
            'provincia_id' => 'required',
            'comuna_id'    => 'required',
            //'campo_id'    => 'required',
            
        ];
    }
}
