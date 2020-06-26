<?php

namespace App\Models\Traits\Attribute;

/**
 * Trait PermissionAttribute.
 */
trait ActividadAttribute
{
    /**
     * @return string
     */
    public function edit_button($dir)
    {
        if(auth()->user()->hasRole('administrator')){
            return '<a href="' . route('admin.'.$dir.'.edit', $this) . '" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.edit') . '"></i></a>';
        
        }

        if($this->empresa_id!=null &&  auth()->user()->hasRole('executive')){
            return '<a href="' . route('admin.'.$dir.'.edit', $this) . '" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.edit') . '"></i></a>';
        
        }
    }

   
    /**
     * @return string
     */
    public function delete_button($dir)
    {   

        if(auth()->user()->hasRole('administrator')){
            return '<a href="' . route('admin.'.$dir.'.destroy', $this) . '"
             id="' . $this->name . '"
             data-method="delete"
             data-trans-button-cancel="' . __('buttons.general.cancel') . '"
             data-trans-button-confirm="' . __('buttons.general.crud.delete') . '"
             data-trans-title="' . __('strings.backend.general.are_you_sure') . '"
             ><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . __('buttons.general.crud.delete') . '"></i></a> ';
        }
        
        if($this->empresa_id!=null &&  auth()->user()->hasRole('executive')){
            return '<a href="' . route('admin.'.$dir.'.destroy', $this) . '"
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
    public function action_buttons($dir)
    {
        
        return '<div class="btn-group btn-group-sm" permission="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
			  '.$this->edit_button($dir).'
              
			  '.$this->delete_button($dir).'
			</div>';
    }
}
