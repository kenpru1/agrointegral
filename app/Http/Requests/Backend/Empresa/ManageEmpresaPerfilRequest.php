<?php

namespace App\Http\Requests\Backend\Empresa;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManageRoleRequest.
 */
class ManageEmpresaPerfilRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->hasRole('user')||$this->user()->hasRole('executive')||$this->user()->hasRole('administrator')) {
        
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
            //
        ];
    }
}
