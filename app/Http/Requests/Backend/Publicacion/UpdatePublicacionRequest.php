<?php

namespace App\Http\Requests\Backend\Publicacion;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRoleRequest.
 */
class UpdatePublicacionRequest extends FormRequest
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
            'titulo'       => 'required|max:50',
            'contacto' => 'required|max:200',
            'telefono' => 'required|max:20',
            'email' => 'required|email|max:100', 
            'precio' => 'required',
            
        ];
    }
}
