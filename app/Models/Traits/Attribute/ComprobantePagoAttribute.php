<?php

namespace App\Models\Traits\Attribute;

/**
 * Trait ComprobantePagoAttribute.
 */
trait ComprobantePagoAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="' . route('admin.comprobantes.edit', $this) . '" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.edit') . '"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        
            return '<a href="' . route('admin.comprobantes.destroy', $this) . '"
             id="' . $this->name . '"
             data-method="delete"
             data-trans-button-cancel="' . __('buttons.general.cancel') . '"
             data-trans-button-confirm="' . __('buttons.general.crud.delete') . '"
             data-trans-title="' . __('strings.backend.general.are_you_sure') . '"
             ><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.delete') . '"></i></a> ';
        
    }

    public function getShowButtonAttribute()
    {
        return '<a href="' . route('admin.comprobantes.show', $this) . '" ><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="Ver"></i></a>';
    }

    public function getPrintButtonAttribute()
    {
        return '<a href="' . route('admin.comprobantes.print', $this) . '" target="_blank"  class="btn btn-info"><i class="fa fa-download" data-toggle="tooltip" data-placement="top" title="PDF"></i></a>';
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
