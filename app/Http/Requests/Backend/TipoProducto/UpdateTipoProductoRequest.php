<?php

namespace App\Http\Requests\Backend\TipoProducto;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRoleRequest.
 */
class UpdateTipoProductoRequest extends FormRequest
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
            'nombre'       => 'required|max:100|unique:tipo_productos,nombre,' . $this->tipo_producto->id,
            'tipo_producto_id'       => 'required',
            'cliente_proveedor_id'       => 'required',
            'unidad_id'       => 'required',
            'estado_venta_id'       => 'required',
            
        ];
    }
}
