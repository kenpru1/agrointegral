<?php

namespace App\Http\Requests\Backend\TipoProducto;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRoleRequest.
 */
class StoreTipoProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->hasRole('administrator')) {
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
            'nombre'       => 'required|unique:tipo_productos|max:100',
            'tipo_producto_id'       => 'required',
            'cliente_proveedor_id'       => 'required',
            'unidad_id'       => 'required',
            'estado_venta_id'       => 'required',
        ];
    }
}
