<?php

namespace App\Models\Traits\Attribute;

/**
 * Trait PermissionAttribute.
 */
trait RodeoAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if(auth()->user()->hasRole('administrator')){
            return '<a href="' . route('admin.rodeos.edit', $this) . '" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.edit') . '"></i></a>';
        
        }

        if($this->empresa_id!=null &&  auth()->user()->hasRole('executive')){
            return '<a href="' . route('admin.rodeos.edit', $this) . '" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.edit') . '"></i></a>';
        
        }
    }

    public function getShowButtonAttribute()
    {
        return '<a href="' . route('admin.rodeos.show', $this) . '" ><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="Ver"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {   

        if(auth()->user()->hasRole('administrator')){
            return '<a href="' . route('admin.rodeos.destroy', $this) . '"
             id="' . $this->name . '"
             data-method="delete"
             data-trans-button-cancel="' . __('buttons.general.cancel') . '"
             data-trans-button-confirm="' . __('buttons.general.crud.delete') . '"
             data-trans-title="' . __('strings.backend.general.are_you_sure') . '"
             ><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.delete') . '"></i></a> ';
        }
        
        if($this->empresa_id!=null &&  auth()->user()->hasRole('executive')){
            return '<a href="' . route('admin.rodeos.destroy', $this) . '"
             id="' . $this->name . '"
             data-method="delete"
             data-trans-button-cancel="' . __('buttons.general.cancel') . '"
             data-trans-button-confirm="' . __('buttons.general.crud.delete') . '"
             data-trans-title="' . __('strings.backend.general.are_you_sure') . '"
             ><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.delete') . '"></i></a> ';
        }      

    }
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        
        return '<div class="btn-group btn-group-sm" permission="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
			  '.$this->edit_button.'
              
			  '.$this->delete_button.'
			</div>';
    }
}
