<?php

namespace App\Http\Requests\Backend\Correlativo;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManageRoleRequest.
 */
class ManageCorrelativoRequest extends FormRequest
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
            //
        ];
    }
}
