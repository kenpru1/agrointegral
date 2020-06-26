<?php

namespace App\Models\Traits\Attribute;

/**
 * Trait PermissionAttribute.
 */
trait OrdenLaboratorioAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {

        if( isset($this->requerimientos->orden_laboratorio_id) ) {
            return '<a href="" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.editDisabled') . '"></i></a>';            
        }else{
            return '<a href="' . route('admin.ordenLaboratorios.edit', $this) . '" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.edit') . '"></i></a>';

        
        }        

    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if( isset($this->requerimientos->orden_laboratorio_id) ) {
            return '<a href="" ><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.deleteDisabled') . '"></i></a>';            
        }else{
            return '<a href="' . route('admin.ordenLaboratorios.destroy', $this) . '"
             id="' . $this->name . '"
             data-method="delete"
             data-trans-button-cancel="' . __('buttons.general.cancel') . '"
             data-trans-button-confirm="' . __('buttons.general.crud.delete') . '"
             data-trans-title="' . __('strings.backend.general.are_you_sure') . '"
             ><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.delete') . '"></i></a> ';
        }
    }

    public function getShowButtonAttribute()
    {
        return '<a href="' . route('admin.ordenLaboratorios.show', $this) . '" ><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="Ver"></i></a>';
    }

    public function getPrintButtonAttribute()
    {
        return '<a href="' . route('admin.ordenLaboratorios.print', $this) . '" target="_blank"  ><i class="fa fa-download" data-toggle="tooltip" data-placement="top" title="PDF"></i></a>';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        if($this->estado_presupuesto_id!=4){
        return '<div class="btn-group btn-group-sm" permission="group" aria-label="' . __('labels.backend.access.users.user_actions') . '">
              ' . $this->edit_button . '
              ' . $this->print_button . '
               
              
            </div>';
        }

         if($this->estado_presupuesto_id==4){
        return '<div class="btn-group btn-group-sm" permission="group" aria-label="' . __('labels.backend.access.users.user_actions') . '">
         
              ' . $this->print_button . '
               
              
            </div>';
        }
    }

    /**
    * Obtener el numero y cliente de la Orden Laboratorio.
    *
    * @return string
    */
    public function getNumeroAndNombreAttribute()
    {
        return $this->numero . ' ' . $this->cliente->nombre_razon;
    }        


}
