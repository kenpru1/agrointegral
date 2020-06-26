<?php

namespace App\Models\Traits\Attribute;

/**
 * Trait PermissionAttribute.
 */
trait RacionAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="' . route('admin.raciones.edit', $this) . '" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.edit') . '"></i></a>';
    }

  
    public function getShowButtonAttribute()
    {
        return '<a href="' . route('admin.raciones.show', $this) . '" ><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="Ver"></i></a>';
    }

    /*public function getCeloButtonAttribute()
    {
        if ($this->sexo_id == 2) {
            return '<a href="' . route('admin.celos.new', $this) . '" ><i class="fa fa-heart" data-toggle="tooltip" data-placement="top" title="Nuevo Celo"></i></a>';
        }
    }*/


    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        //if(empty($this->movimientos->first())){
        return '<a href="' . route('admin.raciones.destroy', $this) . '"
             id="' . $this->name . '"
             data-method="delete"
             data-trans-button-cancel="' . __('buttons.general.cancel') . '"
             data-trans-button-confirm="' . __('buttons.general.crud.delete') . '"
             data-trans-title="' . __('strings.backend.general.are_you_sure') . '"
             ><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.delete') . '"></i></a> ';
        //}

    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {

        return '<div class="btn-group btn-group-sm" permission="group" aria-label="' . __('labels.backend.access.users.user_actions') . '">
              ' . $this->edit_button . '

              ' . $this->delete_button . '
             
             
            </div>';
    }
}
