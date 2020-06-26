<?php

namespace App\Models\Traits\Attribute;

/**
 * Trait PermissionAttribute.
 */
trait FacturaAttribute
{
    /**
     * @return string
     */
   /* public function getEditButtonAttribute()
    {
        return '<a href="' . route('admin.facturas.edit', $this) . '" class="btn btn-primary"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.edit') . '"></i></a>';
    }*/

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        
            return '<a href="' . route('admin.facturas.destroy', $this) . '"
             id="' . $this->name . '"
             data-method="delete"
             data-trans-button-cancel="' . __('buttons.general.cancel') . '"
             data-trans-button-confirm="' . __('buttons.general.crud.delete') . '"
             data-trans-title="' . __('strings.backend.general.are_you_sure') . '"
             ><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.delete') . '"></i></a> ';
        
    }

    public function getShowButtonAttribute()
    {
        return '<a href="' . route('admin.facturas.show', $this) . '" ><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="Ver"></i></a>';
    }

    public function getPrintButtonAttribute()
    {
        return '<a href="' . route('admin.facturas.print', $this) . '" target="_blank"  ><i class="fa fa-download" data-toggle="tooltip" data-placement="top" title="PDF"></i></a>';
    }

    public function getPaymentButtonAttribute()
    {
        return '<a href="' . route('admin.facturas.payment', $this) . '" ><i class="fa fa-dollar" data-toggle="tooltip" data-placement="top" title="Pagar"></i></a>';
    }

    public function getNotaButtonAttribute()
    {
        return '<a href="' . route('admin.facturas.notaCredito', $this) . '" ><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Anular"></i></a>';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        if($this->estado_factura_id==3){
            return '<div class="btn-group btn-group-sm" permission="group" aria-label="' . __('labels.backend.access.users.user_actions') . '">
         
              ' . $this->print_button . '
               
              
            </div>';
        }

        if (count($this->pago_factura) > 0) {
            return '<div class="btn-group btn-group-sm" permission="group" aria-label="' . __('labels.backend.access.users.user_actions') . '">
              ' . $this->edit_button . '
              ' . $this->print_button . '
              ' . $this->payment_button . '

            </div>';
        }

        if($this->estado_factura_id!=2){
            return '<div class="btn-group btn-group-sm" permission="group" aria-label="' . __('labels.backend.access.users.user_actions') . '">
              ' . $this->edit_button . '
              ' . $this->print_button . '
              ' . $this->payment_button . '
              ' . $this->nota_button . '
               
              
            </div>';
        }

        if($this->estado_factura_id==2){
            return '<div class="btn-group btn-group-sm" permission="group" aria-label="' . __('labels.backend.access.users.user_actions') . '">
         
              ' . $this->print_button . '
               
              
            </div>';
        }
    }
}
